@section('title')
    {{ __('Create Task') }}
@endsection

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
{{-- <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css"> --}}

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<style>
    .form-section {
        @apply mb-8 p-6 bg-card-light dark:bg-card-dark rounded-lg border border-gray-200 dark:border-gray-700;
    }
    
    .form-section h3 {
        @apply text-lg font-semibold mb-4 text-text-light dark:text-text-dark border-b border-gray-200 dark:border-gray-700 pb-2;
    }
    
    .file-drop-zone {
        @apply border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-8 text-center hover:border-blue-500 dark:hover:border-blue-400 transition-colors bg-gray-50 dark:bg-gray-800/50;
    }
    
    .file-drop-zone.dragover {
        @apply border-blue-500 bg-blue-50 dark:bg-blue-900/20;
    }
    
    .label-input {
        @apply flex flex-wrap gap-2 min-h-[38px] border border-gray-300 dark:border-gray-600 rounded-md p-2 bg-white dark:bg-card-dark;
    }
    
    .label-tag {
        @apply bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 px-2 py-1 rounded text-sm flex items-center gap-1;
    }
</style>

<x-app-layout>
    <div class="p-6">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Create Task</h1>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Create a new task for your project
                    </p>
                </div>
                <a href="{{ route('task.index') }}" 
                   class="inline-flex items-center px-4 py-2 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    <i class="fa-solid fa-arrow-left mr-2"></i>
                    Back to Tasks
                </a>
            </div>
        </div>

        @if ($errors->any())
            <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
                <div class="flex">
                    <i class="fa-solid fa-exclamation-triangle text-red-400 mr-3 mt-0.5"></i>
                    <div>
                        <h3 class="text-sm font-medium text-red-800 dark:text-red-300">
                            Please fix the following errors:
                        </h3>
                        <ul class="mt-2 text-sm text-red-700 dark:text-red-400 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('task.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Basic Information Section -->
            <x-forms.form-section 
                title="Basic Information" 
                description="Provide the essential details for your task">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Task Name -->
                    <div class="md:col-span-2">
                        <label for="task_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Task Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="task_name" id="task_name" required 
                               value="{{ old('task_name') }}"
                               class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Enter a descriptive task name">
                        @error('task_name')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Task Type -->
                    <div>
                        <label for="task_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Task Type <span class="text-red-500">*</span>
                        </label>
                        <select name="task_type" id="task_type" required
                                class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Task Type</option>
                            <option value="task" {{ old('task_type') == 'task' ? 'selected' : '' }}>Task</option>
                            <option value="story" {{ old('task_type') == 'story' ? 'selected' : '' }}>User Story</option>
                            <option value="bug" {{ old('task_type') == 'bug' ? 'selected' : '' }}>Bug</option>
                            <option value="epic" {{ old('task_type') == 'epic' ? 'selected' : '' }}>Epic</option>
                        </select>
                        @error('task_type')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Priority -->
                    <div>
                        <label for="priority" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Priority <span class="text-red-500">*</span>
                        </label>
                        <select name="priority" id="priority" required
                                class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Priority</option>
                            <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                            <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                        </select>
                        @error('priority')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select name="status" id="status" required
                                class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Status</option>
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="inprogress" {{ old('status') == 'inprogress' ? 'selected' : '' }}>In Progress</option>
                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Due Date -->
                    <div>
                        <label for="due_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Due Date <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="due_date" id="due_date" required 
                               value="{{ old('due_date') }}"
                               class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @error('due_date')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Description
                        </label>
                        <textarea name="description" id="description" rows="4" 
                                  class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                  placeholder="Describe the task in detail...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </x-forms.form-section>

            <!-- Assignment Section -->
            <x-forms.form-section 
                title="Assignment & Project" 
                description="Assign the task to team members and projects">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Employer -->
                    @if (auth()->user()->role != 'employee' && auth()->user()->role != 'client')
                        <div>
                            <label for="employer_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Employer <span class="text-red-500">*</span>
                            </label>
                            <select name="employer_id" id="employer_id" required
                                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Select Employer</option>
                                @foreach ($employers as $employer)
                                    <option value="{{ $employer->id }}" {{ old('employer_id') == $employer->id ? 'selected' : '' }}>
                                        {{ $employer->employer_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('employer_id')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    @else
                        <input type="hidden" name="employer_id"
                            value="{{ auth()->user()->employee->employer_id ?? auth()->user()->client->employer_id }}">
                    @endif

                    <!-- Employee -->
                    @if (auth()->user()->role != 'employee')
                        <div>
                            <label for="employee_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Assignee <span class="text-red-500">*</span>
                            </label>
                            <select name="employee_id" id="employee_id" required
                                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Select Assignee</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                                        {{ $employee->employee_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('employee_id')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif

                    <!-- Project -->
                    <div>
                        <label for="project_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Project <span class="text-red-500">*</span>
                        </label>
                        <select name="project_id" id="project_id" required
                                class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Project</option>
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>
                                    {{ $project->project_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('project_id')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Estimated Hours -->
                    <div>
                        <label for="estimated_hours" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Estimated Hours
                        </label>
                        <input type="number" name="estimated_hours" id="estimated_hours" 
                               step="0.25" min="0" value="{{ old('estimated_hours') }}"
                               class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="0.00">
                        @error('estimated_hours')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </x-forms.form-section>

            <!-- Labels & Time Section -->
            <x-forms.form-section 
                title="Labels & Time Tracking" 
                description="Add labels and set initial time tracking">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Labels -->
                    <div>
                        <label for="labels_input" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Labels
                        </label>
                        <div class="label-input" id="labels_container">
                            <input type="text" id="labels_input" 
                                   class="flex-1 outline-none bg-transparent text-gray-900 dark:text-white min-w-[120px]" 
                                   placeholder="Type label and press Enter..."
                                   onkeydown="handleLabelInput(event)">
                        </div>
                        <input type="hidden" name="labels" id="labels_hidden" value="{{ json_encode(old('labels', [])) }}">
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Press Enter to add labels</p>
                        @error('labels')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Initial Time -->
                    <div>
                        <label for="time" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Initial Time (HH:MM)
                        </label>
                        <input type="text" name="time" id="time" value="{{ old('time', '00:00') }}"
                               class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="00:00" maxlength="5">
                        @error('time')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </x-forms.form-section>

            <!-- Attachments Section -->
            <x-forms.form-section 
                title="Attachments" 
                description="Upload files, images, or documents related to this task">
                <div class="file-drop-zone" id="file-drop-zone">
                    <div class="text-center">
                        <i class="fa-solid fa-cloud-arrow-up text-4xl text-gray-400 mb-4"></i>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">
                            Drop files here or click to browse
                        </h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                            Maximum file size: 10MB per file
                        </p>
                        <button type="button" onclick="document.getElementById('attachments').click()" 
                                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                            <i class="fa-solid fa-folder-open mr-2"></i>
                            Choose Files
                        </button>
                        <input type="file" name="attachments[]" id="attachments" multiple 
                               class="hidden" accept="image/*,.pdf,.doc,.docx,.txt,.xlsx,.xls">
                    </div>
                </div>
                <div id="file-preview" class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4"></div>
                @error('attachments.*')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </x-forms.form-section>

            <!-- Submit Section -->
            <div class="flex justify-end gap-4">
                <a href="{{ route('task.index') }}" 
                   class="inline-flex items-center px-6 py-3 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium text-sm transition-colors">
                    <i class="fa-solid fa-times mr-2"></i>
                    Cancel
                </a>
                <button type="submit"
                        class="inline-flex items-center px-6 py-3 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium text-sm transition-colors">
                    <i class="fa-solid fa-plus mr-2"></i>
                    Create Task
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // File upload handling
            const fileInput = document.getElementById('attachments');
            const fileDropZone = document.getElementById('file-drop-zone');
            const filePreview = document.getElementById('file-preview');

            // Drag and drop functionality
            fileDropZone.addEventListener('dragover', (e) => {
                e.preventDefault();
                fileDropZone.classList.add('dragover');
            });

            fileDropZone.addEventListener('dragleave', (e) => {
                e.preventDefault();
                fileDropZone.classList.remove('dragover');
            });

            fileDropZone.addEventListener('drop', (e) => {
                e.preventDefault();
                fileDropZone.classList.remove('dragover');
                fileInput.files = e.dataTransfer.files;
                handleFilePreview();
            });

            fileInput.addEventListener('change', handleFilePreview);

            function handleFilePreview() {
                filePreview.innerHTML = '';
                Array.from(fileInput.files).forEach((file, index) => {
                    const fileItem = document.createElement('div');
                    fileItem.className = 'bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-4 flex items-center gap-3';
                    
                    const icon = file.type.startsWith('image/') ? 'fa-image' : 'fa-file';
                    const size = (file.size / 1024 / 1024).toFixed(2);
                    
                    fileItem.innerHTML = `
                        <i class="fa-solid ${icon} text-2xl text-blue-500"></i>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 dark:text-white truncate">${file.name}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">${size} MB</p>
                        </div>
                        <button type="button" onclick="removeFile(${index})" 
                                class="text-red-500 hover:text-red-700 p-1">
                            <i class="fa-solid fa-times"></i>
                        </button>
                    `;
                    filePreview.appendChild(fileItem);
                });
            }

            // Labels functionality
            let labels = JSON.parse(document.getElementById('labels_hidden').value || '[]');
            updateLabelsDisplay();

            window.handleLabelInput = function(event) {
                if (event.key === 'Enter' && event.target.value.trim()) {
                    event.preventDefault();
                    const label = event.target.value.trim();
                    if (!labels.includes(label)) {
                        labels.push(label);
                        updateLabelsDisplay();
                        event.target.value = '';
                    }
                }
            };

            window.removeLabel = function(index) {
                labels.splice(index, 1);
                updateLabelsDisplay();
            };

            function updateLabelsDisplay() {
                const container = document.getElementById('labels_container');
                const input = container.querySelector('#labels_input');
                
                // Clear existing labels
                container.querySelectorAll('.label-tag').forEach(tag => tag.remove());
                
                // Add labels
                labels.forEach((label, index) => {
                    const tag = document.createElement('span');
                    tag.className = 'label-tag';
                    tag.innerHTML = `
                        ${label}
                        <button type="button" onclick="removeLabel(${index})" class="ml-1 text-blue-600 hover:text-blue-800 dark:text-blue-300 dark:hover:text-blue-100">
                            <i class="fa-solid fa-times text-xs"></i>
                        </button>
                    `;
                    container.insertBefore(tag, input);
                });
                
                // Update hidden input
                document.getElementById('labels_hidden').value = JSON.stringify(labels);
            }

            window.removeFile = function(index) {
                const dt = new DataTransfer();
                Array.from(fileInput.files).forEach((file, i) => {
                    if (i !== index) dt.items.add(file);
                });
                fileInput.files = dt.files;
                handleFilePreview();
            };

            // Time input formatting
            const timeInput = document.getElementById('time');
            timeInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/[^0-9]/g, '');
                if (value.length > 2) {
                    value = value.slice(0, 2) + ':' + value.slice(2, 4);
                }
                e.target.value = value;
            });
        });
    </script>
</x-app-layout>
