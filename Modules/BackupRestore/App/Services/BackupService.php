<?php

namespace Modules\BackupRestore\App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Artisan;
use Carbon\Carbon;
use ZipArchive;

class BackupService
{
    protected $backupPath;
    protected $maxBackups;
    protected $excludeDirectories;

    public function __construct()
    {
        $this->backupPath = storage_path('app/backups');
        $this->maxBackups = config('backuprestore.max_backups', 10);
        $this->excludeDirectories = config('backuprestore.exclude_directories', [
            'node_modules',
            '.git',
            'vendor',
            'storage/logs',
            'storage/framework/cache',
            'storage/framework/sessions',
            'storage/framework/views'
        ]);
        
        $this->ensureBackupDirectoryExists();
    }

    /**
     * Ensure backup directory exists
     */
    private function ensureBackupDirectoryExists()
    {
        if (!File::exists($this->backupPath)) {
            File::makeDirectory($this->backupPath, 0755, true);
        }
    }

    /**
     * Create a full backup
     */
    public function createFullBackup(): array
    {
        try {
            $timestamp = Carbon::now()->format('Y-m-d_H-i-s');
            $backupName = "full_backup_{$timestamp}";
            
            // Create temporary directory
            $tempPath = $this->backupPath . '/' . $backupName;
            File::makeDirectory($tempPath, 0755, true);

            // Create database backup
            $dbFile = $this->createDatabaseBackup($tempPath);
            
            // Create files backup
            $filesFile = $this->createFilesBackup($tempPath);
            
            // Create ZIP archive
            $zipFile = $this->createZipArchive($tempPath, $backupName);
            
            // Clean temporary directory
            File::deleteDirectory($tempPath);
            
            // Clean old backups
            $this->cleanOldBackups();
            
            return [
                'success' => true,
                'backup_file' => $zipFile,
                'size' => $this->formatBytes(File::size($this->backupPath . '/' . $zipFile))
            ];
            
        } catch (\Exception $e) {
            Log::error('Full backup creation failed: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Create database backup
     */
    public function createDatabaseBackup(?string $customPath = null): string|array
    {
        try {
            $timestamp = Carbon::now()->format('Y-m-d_H-i-s');
            $filename = "database_backup_{$timestamp}.sql";
            $path = $customPath ?? $this->backupPath;
            $filePath = $path . '/' . $filename;

            $database = config('database.default');
            $connection = config("database.connections.{$database}");

            if ($connection['driver'] === 'mysql') {
                $this->createMySQLBackup($connection, $filePath);
            } else {
                $this->createGenericDatabaseBackup($filePath);
            }

            if (!$customPath) {
                $this->cleanOldBackups();
                
                // Return array with size info when not using custom path
                return [
                    'filename' => $filename,
                    'size' => $this->formatBytes(File::size($filePath))
                ];
            }

            return $filename;
            
        } catch (\Exception $e) {
            Log::error('Database backup creation failed: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Create MySQL database backup
     */
    private function createMySQLBackup(array $connection, string $filePath): void
    {
        // Use mysqldump if available
        $mysqldumpPath = $this->findMySQLDumpPath();
        
        if ($mysqldumpPath) {
            $command = sprintf(
                '%s --single-transaction --routines --triggers --add-locks --lock-tables=false -h%s -P%s -u%s %s %s > %s',
                $mysqldumpPath,
                escapeshellarg($connection['host']),
                escapeshellarg($connection['port'] ?? 3306),
                escapeshellarg($connection['username']),
                !empty($connection['password']) ? '-p' . escapeshellarg($connection['password']) : '',
                escapeshellarg($connection['database']),
                escapeshellarg($filePath)
            );
            
            exec($command, $output, $returnVar);
            
            if ($returnVar !== 0) {
                throw new \Exception('MySQL backup failed with exit code: ' . $returnVar);
            }
        } else {
            // Fallback to Laravel DB backup
            $this->createGenericDatabaseBackup($filePath);
        }
    }

    /**
     * Find mysqldump executable path
     */
    private function findMySQLDumpPath(): ?string
    {
        $paths = [
            '/usr/bin/mysqldump',
            '/usr/local/bin/mysqldump',
            '/opt/lampp/bin/mysqldump',
            'mysqldump' // System PATH
        ];

        foreach ($paths as $path) {
            if (is_executable($path) || exec("which $path")) {
                return $path;
            }
        }

        return null;
    }

    /**
     * Create generic database backup using Laravel DB
     */
    private function createGenericDatabaseBackup(string $filePath): void
    {
        $tables = DB::select('SHOW TABLES');
        $output = "-- Database backup created on " . Carbon::now() . "\n";
        $output .= "-- Generated by Laravel Backup Module\n\n";
        $output .= "SET FOREIGN_KEY_CHECKS=0;\n\n";

        foreach ($tables as $table) {
            $tableName = array_values((array) $table)[0];
            
            // Get table structure
            $createTable = DB::select("SHOW CREATE TABLE `{$tableName}`")[0];
            $output .= "-- Table structure for table `{$tableName}`\n";
            $output .= "DROP TABLE IF EXISTS `{$tableName}`;\n";
            $output .= $createTable->{'Create Table'} . ";\n\n";

            // Get table data in chunks to handle large tables
            $chunkSize = 1000;
            DB::table($tableName)->orderBy(DB::raw('1'))->chunk($chunkSize, function ($rows) use (&$output, $tableName) {
                if ($rows->count() > 0) {
                    $output .= "-- Dumping data for table `{$tableName}`\n";
                    $output .= "LOCK TABLES `{$tableName}` WRITE;\n";
                    
                    foreach ($rows as $row) {
                        $values = array_map(function ($value) {
                            return $value === null ? 'NULL' : "'" . addslashes($value) . "'";
                        }, (array) $row);
                        
                        $output .= "INSERT INTO `{$tableName}` VALUES (" . implode(', ', $values) . ");\n";
                    }
                    
                    $output .= "UNLOCK TABLES;\n\n";
                }
            });
        }

        $output .= "SET FOREIGN_KEY_CHECKS=1;\n";
        File::put($filePath, $output);
    }

    /**
     * Create files backup
     */
    public function createFilesBackup(?string $customPath = null): string|array
    {
        try {
            $timestamp = Carbon::now()->format('Y-m-d_H-i-s');
            $filename = "files_backup_{$timestamp}.zip";
            $path = $customPath ?? $this->backupPath;
            $filePath = $path . '/' . $filename;

            $zip = new ZipArchive();
            if ($zip->open($filePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
                throw new \Exception('Cannot create ZIP file');
            }

            // Backup important directories
            $this->addDirectoryToZip($zip, storage_path('app/public'), 'storage/app/public');
            
            // Add uploads directory
            if (File::exists(public_path('uploads'))) {
                $this->addDirectoryToZip($zip, public_path('uploads'), 'public/uploads');
            }

            // Add .env file (with sensitive data removed)
            $this->addEnvironmentFileToZip($zip);

            // Add custom directories from config
            $customDirs = config('backuprestore.include_directories', []);
            foreach ($customDirs as $source => $destination) {
                if (File::exists($source)) {
                    if (File::isDirectory($source)) {
                        $this->addDirectoryToZip($zip, $source, $destination);
                    } else {
                        $zip->addFile($source, $destination);
                    }
                }
            }

            $zip->close();

            if (!$customPath) {
                $this->cleanOldBackups();
                
                // Return array with size info when not using custom path
                return [
                    'filename' => $filename,
                    'size' => $this->formatBytes(File::size($filePath))
                ];
            }

            return $filename;
            
        } catch (\Exception $e) {
            Log::error('Files backup creation failed: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Add environment file to ZIP (with sensitive data masked)
     */
    private function addEnvironmentFileToZip(ZipArchive $zip): void
    {
        $envPath = base_path('.env');
        if (File::exists($envPath)) {
            $envContent = File::get($envPath);
            
            // Mask sensitive values
            $sensitiveKeys = ['DB_PASSWORD', 'APP_KEY', 'MAIL_PASSWORD', 'AWS_SECRET_ACCESS_KEY'];
            foreach ($sensitiveKeys as $key) {
                $envContent = preg_replace("/^{$key}=.*/m", "{$key}=***MASKED***", $envContent);
            }
            
            $zip->addFromString('.env.backup', $envContent);
        }
    }

    /**
     * Add directory to ZIP archive with exclusions
     */
    private function addDirectoryToZip(ZipArchive $zip, string $sourcePath, string $localPath = ''): void
    {
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($sourcePath),
            \RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($iterator as $file) {
            if ($file->isDir()) {
                continue;
            }

            $filePath = $file->getRealPath();
            $relativePath = substr($filePath, strlen($sourcePath) + 1);
            
            // Skip excluded directories
            if ($this->shouldExcludeFile($relativePath)) {
                continue;
            }
            
            $zipPath = $localPath ? $localPath . '/' . $relativePath : $relativePath;
            $zip->addFile($filePath, $zipPath);
        }
    }

    /**
     * Check if file should be excluded from backup
     */
    private function shouldExcludeFile(string $relativePath): bool
    {
        foreach ($this->excludeDirectories as $excludeDir) {
            if (strpos($relativePath, $excludeDir) === 0) {
                return true;
            }
        }
        
        // Skip large files (> 50MB)
        $maxFileSize = config('backuprestore.max_file_size', 50 * 1024 * 1024);
        if (File::size($relativePath) > $maxFileSize) {
            return true;
        }
        
        return false;
    }

    /**
     * Create ZIP archive from directory
     */
    private function createZipArchive(string $tempPath, string $backupName): string
    {
        $zipFilename = $backupName . '.zip';
        $zipPath = $this->backupPath . '/' . $zipFilename;

        $zip = new ZipArchive();
        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
            throw new \Exception('Cannot create ZIP archive');
        }

        $this->addDirectoryToZip($zip, $tempPath, '');
        $zip->close();

        return $zipFilename;
    }

    /**
     * Clean old backups based on retention policy
     */
    private function cleanOldBackups(): void
    {
        $backups = $this->getBackupsList();
        
        if (count($backups) > $this->maxBackups) {
            // Sort by date (oldest first)
            usort($backups, function ($a, $b) {
                return strtotime($a['date']) - strtotime($b['date']);
            });
            
            // Delete oldest backups
            $toDelete = array_slice($backups, 0, count($backups) - $this->maxBackups);
            foreach ($toDelete as $backup) {
                $filePath = $this->backupPath . '/' . $backup['name'];
                if (File::exists($filePath)) {
                    File::delete($filePath);
                    Log::info("Deleted old backup: {$backup['name']}");
                }
            }
        }
    }

    /**
     * Get list of all backups
     */
    public function getBackupsList(): array
    {
        $backups = [];
        
        if (!File::exists($this->backupPath)) {
            return $backups;
        }
        
        $files = File::files($this->backupPath);

        foreach ($files as $file) {
            $backups[] = [
                'name' => $file->getFilename(),
                'size' => $this->formatBytes($file->getSize()),
                'size_bytes' => $file->getSize(),
                'date' => Carbon::createFromTimestamp($file->getMTime())->format('Y-m-d H:i:s'),
                'timestamp' => $file->getMTime(),
                'type' => $this->getBackupType($file->getFilename()),
                'path' => $file->getRealPath()
            ];
        }

        return $backups;
    }

    /**
     * Get backup type from filename
     */
    private function getBackupType(string $filename): string
    {
        if (strpos($filename, 'full_backup') !== false) {
            return 'full';
        } elseif (strpos($filename, 'database_backup') !== false) {
            return 'database';
        } elseif (strpos($filename, 'files_backup') !== false) {
            return 'files';
        }
        return 'unknown';
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

    /**
     * Get disk space information
     */
    public function getDiskSpace(): array
    {
        $total = disk_total_space($this->backupPath);
        $free = disk_free_space($this->backupPath);
        $used = $total - $free;

        return [
            'total' => $this->formatBytes($total),
            'used' => $this->formatBytes($used),
            'free' => $this->formatBytes($free),
            'percentage' => round(($used / $total) * 100, 2),
            'total_bytes' => $total,
            'used_bytes' => $used,
            'free_bytes' => $free
        ];
    }

    /**
     * Delete backup file
     */
    public function deleteBackup(string $filename): bool
    {
        $filePath = $this->backupPath . '/' . $filename;
        
        if (File::exists($filePath)) {
            File::delete($filePath);
            Log::info("Deleted backup: {$filename}");
            return true;
        }
        
        return false;
    }

    /**
     * Validate backup file integrity
     */
    public function validateBackup(string $filename): array
    {
        $filePath = $this->backupPath . '/' . $filename;
        
        if (!File::exists($filePath)) {
            return ['valid' => false, 'error' => 'File not found'];
        }
        
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        
        if ($extension === 'zip') {
            $zip = new ZipArchive();
            $result = $zip->open($filePath, ZipArchive::CHECKCONS);
            
            if ($result === TRUE) {
                $zip->close();
                return ['valid' => true];
            } else {
                return ['valid' => false, 'error' => 'Corrupted ZIP file'];
            }
        } elseif ($extension === 'sql') {
            // Basic SQL file validation
            $content = File::get($filePath);
            if (strpos($content, 'CREATE TABLE') !== false || strpos($content, 'INSERT INTO') !== false) {
                return ['valid' => true];
            } else {
                return ['valid' => false, 'error' => 'Invalid SQL file'];
            }
        }
        
        return ['valid' => true]; // Default to valid for other file types
    }
} 