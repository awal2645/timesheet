<?php

namespace App\Events;

use App\Models\User;
use App\Models\Task;
use App\Models\TaskComment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserMentioned implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $mentionedUser;
    public $mentionedBy;
    public $task;
    public $comment;

    /**
     * Create a new event instance.
     */
    public function __construct(User $mentionedUser, User $mentionedBy, Task $task, TaskComment $comment)
    {
        $this->mentionedUser = $mentionedUser;
        $this->mentionedBy = $mentionedBy;
        $this->task = $task;
        $this->comment = $comment;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('user.' . $this->mentionedUser->id),
        ];
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith(): array
    {
        return [
            'type' => 'mention',
            'message' => $this->mentionedBy->username . ' mentioned you in task: ' . $this->task->task_name,
            'task_id' => $this->task->id,
            'task_name' => $this->task->task_name,
            'mentioned_by' => [
                'id' => $this->mentionedBy->id,
                'username' => $this->mentionedBy->username,
            ],
            'comment_id' => $this->comment->id,
            'url' => '/task/' . $this->task->id,
            'timestamp' => now()->toISOString(),
        ];
    }

    /**
     * Get the broadcast event name.
     *
     * @return string
     */
    public function broadcastAs(): string
    {
        return 'user.mentioned';
    }
}
