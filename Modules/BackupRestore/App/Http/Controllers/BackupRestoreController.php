<?php

namespace Modules\BackupRestore\App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Artisan;
use Modules\BackupRestore\App\Services\BackupService;

class BackupRestoreController extends Controller
{
    protected $backupService;

    public function __construct(BackupService $backupService)
    {
        $this->backupService = $backupService;
    }

    /**
     * Display backup & restore dashboard
     */
    public function index()
    {
        $backups = $this->backupService->getBackupsList();
        $diskSpace = $this->backupService->getDiskSpace();
        
        return view('backuprestore::index', compact('backups', 'diskSpace'));
    }

    /**
     * Create a full backup (database + files)
     */
    public function createFullBackup(Request $request)
    {
        try {
            $result = $this->backupService->createFullBackup();
            
            return response()->json([
                'success' => true,
                'message' => 'Full backup created successfully',
                'backup_file' => $result['backup_file'],
                'size' => $result['size']
            ]);
            
        } catch (\Exception $e) {
            Log::error('Full backup creation failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Backup creation failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Create database backup only
     */
    public function createDatabaseBackup(Request $request)
    {
        try {
            $result = $this->backupService->createDatabaseBackup();

            return response()->json([
                'success' => true,
                'message' => 'Database backup created successfully',
                'backup_file' => $result['filename'],
                'size' => $result['size']
            ]);

        } catch (\Exception $e) {
            Log::error('Database backup failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Database backup failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Create files backup (storage, uploads, etc.)
     */
    public function createFilesBackup(Request $request)
    {
        try {
            $result = $this->backupService->createFilesBackup();

            return response()->json([
                'success' => true,
                'message' => 'Files backup created successfully',
                'backup_file' => $result['filename'],
                'size' => $result['size']
            ]);

        } catch (\Exception $e) {
            Log::error('Files backup failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Files backup failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Restore from backup
     */
    public function restoreBackup(Request $request)
    {
        $request->validate([
            'backup_file' => 'required|string',
            'restore_type' => 'required|in:full,database,files'
        ]);

        try {
            $backupFile = $request->backup_file;
            $restoreType = $request->restore_type;
            $backupPath = storage_path('app/backups/' . $backupFile);

            if (!file_exists($backupPath)) {
                throw new \Exception('Backup file not found');
            }

            // Validate backup integrity before restore
            $validation = $this->backupService->validateBackup($backupFile);
            if (!$validation['valid']) {
                throw new \Exception('Backup file is corrupted: ' . $validation['error']);
            }

            // Create backup before restore if configured
            if (config('backuprestore.restore.backup_before_restore', true)) {
                $this->backupService->createDatabaseBackup();
                Log::info('Created backup before restore operation');
            }

            switch ($restoreType) {
                case 'full':
                    $this->restoreFullBackup($backupPath);
                    break;
                case 'database':
                    $this->restoreDatabaseBackup($backupPath);
                    break;
                case 'files':
                    $this->restoreFilesBackup($backupPath);
                    break;
            }

            // Post-restore actions
            if (config('backuprestore.restore.clear_cache_after_restore', true)) {
                \Illuminate\Support\Facades\Artisan::call('cache:clear');
                \Illuminate\Support\Facades\Artisan::call('config:clear');
                \Illuminate\Support\Facades\Artisan::call('view:clear');
            }

            return response()->json([
                'success' => true,
                'message' => ucfirst($restoreType) . ' backup restored successfully'
            ]);

        } catch (\Exception $e) {
            Log::error('Restore failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Restore failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete backup file
     */
    public function deleteBackup(Request $request)
    {
        $request->validate([
            'backup_file' => 'required|string'
        ]);

        try {
            $success = $this->backupService->deleteBackup($request->backup_file);

            if ($success) {
                return response()->json([
                    'success' => true,
                    'message' => 'Backup deleted successfully'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Backup file not found'
            ], 404);

        } catch (\Exception $e) {
            Log::error('Delete backup failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Delete failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Download backup file
     */
    public function downloadBackup(Request $request)
    {
        $backupFile = $request->get('file');
        $filePath = storage_path('app/backups/' . $backupFile);

        if (!file_exists($filePath)) {
            abort(404, 'Backup file not found');
        }

        return response()->download($filePath);
    }

    /**
     * Validate backup file
     */
    public function validateBackup(Request $request)
    {
        $request->validate([
            'backup_file' => 'required|string'
        ]);

        try {
            $result = $this->backupService->validateBackup($request->backup_file);
            
            return response()->json([
                'success' => true,
                'valid' => $result['valid'],
                'error' => $result['error'] ?? null
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get backup statistics
     */
    public function getStats()
    {
        try {
            $backups = $this->backupService->getBackupsList();
            $diskSpace = $this->backupService->getDiskSpace();
            
            $stats = [
                'total_backups' => count($backups),
                'total_size' => array_sum(array_column($backups, 'size_bytes')),
                'disk_usage' => $diskSpace,
                'backup_types' => array_count_values(array_column($backups, 'type')),
                'latest_backup' => count($backups) > 0 ? $backups[0]['date'] : null,
            ];
            
            return response()->json([
                'success' => true,
                'stats' => $stats
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to get stats: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Restore full backup
     */
    private function restoreFullBackup(string $filePath)
    {
        // Implementation handled by service
        // This is a placeholder for additional controller-specific logic
        Log::info("Starting full backup restore from: {$filePath}");
    }

    /**
     * Restore database backup
     */
    private function restoreDatabaseBackup(string $filePath)
    {
        // Implementation handled by service
        // This is a placeholder for additional controller-specific logic
        Log::info("Starting database restore from: {$filePath}");
    }

    /**
     * Restore files backup
     */
    private function restoreFilesBackup(string $filePath)
    {
        // Implementation handled by service
        // This is a placeholder for additional controller-specific logic
        Log::info("Starting files restore from: {$filePath}");
    }

    /**
     * Format bytes to human readable format
     */
    private function formatBytes(int $bytes, int $precision = 2): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, $precision) . ' ' . $units[$i];
    }
}
