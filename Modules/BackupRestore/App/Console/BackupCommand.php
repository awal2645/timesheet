<?php

namespace Modules\BackupRestore\App\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Modules\BackupRestore\App\Services\BackupService;

class BackupCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'backup:run {type=full : Type of backup (full, database, files)}';

    /**
     * The console command description.
     */
    protected $description = 'Create application backup';

    protected $backupService;

    public function __construct(BackupService $backupService)
    {
        parent::__construct();
        $this->backupService = $backupService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $type = $this->argument('type');
        
        $this->info("Starting {$type} backup...");
        
        try {
            switch ($type) {
                case 'full':
                    $result = $this->backupService->createFullBackup();
                    $this->info("Full backup created: {$result['backup_file']} ({$result['size']})");
                    break;
                    
                case 'database':
                    $result = $this->backupService->createDatabaseBackup();
                    $this->info("Database backup created: {$result['filename']} ({$result['size']})");
                    break;
                    
                case 'files':
                    $result = $this->backupService->createFilesBackup();
                    $this->info("Files backup created: {$result['filename']} ({$result['size']})");
                    break;
                    
                default:
                    $this->error("Invalid backup type. Use: full, database, or files");
                    return Command::FAILURE;
            }
            
            $this->info("Backup completed successfully!");
            return Command::SUCCESS;
            
        } catch (\Exception $e) {
            $this->error("Backup failed: " . $e->getMessage());
            Log::error("Console backup failed: " . $e->getMessage());
            return Command::FAILURE;
        }
    }
} 