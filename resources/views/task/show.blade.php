@section('title')
    {{ $task->task_name }}
@endsection

<style>
    .info-card {
        @apply bg-card-light dark:bg-card-dark rounded-lg border border-gray-200 dark:border-gray-700 p-6;
    }
    
    .info-label {
        @apply text-sm font-medium text-gray-600 dark:text-gray-400;
    }
    
    .info-value {
        @apply text-base text-gray-900 dark:text-white font-medium;
    }
    
    .status-badge {
        @apply px-3 py-1 rounded-full text-sm font-medium;
    }
    
    .status-pending {
        @apply bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200;
    }
    
    .status-inprogress {
        @apply bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200;
    }
    
    .status-completed {
        @apply bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200;
    }
    
    .priority-low {
        @apply bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200;
    }
    
    .priority-medium {
        @apply bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200;
    }
    
    .priority-high {
        @apply bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200;
    }
    
    .task-type-task {
        @apply bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200;
    }
    
    .task-type-story {
        @apply bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200;
    }
    
    .task-type-bug {
        @apply bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200;
    }
    
    .task-type-epic {
        @apply bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200;
    }
    
    .label-tag {
        @apply inline-block bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200 px-2 py-1 rounded text-sm mr-2 mb-2;
    }
    
    .attachment-item {
        @apply flex items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors;
    }
    
    /* Jira-Style Comment System */
    .comment-item {
        @apply relative group;
    }
    
    .comment-wrapper {
        @apply bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm hover:shadow-md transition-all duration-200 overflow-hidden;
    }
    
    .comment-header {
        @apply flex items-center justify-between p-4 pb-2;
    }
    
    .comment-meta {
        @apply flex items-center gap-3;
    }
    
    .comment-avatar {
        @apply w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white text-xs font-bold flex-shrink-0 shadow-sm;
    }
    
    .comment-author-info {
        @apply flex flex-col;
    }
    
    .comment-author {
        @apply text-sm font-semibold text-gray-900 dark:text-white;
    }
    
    .comment-timestamp {
        @apply text-xs text-gray-500 dark:text-gray-400 flex items-center gap-1;
    }
    
    .comment-edited {
        @apply text-xs text-blue-600 dark:text-blue-400 italic;
    }
    
    .comment-actions {
        @apply flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200;
    }
    
    .comment-action-btn {
        @apply text-xs text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 px-2 py-1 rounded hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-200 cursor-pointer;
    }
    
    .comment-delete-btn {
        @apply text-xs text-gray-500 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-400 px-2 py-1 rounded hover:bg-red-50 dark:hover:bg-red-900/20 transition-all duration-200 cursor-pointer;
    }
    
    .comment-content {
        @apply px-4 pb-4 text-sm text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-wrap;
    }
    
    .comment-edit-form {
        @apply hidden;
    }
    
    .comment-role-badge {
        @apply ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200;
    }
    
    /* Jira-Style Comment Form */
    .jira-comment-form {
        @apply bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm overflow-hidden;
    }
    
    .jira-form-header {
        @apply flex items-center gap-3 p-4 pb-0;
    }
    
    .jira-textarea {
        @apply w-full border-0 resize-none bg-transparent text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-0 p-4 min-h-[80px];
    }
    
    .jira-toolbar {
        @apply flex items-center justify-between border-t border-gray-200 dark:border-gray-700 px-4 py-3 bg-gray-50 dark:bg-gray-900;
    }
    
    .jira-format-buttons {
        @apply flex items-center gap-1;
    }
    
    .jira-format-btn {
        @apply w-8 h-8 flex items-center justify-center text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 rounded transition-colors cursor-pointer;
    }
    
    .jira-submit-btn {
        @apply inline-flex items-center px-4 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-md font-medium text-sm transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2;
    }
    
    .comment-divider {
        @apply border-t border-gray-100 dark:border-gray-700 my-4;
    }
    
    .empty-comments {
        @apply text-center py-12;
    }
    
    .empty-comments-icon {
        @apply w-16 h-16 mx-auto mb-4 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center;
    }
    
    /* Mention System - Clean Professional Style */
    .mention-dropdown {
        @apply absolute bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-xl max-h-60 overflow-y-auto z-50 min-w-[300px];
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        animation: mentionFadeIn 0.15s ease-out;
        transform-origin: top;
    }
    
    @keyframes mentionFadeIn {
        from {
            opacity: 0;
            transform: translateY(-4px) scale(0.98);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }
    
    .mention-item {
        @apply px-4 py-3 cursor-pointer flex items-center gap-3 text-sm transition-all duration-150 border-b border-gray-50 dark:border-gray-700/50;
    }
    
    .mention-item:last-child {
        border-bottom: none;
    }
    
    .mention-item:hover,
    .mention-item.selected {
        @apply bg-blue-50 dark:bg-blue-900/20;
    }
    
    .mention-item.selected {
        @apply bg-blue-100 dark:bg-blue-900/30;
        box-shadow: inset 3px 0 0 #3b82f6;
    }
    
    .mention-avatar {
        @apply w-10 h-10 rounded-full flex items-center justify-center text-white text-sm font-semibold flex-shrink-0 bg-gradient-to-br from-blue-500 to-indigo-600;
        transition: all 0.15s ease;
    }
    
    .mention-avatar.employee {
        @apply bg-gradient-to-br from-blue-500 to-indigo-600;
    }
    
    .mention-item:hover .mention-avatar,
    .mention-item.selected .mention-avatar {
        transform: scale(1.05);
    }
    
    .mention-user-info {
        @apply flex-1 min-w-0;
    }
    
    .mention-name {
        @apply font-medium text-gray-900 dark:text-white text-sm truncate leading-tight;
    }
    
    .mention-email {
        @apply text-xs text-gray-500 dark:text-gray-400 truncate;
    }
    
    .mention-highlight {
        @apply bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 px-1 py-0.5 rounded font-semibold;
    }
    
    .textarea-wrapper {
        @apply relative;
    }

    .mention-loading {
        @apply px-4 py-6 text-center text-gray-500 dark:text-gray-400 text-sm;
    }

    .mention-loading i {
        @apply block text-xl mb-2 text-gray-400;
    }

    /* Simple scrollbar */
    .mention-dropdown::-webkit-scrollbar {
        width: 6px;
    }

    .mention-dropdown::-webkit-scrollbar-track {
        background: transparent;
    }

    .mention-dropdown::-webkit-scrollbar-thumb {
        background: rgba(156, 163, 175, 0.4);
        border-radius: 3px;
    }

    .mention-dropdown::-webkit-scrollbar-thumb:hover {
        background: rgba(156, 163, 175, 0.6);
    }

    /* Clean header */
    .mention-header {
        @apply px-4 py-3 bg-gray-50 dark:bg-gray-700/30 border-b border-gray-200 dark:border-gray-600 text-xs font-medium text-gray-600 dark:text-gray-300 flex items-center gap-2;
    }

    /* Clean animation for mention insertion */
    .mention-inserting {
        animation: mentionInsert 0.3s ease-out;
    }

    @keyframes mentionInsert {
        0% { 
            background-color: rgb(59 130 246 / 0.2); 
        }
        100% { 
            background-color: transparent; 
        }
    }
</style>

<x-app-layout>
    <div class="p-6">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <div class="mb-4">
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-3">
                            {{ $task->task_name }}
                        </h1>
                        <div class="flex items-center gap-3 flex-wrap">
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium {{ $task->status === 'pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300' : ($task->status === 'inprogress' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300' : 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300') }}">
                                <div class="w-2 h-2 rounded-full mr-2 {{ $task->status === 'pending' ? 'bg-yellow-500' : ($task->status === 'inprogress' ? 'bg-blue-500' : 'bg-green-500') }}"></div>
                                {{ ucfirst($task->status) }}
                            </span>
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium {{ $task->priority === 'low' ? 'bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-300' : ($task->priority === 'medium' ? 'bg-orange-100 text-orange-700 dark:bg-orange-900/30 dark:text-orange-300' : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300') }}">
                                <i class="fa-solid {{ $task->priority === 'low' ? 'fa-chevron-down' : ($task->priority === 'medium' ? 'fa-minus' : 'fa-chevron-up') }} mr-2 text-xs"></i>
                                {{ ucfirst($task->priority) }} Priority
                            </span>
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium {{ $task->task_type === 'task' ? 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300' : ($task->task_type === 'story' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300' : ($task->task_type === 'bug' ? 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300' : 'bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-300')) }}">
                                <i class="fa-solid {{ $task->task_type === 'task' ? 'fa-check-square' : ($task->task_type === 'story' ? 'fa-book' : ($task->task_type === 'bug' ? 'fa-bug' : 'fa-layer-group')) }} mr-2 text-xs"></i>
                                {{ ucfirst($task->task_type) }}
                            </span>
                        </div>
                    </div>
                    
                    @if($task->description)
                        <div class="mb-4 p-4 bg-gray-50 dark:bg-gray-800/50 rounded-lg border-l-4 border-blue-500">
                            <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                                {{ $task->description }}
                            </p>
                        </div>
                    @endif
                    
                    @if($task->labels && count($task->labels) > 0)
                        <div class="mb-4">
                            <div class="flex items-center gap-2 mb-2">
                                <i class="fa-solid fa-tags text-gray-400 text-sm"></i>
                                <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Labels</span>
                            </div>
                            <div class="flex flex-wrap gap-2">
                                @foreach($task->labels as $label)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900/30 dark:text-indigo-300">
                                        {{ $label }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                
                <div class="flex gap-3 ml-6">
                    <a href="{{ route('task.edit', $task->id) }}" 
                       class="inline-flex items-center px-4 py-2.5 text-blue-700 dark:text-blue-300 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/30 transition-all duration-200 font-medium text-sm">
                        <i class="fa-solid fa-edit mr-2"></i>
                        Edit Task
                    </a>
                    <a href="{{ route('task.index') }}" 
                       class="inline-flex items-center px-4 py-2.5 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200 font-medium text-sm">
                        <i class="fa-solid fa-arrow-left mr-2"></i>
                        Back to Tasks
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Task Details -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-info-circle text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Task Details</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1">
                            <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Due Date</div>
                            <div class="text-base font-medium text-gray-900 dark:text-white flex items-center gap-2">
                                <i class="fa-solid fa-calendar text-gray-400 text-sm"></i>
                                {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}
                                @if(\Carbon\Carbon::parse($task->due_date)->isPast() && $task->status !== 'completed')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300">
                                        <i class="fa-solid fa-exclamation-triangle mr-1"></i>
                                        Overdue
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        @if($task->estimated_hours)
                            <div class="space-y-1">
                                <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Estimated Hours</div>
                                <div class="text-base font-medium text-gray-900 dark:text-white flex items-center gap-2">
                                    <i class="fa-solid fa-clock text-gray-400 text-sm"></i>
                                    {{ $task->estimated_hours }} hours
                                </div>
                            </div>
                        @endif
                        
                        @if($task->time)
                            <div class="space-y-1">
                                <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Time Logged</div>
                                <div class="text-base font-medium text-gray-900 dark:text-white flex items-center gap-2">
                                    <i class="fa-solid fa-stopwatch text-gray-400 text-sm"></i>
                                    {{ $task->time }}
                                </div>
                            </div>
                        @endif
                        
                        <div class="space-y-1">
                            <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Created</div>
                            <div class="text-base font-medium text-gray-900 dark:text-white flex items-center gap-2">
                                <i class="fa-solid fa-plus text-gray-400 text-sm"></i>
                                {{ $task->created_at->format('M d, Y') }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Assignment Details -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-users text-green-600 dark:text-green-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Assignment Details</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @if($task->employer)
                            <div class="space-y-1">
                                <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Employer</div>
                                <div class="text-base font-medium text-gray-900 dark:text-white flex items-center gap-2">
                                    <i class="fa-solid fa-building text-gray-400 text-sm"></i>
                                    {{ $task->employer->employer_name }}
                                </div>
                            </div>
                        @endif
                        
                        @if($task->employee)
                            <div class="space-y-1">
                                <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Assigned To</div>
                                <div class="text-base font-medium text-gray-900 dark:text-white flex items-center gap-2">
                                    <i class="fa-solid fa-user text-gray-400 text-sm"></i>
                                    {{ $task->employee->employee_name }}
                                </div>
                            </div>
                        @endif
                        
                        @if($task->project)
                            <div class="space-y-1">
                                <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Project</div>
                                <div class="text-base font-medium text-gray-900 dark:text-white flex items-center gap-2">
                                    <i class="fa-solid fa-folder text-gray-400 text-sm"></i>
                                    {{ $task->project->project_name }}
                                </div>
                            </div>
                        @endif
                        
                        @if($task->project && $task->project->client)
                            <div class="space-y-1">
                                <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Client</div>
                                <div class="text-base font-medium text-gray-900 dark:text-white flex items-center gap-2">
                                    <i class="fa-solid fa-handshake text-gray-400 text-sm"></i>
                                    {{ $task->project->client->client_name }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Attachments -->
                @if($task->attachments && $task->attachments->count() > 0)
                    <div class="info-card">
                        <h3 class="text-lg font-semibold mb-6 text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-700 pb-2">
                            Attachments ({{ $task->attachments->count() }})
                        </h3>
                        <div class="space-y-3">
                            @foreach($task->attachments as $attachment)
                                <div class="attachment-item">
                                    <div class="flex-shrink-0">
                                        @if(str_starts_with($attachment->mime_type, 'image/'))
                                            <i class="fa-solid fa-image text-2xl text-blue-500"></i>
                                        @elseif($attachment->file_type === 'pdf')
                                            <i class="fa-solid fa-file-pdf text-2xl text-red-500"></i>
                                        @elseif(in_array($attachment->file_type, ['doc', 'docx']))
                                            <i class="fa-solid fa-file-word text-2xl text-blue-600"></i>
                                        @elseif(in_array($attachment->file_type, ['xls', 'xlsx']))
                                            <i class="fa-solid fa-file-excel text-2xl text-green-600"></i>
                                        @else
                                            <i class="fa-solid fa-file text-2xl text-gray-500"></i>
                                        @endif
                                    </div>
                                    <div class="flex-1 ml-4 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                            {{ $attachment->original_name }}
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ number_format($attachment->file_size / 1024 / 1024, 2) }} MB
                                        </p>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <a href="{{ Storage::url($attachment->file_path) }}" target="_blank"
                                           class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-200 p-2">
                                            <i class="fa-solid fa-download"></i>
                                        </a>
                                        <form method="POST" action="{{ route('task.deleteAttachment', $attachment->id) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    onclick="return confirm('Are you sure you want to delete this attachment?')"
                                                    class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-200 p-2">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Comments -->
                <div class="info-card">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            <i class="fa-solid fa-comments mr-2 text-blue-500"></i>
                            Activity
                        </h3>
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            {{ $task->comments ? $task->comments->count() : 0 }} 
                            {{ $task->comments && $task->comments->count() == 1 ? 'comment' : 'comments' }}
                        </span>
                    </div>
                    
                    <!-- Add Comment Form - Jira Style -->
                    <div class="mb-6">
                        <div class="flex items-start gap-3 mb-4">
                            <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white text-xs font-bold flex-shrink-0 shadow-sm">
                                {{ substr(auth()->user()->username ?? 'U', 0, 1) }}
                            </div>
                            <div class="flex-1">
                                <span class="text-sm font-medium text-gray-900 dark:text-white">
                                    {{ auth()->user()->username ?? 'You' }}
                                </span>
                            </div>
                        </div>
                        
                        <form method="POST" action="{{ route('task.addComment', $task->id) }}" class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm overflow-hidden focus-within:border-blue-500 focus-within:ring-2 focus-within:ring-blue-500/20 transition-all duration-200 hover:shadow-md">
                            @csrf
                            <div class="p-4">
                                <div class="textarea-wrapper">
                                    <textarea name="comment" required
                                              class="w-full border-0 resize-none bg-transparent text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-0 text-sm leading-relaxed"
                                              placeholder="Add a comment... (Type @ to mention assigned employee)"
                                              rows="3"
                                              id="main-comment-textarea"></textarea>
                                    <div id="mention-dropdown" class="mention-dropdown hidden !sticky" ></div>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between border-t border-gray-200 dark:border-gray-700 px-4 py-3 bg-gray-50 dark:bg-gray-900/50">
                                <div class="flex items-center gap-3">
                                    <div class="flex items-center gap-1">
                                        <button type="button" class="format-btn w-8 h-8 flex items-center justify-center text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-md transition-colors" title="Bold" data-format="bold">
                                            <i class="fa-solid fa-bold text-xs"></i>
                                        </button>
                                        <button type="button" class="format-btn w-8 h-8 flex items-center justify-center text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-md transition-colors" title="Italic" data-format="italic">
                                            <i class="fa-solid fa-italic text-xs"></i>
                                        </button>
                                        <button type="button" class="format-btn w-8 h-8 flex items-center justify-center text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-md transition-colors" title="Code" data-format="code">
                                            <i class="fa-solid fa-code text-xs"></i>
                                        </button>
                                    </div>
                                    <div class="w-px h-6 bg-gray-300 dark:bg-gray-600"></div>
                                    <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                                        <i class="fa-solid fa-user text-blue-500"></i>
                                        <span>Type @ to mention employee</span>
                                        <span class="hidden sm:block">• Use ↑↓ to navigate • Enter to select</span>
                                        <div class="mention-status opacity-0 transition-opacity duration-300"></div>
                                    </div>
                                </div>
                                <button type="submit" class="inline-flex items-center px-4 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-lg font-medium text-sm transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed shadow-sm hover:shadow-md">
                                    <i class="fa-solid fa-paper-plane mr-2"></i>
                                    <span class="submit-text">Comment</span>
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Comments List -->
                    @if($task->comments && $task->comments->count() > 0)
                        <div class="space-y-6">
                            @foreach($task->comments as $index => $comment)
                                <div class="group" id="comment-{{ $comment->id }}">
                                    <div class="flex items-start gap-3">
                                        <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white text-xs font-bold flex-shrink-0 shadow-sm">
                                            {{ substr($comment->user->username ?? 'U', 0, 1) }}
                                        </div>
                                        
                                        <div class="flex-1 min-w-0">
                                            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm">
                                                <div class="p-4 pb-3">
                                                    <div class="flex items-center justify-between mb-2">
                                                        <div class="flex items-center gap-2">
                                                            <span class="text-sm font-semibold text-gray-900 dark:text-white">
                                                                {{ $comment->user->username ?? 'Unknown User' }}
                                                            </span>
                                                            @if($comment->user_id === $task->employee_id)
                                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                                                    <i class="fa-solid fa-user-tag mr-1"></i>
                                                                    Assignee
                                                                </span>
                                                            @endif
                                                        </div>
                                                        
                                                        @if(auth()->id() === $comment->user_id || auth()->user()->role === 'admin')
                                                            <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                                                <button onclick="editComment({{ $comment->id }})" 
                                                                        class="text-xs text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 px-2 py-1 rounded hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-200">
                                                                    <i class="fa-solid fa-edit mr-1"></i>
                                                                    Edit
                                                                </button>
                                                                <button onclick="deleteComment({{ $comment->id }})" 
                                                                        class="text-xs text-gray-500 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-400 px-2 py-1 rounded hover:bg-red-50 dark:hover:bg-red-900/20 transition-all duration-200">
                                                                    <i class="fa-solid fa-trash mr-1"></i>
                                                                    Delete
                                                                </button>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    
                                                    <div class="text-xs text-gray-500 dark:text-gray-400 mb-3 flex items-center gap-1">
                                                        <i class="fa-regular fa-clock"></i>
                                                        {{ $comment->created_at->diffForHumans() }}
                                                        @if($comment->edited_at)
                                                            <span class="text-blue-600 dark:text-blue-400 italic">
                                                                • edited {{ $comment->edited_at->diffForHumans() }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                    
                                                    <div class="comment-content text-sm text-gray-700 dark:text-gray-300 leading-relaxed" id="comment-content-{{ $comment->id }}">
                                                        @php
                                                            $content = e($comment->comment);
                                                            // Basic markdown-like formatting
                                                            $content = preg_replace('/\*\*(.*?)\*\*/', '<strong>$1</strong>', $content);
                                                            $content = preg_replace('/\*(.*?)\*/', '<em>$1</em>', $content);
                                                            $content = preg_replace('/`(.*?)`/', '<code class="bg-gray-100 dark:bg-gray-700 px-1 rounded text-sm">$1</code>', $content);
                                                            $content = preg_replace('/^> (.*)$/m', '<blockquote class="border-l-4 border-gray-300 pl-4 italic text-gray-600 dark:text-gray-400">$1</blockquote>', $content);
                                                            $content = preg_replace('/^- (.*)$/m', '<li class="ml-4">$1</li>', $content);
                                                            // Highlight @mentions
                                                            $content = preg_replace('/@(\w+)/', '<span class="mention-highlight">@$1</span>', $content);
                                                            $content = nl2br($content);
                                                        @endphp
                                                        {!! $content !!}
                                                    </div>
                                                    
                                                    <!-- Edit Form (Hidden by default) -->
                                                    <div class="comment-edit-form hidden mt-3" id="edit-form-{{ $comment->id }}">
                                                        <form method="POST" action="{{ route('task.updateComment', $comment->id) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="textarea-wrapper">
                                                                <textarea name="comment" rows="3" required
                                                                          class="w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none p-3 edit-textarea"
                                                                          data-comment-id="{{ $comment->id }}">{{ $comment->comment }}</textarea>
                                                                <div id="mention-dropdown-edit-{{ $comment->id }}" class="mention-dropdown hidden !sticky" ></div>
                                                            </div>
                                                            <div class="flex justify-end gap-2 mt-3">
                                                                <button type="button" onclick="cancelEdit({{ $comment->id }})"
                                                                        class="px-3 py-2 text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-md hover:bg-gray-200 dark:hover:bg-gray-600 text-sm transition-colors">
                                                                    Cancel
                                                                </button>
                                                                <button type="submit"
                                                                        class="px-3 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700 text-sm transition-colors">
                                                                    <i class="fa-solid fa-save mr-1"></i>
                                                                    Save
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center">
                                <i class="fa-solid fa-comments text-2xl text-gray-400"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No activity yet</h3>
                            <p class="text-gray-500 dark:text-gray-400 max-w-sm mx-auto">
                                Be the first to comment on this task. Share updates, ask questions, or provide feedback.
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Quick Actions -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-bolt text-purple-600 dark:text-purple-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Quick Actions</h3>
                    </div>
                    <div class="space-y-4">
                        <!-- Status Update -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Update Status</label>
                            <form method="POST" action="{{ route('task.updateStatus', $task->id) }}" class="w-full">
                                @csrf
                                <div class="flex gap-2">
                                    <select name="status" 
                                            class="flex-1 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                                        <option value="pending" {{ $task->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="inprogress" {{ $task->status === 'inprogress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                    </select>
                                    <button type="submit"
                                            class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 text-sm font-medium transition-colors">
                                        Update
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Time Update -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Log Time</label>
                            <form method="POST" action="{{ route('task.updateTime', $task->id) }}" class="w-full">
                                @csrf
                                <div class="flex gap-2">
                                    <input type="text" name="time" value="{{ $task->time }}" placeholder="00:00"
                                           class="flex-1 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                                    <button type="submit"
                                            class="px-4 py-2 text-white bg-green-600 rounded-lg hover:bg-green-700 text-sm font-medium transition-colors">
                                        Log
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Task Meta -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-chart-line text-indigo-600 dark:text-indigo-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Task Information</h3>
                    </div>
                    <div class="space-y-4 text-sm">
                        <div class="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                            <span class="text-gray-600 dark:text-gray-400 font-medium">Task ID:</span>
                            <span class="text-gray-900 dark:text-white font-mono bg-gray-200 dark:bg-gray-600 px-2 py-1 rounded text-xs">#{{ $task->id }}</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                            <span class="text-gray-600 dark:text-gray-400 font-medium">Created:</span>
                            <span class="text-gray-900 dark:text-white">{{ $task->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                            <span class="text-gray-600 dark:text-gray-400 font-medium">Updated:</span>
                            <span class="text-gray-900 dark:text-white">{{ $task->updated_at->diffForHumans() }}</span>
                        </div>
                        @if($task->estimated_hours && $task->time)
                            @php
                                [$hours, $minutes] = explode(':', $task->time);
                                $actualHours = $hours + ($minutes / 60);
                                $progress = ($actualHours / $task->estimated_hours) * 100;
                            @endphp
                            <div class="p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                                <div class="flex justify-between mb-2">
                                    <span class="text-gray-600 dark:text-gray-400 font-medium">Progress:</span>
                                    <span class="text-gray-900 dark:text-white font-semibold">{{ number_format($progress, 1) }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 dark:bg-gray-600 rounded-full h-3 overflow-hidden">
                                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-3 rounded-full transition-all duration-300" style="width: {{ min($progress, 100) }}%"></div>
                                </div>
                                <div class="flex justify-between text-xs text-gray-500 dark:text-gray-400 mt-1">
                                    <span>{{ $task->time }} logged</span>
                                    <span>{{ $task->estimated_hours }}h estimated</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Danger Zone -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-red-200 dark:border-red-800 p-6 shadow-sm">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-red-100 dark:bg-red-900/30 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-exclamation-triangle text-red-600 dark:text-red-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-red-600 dark:text-red-400">Danger Zone</h3>
                    </div>
                    <form method="POST" action="{{ route('task.destroy', $task->id) }}" class="w-full">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                onclick="return confirm('Are you sure you want to delete this task? This action cannot be undone.')"
                                class="w-full inline-flex items-center justify-center px-4 py-3 text-red-700 dark:text-red-300 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg hover:bg-red-100 dark:hover:bg-red-900/30 transition-colors font-medium">
                            <i class="fa-solid fa-trash mr-2"></i>
                            Delete Task
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-resize textareas
        const textareas = document.querySelectorAll('textarea');
        textareas.forEach(function(textarea) {
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = this.scrollHeight + 'px';
            });
        });

        // Format button functionality - Improved
        document.querySelectorAll('.format-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const format = this.getAttribute('data-format');
                const textarea = this.closest('form').querySelector('textarea');
                handleFormatting(textarea, format);
            });
        });

        // Focus enhancement for comment form
        const commentTextarea = document.querySelector('form textarea[name="comment"]');
        if (commentTextarea) {
            commentTextarea.addEventListener('focus', function() {
                const form = this.closest('form');
                form.style.borderColor = '#3b82f6';
                form.style.boxShadow = '0 0 0 3px rgba(59, 130, 246, 0.1)';
            });
            
            commentTextarea.addEventListener('blur', function() {
                const form = this.closest('form');
                form.style.borderColor = '';
                form.style.boxShadow = '';
            });
        }

        // Initialize mention functionality
        initializeMentions();
    });

    // Mention functionality - Completely rewritten for reliability
    let mentionUsers = [];
    let activeMentionState = null;

    async function initializeMentions() {
        try {
            const response = await fetch('{{ url("/api/mention-users") }}?task_id={{ $task->id }}', {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            });
            
            if (response.ok) {
                mentionUsers = await response.json();
                console.log('Loaded mention users:', mentionUsers.length);
                
                // Show success indicator
                showMentionStatus('Mention system ready', 'success');
            } else {
                throw new Error('Failed to load users');
            }
        } catch (error) {
            console.error('Failed to load mention users:', error);
            mentionUsers = [];
            showMentionStatus('Mention system unavailable', 'error');
        }

        // Setup mention functionality for all textareas
        document.querySelectorAll('textarea').forEach(textarea => {
            setupMentionForTextarea(textarea);
        });
    }

    function setupMentionForTextarea(textarea) {
        // Find the corresponding dropdown
        let dropdown = null;
        
        if (textarea.id === 'main-comment-textarea') {
            dropdown = document.getElementById('mention-dropdown');
        } else if (textarea.classList.contains('edit-textarea')) {
            const commentId = textarea.getAttribute('data-comment-id');
            dropdown = document.getElementById(`mention-dropdown-edit-${commentId}`);
        }

        if (!dropdown) {
            console.warn('No dropdown found for textarea');
            return;
        }

        let mentionState = {
            isActive: false,
            startPosition: -1,
            query: '',
            selectedIndex: -1,
            filteredUsers: [],
            targetTextarea: textarea  // Store reference to specific textarea
        };

        // Input event handler
        textarea.addEventListener('input', function(e) {
            handleMentionInput(textarea, dropdown, mentionState);
        });

        // Keydown event handler
        textarea.addEventListener('keydown', function(e) {
            if (mentionState.isActive && dropdown && !dropdown.classList.contains('hidden')) {
                handleMentionKeydown(e, textarea, dropdown, mentionState);
            }
        });

        // Click outside to close
        document.addEventListener('click', function(e) {
            if (!textarea.contains(e.target) && !dropdown.contains(e.target)) {
                closeMentionDropdown(dropdown, mentionState);
            }
        });
    }

    function handleMentionInput(textarea, dropdown, mentionState) {
        const value = textarea.value;
        const cursorPos = textarea.selectionStart;
        
        // Find @ before cursor
        const textBeforeCursor = value.substring(0, cursorPos);
        const lastAtIndex = textBeforeCursor.lastIndexOf('@');
        
        if (lastAtIndex === -1) {
            closeMentionDropdown(dropdown, mentionState);
            return;
        }
        
        // Get text after @
        const textAfterAt = textBeforeCursor.substring(lastAtIndex + 1);
        
        // Check if it's a valid mention (no spaces or newlines)
        if (textAfterAt.includes(' ') || textAfterAt.includes('\n')) {
            closeMentionDropdown(dropdown, mentionState);
            return;
        }
        
        // Update mention state
        mentionState.isActive = true;
        mentionState.startPosition = lastAtIndex;
        mentionState.query = textAfterAt.toLowerCase();
        
        // Filter users by email primarily
        mentionState.filteredUsers = mentionUsers.filter(user => 
            (user.email && user.email.toLowerCase().includes(mentionState.query)) ||
            user.username.toLowerCase().includes(mentionState.query) ||
            (user.name && user.name.toLowerCase().includes(mentionState.query))
        );
        
        if (mentionState.filteredUsers.length > 0) {
            showMentionDropdown(textarea, dropdown, mentionState);
        } else {
            closeMentionDropdown(dropdown, mentionState);
        }
    }

    function handleMentionKeydown(e, textarea, dropdown, mentionState) {
        const { filteredUsers } = mentionState;
        
        if (filteredUsers.length === 0) return;
        
        switch (e.key) {
            case 'ArrowDown':
                e.preventDefault();
                mentionState.selectedIndex = Math.min(mentionState.selectedIndex + 1, filteredUsers.length - 1);
                updateMentionSelection(dropdown, mentionState.selectedIndex);
                break;
                
            case 'ArrowUp':
                e.preventDefault();
                mentionState.selectedIndex = Math.max(mentionState.selectedIndex - 1, 0);
                updateMentionSelection(dropdown, mentionState.selectedIndex);
                break;
                
            case 'Enter':
            case 'Tab':
                e.preventDefault();
                if (mentionState.selectedIndex >= 0 && filteredUsers[mentionState.selectedIndex]) {
                    insertMention(mentionState.targetTextarea, filteredUsers[mentionState.selectedIndex], mentionState);
                    closeMentionDropdown(dropdown, mentionState);
                }
                break;
                
            case 'Escape':
                e.preventDefault();
                closeMentionDropdown(dropdown, mentionState);
                break;
        }
    }

    function updateMentionSelection(dropdown, selectedIndex) {
        const items = dropdown.querySelectorAll('.mention-item');
        
        items.forEach((item, index) => {
            item.classList.remove('selected');
            if (index === selectedIndex) {
                item.classList.add('selected');
                // Scroll into view if needed
                item.scrollIntoView({ 
                    block: 'nearest', 
                    behavior: 'smooth' 
                });
            }
        });
    }

    function showMentionDropdown(textarea, dropdown, mentionState) {
        dropdown.innerHTML = '';
        
        // Add header
        const header = document.createElement('div');
        header.className = 'mention-header';
        header.innerHTML = `
            <i class="fa-solid fa-user text-blue-500"></i>
            <span>Assigned employee</span>
            <span class="ml-auto text-gray-400">${mentionState.filteredUsers.length} available</span>
        `;
        dropdown.appendChild(header);
        
        if (mentionState.filteredUsers.length === 0) {
            // Show no results message
            const noResults = document.createElement('div');
            noResults.className = 'mention-loading';
            noResults.innerHTML = `
                <i class="fa-solid fa-user-slash"></i>
                <div class="font-medium">No employee assigned</div>
                <div class="text-xs mt-1">This task has no assigned employee to mention</div>
            `;
            dropdown.appendChild(noResults);
        } else {
            // Add all users (employees only now)
            mentionState.filteredUsers.forEach((user, index) => {
                const item = createMentionItem(user, index, mentionState);
                dropdown.appendChild(item);
            });
            
            // Set first item as selected
            if (mentionState.filteredUsers.length > 0) {
                mentionState.selectedIndex = 0;
                dropdown.querySelector('.mention-item').classList.add('selected');
            }
        }
        
        dropdown.classList.remove('hidden');
        positionDropdown(dropdown, textarea);
    }

    function createMentionItem(user, itemIndex, mentionState) {
        const item = document.createElement('div');
        item.className = 'mention-item';
        item.setAttribute('data-index', itemIndex);
        
        // Show only email for clean display
        const email = user.email || '';
        const name = user.name || '';
        
        // Create initial from name first, then email username part
        let initial = '';
        if (name) {
            initial = name.charAt(0).toUpperCase();
        } else if (email) {
            // Get the part before @ in email
            const emailUsername = email.split('@')[0];
            initial = emailUsername.charAt(0).toUpperCase();
        } else {
            initial = 'U'; // Default fallback
        }
        
        item.innerHTML = `
            <div class="mention-user-info">
                <div class="mention-name">${email}</div>
            </div>
        `;
        
        // Mouse events for hover selection
        item.addEventListener('mouseenter', function() {
            const dropdown = this.closest('.mention-dropdown');
            dropdown.querySelectorAll('.mention-item').forEach(i => i.classList.remove('selected'));
            this.classList.add('selected');
            mentionState.selectedIndex = itemIndex;
        });
        
        // Click handler - use the specific target textarea from mentionState
        item.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            console.log('Mention item clicked, targeting textarea:', mentionState.targetTextarea.id || mentionState.targetTextarea.className);
            insertMention(mentionState.targetTextarea, user, mentionState);
            const dropdown = this.closest('.mention-dropdown');
            closeMentionDropdown(dropdown, mentionState);
        });
        
        return item;
    }

    function insertMention(textarea, user, mentionState) {
        console.log('Inserting mention into textarea:', textarea.id || textarea.className, 'for user:', user.username);
        
        const value = textarea.value;
        const beforeMention = value.substring(0, mentionState.startPosition);
        const afterCursor = value.substring(textarea.selectionStart);
        
        const mentionText = `@${user.username}`;
        const newValue = beforeMention + mentionText + ' ' + afterCursor;
        
        // Add visual feedback
        textarea.classList.add('mention-inserting');
        setTimeout(() => {
            textarea.classList.remove('mention-inserting');
        }, 300);
        
        // Update textarea
        textarea.value = newValue;
        
        // Set cursor position
        const newCursorPos = mentionState.startPosition + mentionText.length + 1;
        textarea.setSelectionRange(newCursorPos, newCursorPos);
        textarea.focus();
        
        // Trigger events
        textarea.dispatchEvent(new Event('input', { bubbles: true }));
        
        // Auto-resize
        textarea.style.height = 'auto';
        textarea.style.height = textarea.scrollHeight + 'px';
        
        // Show success feedback
        showMentionStatus(`Mentioned @${user.username}`, 'success');
    }

    function closeMentionDropdown(dropdown, mentionState) {
        dropdown.classList.add('hidden');
        dropdown.innerHTML = '';
        mentionState.isActive = false;
        mentionState.startPosition = -1;
        mentionState.query = '';
        mentionState.selectedIndex = -1;
        mentionState.filteredUsers = [];
    }

    function positionDropdown(dropdown, textarea) {
        const textareaRect = textarea.getBoundingClientRect();
        const dropdownHeight = 240;
        const dropdownWidth = 300;
        
        // Always position at bottom of textarea with some spacing
        let top = textareaRect.bottom + 8;
        let left = textareaRect.left;
        
        // Adjust if dropdown would go beyond right edge
        if (left + dropdownWidth > window.innerWidth) {
            left = window.innerWidth - dropdownWidth - 20;
        }
        
        // Ensure minimum left position
        if (left < 20) {
            left = 20;
        }
        
        // If dropdown would go below viewport, show above instead
        if (top + dropdownHeight > window.innerHeight) {
            top = textareaRect.top - dropdownHeight - 8;
        }
        
        dropdown.style.position = 'fixed';
        dropdown.style.top = top + 'px';
        dropdown.style.left = left + 'px';
        dropdown.style.width = dropdownWidth + 'px';
        dropdown.style.zIndex = '9999';
        dropdown.style.maxHeight = dropdownHeight + 'px';
    }

    // Improved text formatting
    function handleFormatting(textarea, type) {
        const start = textarea.selectionStart;
        const end = textarea.selectionEnd;
        const selectedText = textarea.value.substring(start, end);
        let replacement = '';
        let cursorOffset = 0;

        switch(type) {
            case 'bold':
                replacement = `**${selectedText || 'bold text'}**`;
                cursorOffset = selectedText ? 0 : 2; // Position cursor inside ** if no selection
                break;
            case 'italic':
                replacement = `*${selectedText || 'italic text'}*`;
                cursorOffset = selectedText ? 0 : 1; // Position cursor inside * if no selection
                break;
            case 'code':
                replacement = `\`${selectedText || 'code'}\``;
                cursorOffset = selectedText ? 0 : 1; // Position cursor inside ` if no selection
                break;
        }

        // Insert the replacement text
        textarea.setRangeText(replacement, start, end, 'end');
        
        // If there was no selected text, position cursor appropriately
        if (!selectedText && cursorOffset > 0) {
            const newPos = start + replacement.length - cursorOffset - (replacement.length - selectedText.length - 2 * cursorOffset);
            textarea.setSelectionRange(newPos, newPos);
        }
        
        textarea.focus();
        
        // Trigger resize
        textarea.style.height = 'auto';
        textarea.style.height = textarea.scrollHeight + 'px';
    }

    // Edit comment functionality
    function editComment(commentId) {
        const commentContent = document.getElementById(`comment-content-${commentId}`);
        const editForm = document.getElementById(`edit-form-${commentId}`);
        
        if (commentContent && editForm) {
            commentContent.style.display = 'none';
            editForm.style.display = 'block';
            
            // Focus on the textarea
            const textarea = editForm.querySelector('textarea');
            if (textarea) {
                textarea.focus();
                // Move cursor to end
                textarea.setSelectionRange(textarea.value.length, textarea.value.length);
                // Auto-resize
                textarea.style.height = 'auto';
                textarea.style.height = textarea.scrollHeight + 'px';
                
                // Initialize mention system for this textarea if not already done
                if (!textarea.dataset.mentionInitialized) {
                    setupMentionForTextarea(textarea);
                    textarea.dataset.mentionInitialized = 'true';
                    console.log('Mention system initialized for edit textarea:', commentId);
                }
            }
        }
    }

    // Cancel edit functionality
    function cancelEdit(commentId) {
        const commentContent = document.getElementById(`comment-content-${commentId}`);
        const editForm = document.getElementById(`edit-form-${commentId}`);
        
        if (commentContent && editForm) {
            commentContent.style.display = 'block';
            editForm.style.display = 'none';
        }
    }

    // Delete comment functionality
    function deleteComment(commentId) {
        // Create a modern confirmation dialog
        const confirmDialog = document.createElement('div');
        confirmDialog.className = 'fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center';
        confirmDialog.innerHTML = `
            <div class="bg-white dark:bg-gray-800 rounded-lg p-6 max-w-md mx-4 shadow-xl">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Delete Comment</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-6">Are you sure you want to delete this comment? This action cannot be undone.</p>
                <div class="flex justify-end gap-3">
                    <button onclick="this.closest('.fixed').remove()" class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-md hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                        Cancel
                    </button>
                    <button onclick="confirmDelete(${commentId})" class="px-4 py-2 text-white bg-red-600 rounded-md hover:bg-red-700 transition-colors">
                        Delete
                    </button>
                </div>
            </div>
        `;
        document.body.appendChild(confirmDialog);
    }

    // Confirm delete function
    function confirmDelete(commentId) {
        // Remove the dialog
        document.querySelector('.fixed.inset-0').remove();
        
        // Create a form to delete the comment
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `{{ url('task/comment') }}/${commentId}`;
        form.style.display = 'none';
        
        // Add CSRF token
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = '{{ csrf_token() }}';
        form.appendChild(csrfInput);
        
        // Add method override for DELETE
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        form.appendChild(methodInput);
        
        document.body.appendChild(form);
        form.submit();
    }

    // Enhanced form submission with loading states
    document.querySelectorAll('form').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            const submitButton = form.querySelector('button[type="submit"]');
            if (submitButton && !submitButton.disabled) {
                const originalText = submitButton.innerHTML;
                submitButton.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-2"></i>Submitting...';
                submitButton.disabled = true;
                
                // Re-enable after 5 seconds in case of error
                setTimeout(function() {
                    submitButton.innerHTML = originalText;
                    submitButton.disabled = false;
                }, 5000);
            }
        });
    });

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        if (e.target.tagName === 'TEXTAREA') {
            // Ctrl/Cmd + Enter to submit
            if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
                e.preventDefault();
                const form = e.target.closest('form');
                if (form) {
                    form.dispatchEvent(new Event('submit', { bubbles: true }));
                }
            }
            
            // Escape to cancel edit
            if (e.key === 'Escape') {
                const editForm = e.target.closest('.comment-edit-form');
                if (editForm) {
                    const commentId = editForm.id.replace('edit-form-', '');
                    cancelEdit(commentId);
                }
            }
        }
    });

    // Real-time mention notifications
    function initializePushNotifications() {
        // Check if Laravel Echo is available
        if (typeof window.Echo !== 'undefined') {
            // Listen for mention notifications on user's private channel
            window.Echo.private(`user.{{ auth()->id() }}`)
                .listen('user.mentioned', (e) => {
                    showMentionNotification(e);
                });
        } else {
            console.log('Laravel Echo not available for real-time notifications');
        }
    }

    // Show mention notification
    function showMentionNotification(data) {
        // Create a toast notification
        const notification = document.createElement('div');
        notification.className = 'fixed top-4 right-4 bg-blue-600 text-white px-6 py-4 rounded-lg shadow-lg z-50 max-w-sm';
        notification.innerHTML = `
            <div class="flex items-start gap-3">
                <div class="flex-shrink-0">
                    <i class="fa-solid fa-at text-lg"></i>
                </div>
                <div class="flex-1">
                    <div class="font-semibold">You were mentioned!</div>
                    <div class="text-sm opacity-90">${data.message}</div>
                    <div class="mt-2">
                        <a href="${data.url}" class="text-blue-200 hover:text-white underline text-sm">
                            View Task
                        </a>
                    </div>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="flex-shrink-0 text-blue-200 hover:text-white">
                    <i class="fa-solid fa-times"></i>
                </button>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        // Auto-remove after 10 seconds
        setTimeout(() => {
            if (notification.parentElement) {
                notification.remove();
            }
        }, 10000);
        
        // Browser notification API (if permissions granted)
        if ('Notification' in window && Notification.permission === 'granted') {
            new Notification('You were mentioned!', {
                body: data.message,
                icon: '/favicon.ico',
                tag: 'mention-' + data.comment_id
            });
        }
    }

    // Request notification permissions on page load
    function requestNotificationPermission() {
        if ('Notification' in window && Notification.permission === 'default') {
            Notification.requestPermission().then(function(permission) {
                if (permission === 'granted') {
                    console.log('Notification permission granted');
                }
            });
        }
    }

    // Initialize push notifications when page loads
    document.addEventListener('DOMContentLoaded', function() {
        initializePushNotifications();
        requestNotificationPermission();
    });

    function showMentionStatus(message, type) {
        const statusElement = document.querySelector('.mention-status');
        if (statusElement) {
            statusElement.textContent = message;
            statusElement.className = `mention-status text-xs transition-opacity duration-300 ${type === 'success' ? 'text-green-600' : 'text-red-600'}`;
            statusElement.style.opacity = '1';
            
            // Hide after 3 seconds
            setTimeout(() => {
                statusElement.style.opacity = '0';
            }, 3000);
        }
    }
</script> 