<?php

return [
    'name' => 'BackupRestore',
    
    /*
    |--------------------------------------------------------------------------
    | Backup Settings
    |--------------------------------------------------------------------------
    |
    | Configure backup behavior and retention policies
    |
    */
    
    // Maximum number of backups to keep (older backups will be automatically deleted)
    'max_backups' => env('BACKUP_MAX_BACKUPS', 10),
    
    // Maximum file size to include in backups (in bytes)
    // Default: 50MB
    'max_file_size' => env('BACKUP_MAX_FILE_SIZE', 50 * 1024 * 1024),
    
    // Backup storage path (relative to storage/app)
    'backup_path' => env('BACKUP_PATH', 'backups'),
    
    /*
    |--------------------------------------------------------------------------
    | Directories to Exclude
    |--------------------------------------------------------------------------
    |
    | List of directories to exclude from file backups
    |
    */
    'exclude_directories' => [
        'node_modules',
        '.git',
        'vendor',
        'storage/logs',
        'storage/framework/cache',
        'storage/framework/sessions',
        'storage/framework/views',
        'storage/app/backups', // Don't backup existing backups
        '.vscode',
        '.idea',
        'tests',
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Additional Directories to Include
    |--------------------------------------------------------------------------
    |
    | Custom directories to include in file backups
    | Format: 'source_path' => 'destination_in_backup'
    |
    */
    'include_directories' => [
        // public_path('custom') => 'public/custom',
        // base_path('custom_config') => 'custom_config',
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Database Settings
    |--------------------------------------------------------------------------
    |
    | Database backup specific settings
    |
    */
    'database' => [
        // Enable compression for database backups
        'compress' => env('BACKUP_DB_COMPRESS', true),
        
        // Chunk size for large table exports (number of rows per chunk)
        'chunk_size' => env('BACKUP_DB_CHUNK_SIZE', 1000),
        
        // Tables to exclude from backup
        'exclude_tables' => [
            'sessions',
            'cache',
            'failed_jobs',
            // 'logs',
        ],
        
        // Use mysqldump if available (faster for large databases)
        'use_mysqldump' => env('BACKUP_USE_MYSQLDUMP', true),
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Security Settings
    |--------------------------------------------------------------------------
    |
    | Security-related backup settings
    |
    */
    'security' => [
        // Encrypt backup files
        'encrypt_backups' => env('BACKUP_ENCRYPT', false),
        
        // Encryption key (leave empty to use app key)
        'encryption_key' => env('BACKUP_ENCRYPTION_KEY', ''),
        
        // Environment variables to mask in .env backup
        'mask_env_keys' => [
            'DB_PASSWORD',
            'APP_KEY',
            'MAIL_PASSWORD',
            'AWS_SECRET_ACCESS_KEY',
            'STRIPE_SECRET',
            'PAYPAL_SECRET',
            'JWT_SECRET',
        ],
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Notification Settings
    |--------------------------------------------------------------------------
    |
    | Configure backup completion notifications
    |
    */
    'notifications' => [
        // Enable email notifications
        'email' => env('BACKUP_EMAIL_NOTIFICATIONS', false),
        
        // Email addresses to notify
        'email_addresses' => [
            env('BACKUP_NOTIFICATION_EMAIL', env('MAIL_FROM_ADDRESS')),
        ],
        
        // Slack webhook URL for notifications
        'slack_webhook' => env('BACKUP_SLACK_WEBHOOK'),
        
        // Discord webhook URL for notifications
        'discord_webhook' => env('BACKUP_DISCORD_WEBHOOK'),
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Scheduled Backup Settings
    |--------------------------------------------------------------------------
    |
    | Configure automatic backup scheduling
    |
    */
    'schedule' => [
        // Enable automatic backups
        'enabled' => env('BACKUP_SCHEDULE_ENABLED', false),
        
        // Backup frequency options: daily, weekly, monthly
        'frequency' => env('BACKUP_SCHEDULE_FREQUENCY', 'daily'),
        
        // Time to run backup (24-hour format)
        'time' => env('BACKUP_SCHEDULE_TIME', '02:00'),
        
        // Day of week for weekly backups (0 = Sunday, 6 = Saturday)
        'day_of_week' => env('BACKUP_SCHEDULE_DAY', 0),
        
        // Day of month for monthly backups (1-31)
        'day_of_month' => env('BACKUP_SCHEDULE_DAY_MONTH', 1),
        
        // Backup types to create automatically
        'backup_types' => [
            'database' => true,
            'files' => true,
            'full' => false, // Only create full backup on demand
        ],
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Cloud Storage Settings
    |--------------------------------------------------------------------------
    |
    | Configure cloud storage for backups
    |
    */
    'cloud_storage' => [
        // Enable cloud storage
        'enabled' => env('BACKUP_CLOUD_ENABLED', false),
        
        // Storage disk to use (must be configured in filesystems.php)
        'disk' => env('BACKUP_CLOUD_DISK', 's3'),
        
        // Path prefix in cloud storage
        'path' => env('BACKUP_CLOUD_PATH', 'backups'),
        
        // Keep local copies after uploading to cloud
        'keep_local' => env('BACKUP_KEEP_LOCAL', true),
        
        // Delete cloud backups after X days (0 = never delete)
        'retention_days' => env('BACKUP_CLOUD_RETENTION', 30),
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Restore Settings
    |--------------------------------------------------------------------------
    |
    | Configure restore behavior
    |
    */
    'restore' => [
        // Create backup before restore
        'backup_before_restore' => env('BACKUP_BEFORE_RESTORE', true),
        
        // Clear cache after restore
        'clear_cache_after_restore' => env('CLEAR_CACHE_AFTER_RESTORE', true),
        
        // Run migrations after database restore
        'run_migrations_after_restore' => env('RUN_MIGRATIONS_AFTER_RESTORE', false),
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Performance Settings
    |--------------------------------------------------------------------------
    |
    | Performance-related settings
    |
    */
    'performance' => [
        // Memory limit for backup operations (in MB)
        'memory_limit' => env('BACKUP_MEMORY_LIMIT', 512),
        
        // Execution time limit (in seconds, 0 = no limit)
        'time_limit' => env('BACKUP_TIME_LIMIT', 300),
        
        // Use background processing for large backups
        'use_queue' => env('BACKUP_USE_QUEUE', false),
        
        // Queue name for backup jobs
        'queue_name' => env('BACKUP_QUEUE_NAME', 'default'),
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Logging Settings
    |--------------------------------------------------------------------------
    |
    | Configure backup logging
    |
    */
    'logging' => [
        // Log level for backup operations
        'level' => env('BACKUP_LOG_LEVEL', 'info'),
        
        // Log channel to use
        'channel' => env('BACKUP_LOG_CHANNEL', 'single'),
        
        // Keep backup logs for X days
        'retention_days' => env('BACKUP_LOG_RETENTION', 30),
    ],
];
