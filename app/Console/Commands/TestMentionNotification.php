<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Task;
use App\Models\TaskComment;
use App\Events\UserMentioned;

class TestMentionNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:mention-notification {mentioned_user_id} {mentioning_user_id} {task_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test the mention notification system';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $mentionedUserId = $this->argument('mentioned_user_id');
            $mentioningUserId = $this->argument('mentioning_user_id');
            $taskId = $this->argument('task_id');

            // Get the users and task
            $mentionedUser = User::findOrFail($mentionedUserId);
            $mentioningUser = User::findOrFail($mentioningUserId);
            $task = Task::findOrFail($taskId);

            $this->info("Testing mention notification:");
            $this->info("- Mentioned User: {$mentionedUser->username} (ID: {$mentionedUser->id})");
            $this->info("- Mentioning User: {$mentioningUser->username} (ID: {$mentioningUser->id})");
            $this->info("- Task: {$task->task_name} (ID: {$task->id})");

            // Create a test comment
            $comment = TaskComment::create([
                'task_id' => $task->id,
                'user_id' => $mentioningUser->id,
                'comment' => "Test mention for @{$mentionedUser->username} - this is a test notification!"
            ]);

            $this->info("- Created test comment (ID: {$comment->id})");

            // Dispatch the mention event
            event(new UserMentioned($mentionedUser, $mentioningUser, $task, $comment));

            $this->info("✅ UserMentioned event dispatched successfully!");
            $this->info("Check the following:");
            $this->info("1. Database 'notificattions' table for new notification");
            $this->info("2. Laravel logs for event processing");
            $this->info("3. Queue jobs table (if using database queue)");
            $this->info("4. Real-time notification if broadcasting is configured");

            return Command::SUCCESS;

        } catch (\Exception $e) {
            $this->error("❌ Error testing mention notification: " . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
