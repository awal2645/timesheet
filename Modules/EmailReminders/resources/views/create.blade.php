@extends('emailreminders::layouts.master')

@section('title')
{{ 'Create Email Reminder' }}
@endsection

<x-app-layout>
    <div class="p-6 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Create Email Reminder</h1>
                    <p class="text-gray-600 dark:text-gray-400">Set up a new automated email reminder</p>
                </div>
                <a href="{{ route('emailreminders.index') }}" 
                   class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to List
                </a>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
            <form action="{{ route('emailreminders.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Basic Information -->
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Basic Information</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Title -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Reminder Title *
                            </label>
                            <input type="text" name="title" required
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                placeholder="Enter reminder title">
                        </div>

                        <!-- Type -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Reminder Type *
                            </label>
                            <select name="type" required
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                <option value="">Select Type</option>
                                <option value="task_deadline">Task Deadline</option>
                                <option value="timesheet_submission">Timesheet Submission</option>
                                <option value="project_milestone">Project Milestone</option>
                                <option value="meeting">Meeting</option>
                                <option value="custom">Custom</option>
                            </select>
                        </div>

                        <!-- Description -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Description
                            </label>
                            <textarea name="description" rows="3"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                placeholder="Enter reminder description"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Schedule Settings -->
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Schedule Settings</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Frequency -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Frequency *
                            </label>
                            <select name="frequency" required
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                <option value="once">Once</option>
                                <option value="daily">Daily</option>
                                <option value="weekly">Weekly</option>
                                <option value="monthly">Monthly</option>
                            </select>
                        </div>

                        <!-- Days Before -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Days Before Event
                            </label>
                            <input type="number" name="reminder_days_before" value="1" min="0" max="365"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        </div>

                        <!-- Time -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Reminder Time
                            </label>
                            <input type="time" name="reminder_time" value="09:00"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        </div>
                    </div>
                </div>

                <!-- Recipients -->
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Recipients</h2>
                    
                    <div class="space-y-4">
                        <!-- Recipient Type -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Recipient Type *
                            </label>
                            <select name="recipient_type" required id="recipient_type"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                <option value="specific">Specific Users</option>
                                <option value="role">By Role</option>
                                <option value="department">By Department</option>
                                <option value="all">All Users</option>
                            </select>
                        </div>

                        <!-- Recipients Input -->
                        <div id="recipients_container">
                            <!-- Specific Users -->
                            <div id="specific_users_section">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Select Users *
                                </label>
                                <select name="recipients" multiple id="user_select" 
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                    style="min-height: 120px;">
                                    @foreach(\App\Models\User::all() as $user)
                                        <option value="{{ $user->email }}">
                                            {{ $user->username ?? $user->email }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                    Hold Ctrl (or Cmd on Mac) and click to select multiple users. 
                                    <span id="selected_count" class="font-medium">0 users selected</span>
                                </p>
                            </div>

                            <!-- Other recipient types -->
                            <div id="other_recipients_section" class="hidden">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" id="other_label">
                                    Recipients
                                </label>
                                <textarea name="other_recipients" id="other_recipients" rows="3" placeholder="Enter email addresses separated by commas"
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"></textarea>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1" id="other_help">
                                    Enter email addresses separated by commas, or specify role/department names
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="p-6">
                    <div class="mb-4">
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="send_now" value="1" 
                                   class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <span class="text-sm text-gray-700 dark:text-gray-300">Send test email immediately after creating</span>
                        </label>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            Check this box to send a test email right away to verify your reminder settings
                        </p>
                    </div>
                    
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('emailreminders.index') }}" 
                           class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            Create Reminder
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<script>
// Handle recipient type change
document.getElementById('recipient_type').addEventListener('change', function() {
    const specificSection = document.getElementById('specific_users_section');
    const otherSection = document.getElementById('other_recipients_section');
    const otherTextarea = document.getElementById('other_recipients');
    const otherLabel = document.getElementById('other_label');
    const otherHelp = document.getElementById('other_help');
    const userSelect = document.getElementById('user_select');
    
    if (this.value === 'specific') {
        specificSection.style.display = 'block';
        otherSection.style.display = 'none';
        userSelect.name = 'recipients';
        otherTextarea.name = 'other_recipients';
        userSelect.required = true;
        otherTextarea.required = false;
    } else {
        specificSection.style.display = 'none';
        otherSection.style.display = 'block';
        userSelect.name = 'user_select_hidden';
        otherTextarea.name = 'recipients';
        userSelect.required = false;
        
        switch(this.value) {
            case 'role':
                otherLabel.textContent = 'Role Names *';
                otherTextarea.placeholder = 'Enter role names separated by commas (e.g., admin, manager, employee)';
                otherHelp.textContent = 'Enter role names separated by commas';
                otherTextarea.required = true;
                otherTextarea.readOnly = false;
                otherTextarea.value = '';
                break;
            case 'department':
                otherLabel.textContent = 'Department Names *';
                otherTextarea.placeholder = 'Enter department names separated by commas';
                otherHelp.textContent = 'Enter department names separated by commas';
                otherTextarea.required = true;
                otherTextarea.readOnly = false;
                otherTextarea.value = '';
                break;
            case 'all':
                otherLabel.textContent = 'All Users';
                otherTextarea.placeholder = 'All registered users will receive this reminder';
                otherHelp.textContent = 'All registered users will receive this reminder';
                otherTextarea.required = false;
                otherTextarea.value = 'all_users';
                otherTextarea.readOnly = true;
                break;
        }
    }
});

// Handle user selection count
document.getElementById('user_select').addEventListener('change', function() {
    const selectedCount = this.selectedOptions.length;
    document.getElementById('selected_count').textContent = selectedCount + ' user' + (selectedCount !== 1 ? 's' : '') + ' selected';
});

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    // Trigger initial state
    document.getElementById('recipient_type').dispatchEvent(new Event('change'));
});
</script>
