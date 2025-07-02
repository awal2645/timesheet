@section('title', 'Module Management')

<x-app-layout>
    <!-- Breadcrumb Navigation -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6 mt-6">
        <x-breadcrumb :items="[
            [
                'label' => __('Admin'),
                'url' => '#',
                'icon' => false
            ],
            [
                'label' => __('Module Management'),
                'icon' => true
            ]
        ]" />
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white dark:bg-slate-800 shadow-2xl rounded-3xl overflow-hidden border border-gray-200 dark:border-gray-700">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-100 dark:from-slate-700 dark:to-slate-800 px-8 py-8 border-b border-gray-200 dark:border-gray-600">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                    <div class="mb-6 lg:mb-0">
                        <h2 class="text-3xl font-bold text-gray-900 dark:text-white flex items-center">
                            <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                            </div>
                            {{ __('Module Management') }}
                        </h2>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Enable or disable system modules to customize functionality and features.') }}
                        </p>
                    </div>
                    
                    <!-- Statistics and Actions -->
                    <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-4 sm:space-y-0 sm:space-x-6">
                        <!-- Module Statistics -->
                        <div class="flex items-center space-x-6">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-blue-600 dark:text-blue-400" id="totalModules">{{ count($modules) }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ __('Total Modules') }}</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-green-600 dark:text-green-400" id="enabledModules">{{ $modules->where('status', 1)->count() }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ __('Enabled') }}</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-red-600 dark:text-red-400" id="disabledModules">{{ $modules->where('status', 0)->count() }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ __('Disabled') }}</div>
                            </div>
                        </div>
                        
                        <!-- Refresh Button -->
                        <button onclick="window.location.reload()" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            {{ __('Refresh') }}
                        </button>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="p-8">
                <!-- Alert Messages -->
                @if(session('success'))
                    <div class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl p-4">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-600 dark:text-green-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-green-800 dark:text-green-300 font-medium">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl p-4">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-red-600 dark:text-red-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            <span class="text-red-800 dark:text-red-300 font-medium">{{ $errors->first() }}</span>
                        </div>
                    </div>
                @endif

                <!-- Quick Actions -->
                <div class="mb-8 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 rounded-xl p-6 border border-gray-200 dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        {{ __('Quick Actions') }}
                    </h3>
                    
                    <div class="flex flex-wrap gap-4">
                        <button onclick="toggleAllModules(true)" class="inline-flex items-center px-4 py-2 bg-green-100 hover:bg-green-200 dark:bg-green-900/30 dark:hover:bg-green-900/50 text-green-800 dark:text-green-300 rounded-lg transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ __('Enable All') }}
                        </button>
                        
                        <button onclick="toggleAllModules(false)" class="inline-flex items-center px-4 py-2 bg-red-100 hover:bg-red-200 dark:bg-red-900/30 dark:hover:bg-red-900/50 text-red-800 dark:text-red-300 rounded-lg transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            {{ __('Disable All') }}
                        </button>
                        
                        <button onclick="showModuleInfo()" class="inline-flex items-center px-4 py-2 bg-blue-100 hover:bg-blue-200 dark:bg-blue-900/30 dark:hover:bg-blue-900/50 text-blue-800 dark:text-blue-300 rounded-lg transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ __('Module Info') }}
                        </button>
                    </div>
                </div>

                <!-- Modules Table -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                            </svg>
                            {{ __('Available Modules') }}
                        </h3>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-900">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                            </svg>
                                            <span>{{ __('Module Name') }}</span>
                                        </div>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            <span>{{ __('Status') }}</span>
                                        </div>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"/>
                                            </svg>
                                            <span>{{ __('Actions') }}</span>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($modules as $module)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200" id="module-row-{{ $module->id }}">
                                        <td class="px-6 py-6 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 w-10 h-10">
                                                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center">
                                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                                        {{ $module->name }}
                                                    </div>
                                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                                        {{ __('Module ID') }}: {{ $module->id }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-6 whitespace-nowrap">
                                            <div class="flex items-center space-x-3">
                                                <!-- Enhanced Toggle Switch -->
                                                <label class="relative inline-flex items-center cursor-pointer">
                                                    <input type="checkbox"
                                                           class="sr-only peer module-toggle"
                                                           data-id="{{ $module->id }}"
                                                           {{ $module->status ? 'checked' : '' }}>
                                                    <div class="relative w-14 h-7 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600 shadow-inner"></div>
                                                </label>
                                                
                                                <!-- Status Badge -->
                                                <span class="status-badge inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $module->status ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300' }}" id="status-badge-{{ $module->id }}">
                                                    <div class="w-2 h-2 rounded-full mr-2 {{ $module->status ? 'bg-green-500' : 'bg-red-500' }}" id="status-dot-{{ $module->id }}"></div>
                                                    <span id="status-text-{{ $module->id }}">{{ $module->status ? __('Enabled') : __('Disabled') }}</span>
                                                </span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-6 whitespace-nowrap">
                                            <div class="flex items-center space-x-2">
                                                <!-- Status Message -->
                                                <span id="status-message-{{ $module->id }}" class="text-sm font-medium hidden"></span>
                                                
                                                <!-- Loading Indicator -->
                                                <div id="loading-{{ $module->id }}" class="hidden">
                                                    <svg class="animate-spin w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24">
                                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center">
                                                <svg class="w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                                </svg>
                                                <p class="text-gray-500 dark:text-gray-400 text-lg">{{ __('No modules found') }}</p>
                                                <p class="text-gray-400 dark:text-gray-500 text-sm mt-2">{{ __('There are no modules available in the system') }}</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Help Section -->
                <div class="mt-8 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-semibold text-blue-800 dark:text-blue-300 mb-2">{{ __('Module Management Tips') }}</h3>
                            <div class="text-sm text-blue-700 dark:text-blue-400 space-y-2">
                                <p class="flex items-start">
                                    <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ __('Toggle individual modules by clicking the switch to enable or disable specific functionality') }}
                                </p>
                                <p class="flex items-start">
                                    <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ __('Use quick actions to enable or disable all modules at once for bulk operations') }}
                                </p>
                                <p class="flex items-start">
                                    <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ __('Changes take effect immediately and will affect the system functionality and navigation') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced JavaScript -->
    <script>
        // Module management functions
        function updateModuleStatus(moduleId, status) {
            const loadingElement = document.getElementById(`loading-${moduleId}`);
            const statusMessage = document.getElementById(`status-message-${moduleId}`);
            const statusBadge = document.getElementById(`status-badge-${moduleId}`);
            const statusDot = document.getElementById(`status-dot-${moduleId}`);
            const statusText = document.getElementById(`status-text-${moduleId}`);
            
            // Show loading
            loadingElement.classList.remove('hidden');
            statusMessage.classList.add('hidden');
            
            fetch(`/admin/settings/modules/${moduleId}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ status })
            })
            .then(response => response.json())
            .then(data => {
                loadingElement.classList.add('hidden');
                
                if(data.success) {
                    // Update status badge
                    const isEnabled = data.status;
                    statusBadge.className = `status-badge inline-flex items-center px-3 py-1 rounded-full text-xs font-medium ${
                        isEnabled 
                            ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300' 
                            : 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300'
                    }`;
                    statusDot.className = `w-2 h-2 rounded-full mr-2 ${isEnabled ? 'bg-green-500' : 'bg-red-500'}`;
                    statusText.textContent = isEnabled ? '{{ __('Enabled') }}' : '{{ __('Disabled') }}';
                    
                    // Show success message
                    statusMessage.textContent = isEnabled ? '{{ __('Module enabled successfully') }}' : '{{ __('Module disabled successfully') }}';
                    statusMessage.className = 'text-sm font-medium text-green-600 dark:text-green-400';
                    statusMessage.classList.remove('hidden');
                    
                    // Update statistics
                    updateStatistics();
                    
                    // Show notification
                    showNotification(
                        isEnabled ? '{{ __('Module enabled successfully') }}' : '{{ __('Module disabled successfully') }}', 
                        'success'
                    );
                    
                    setTimeout(() => statusMessage.classList.add('hidden'), 3000);
                } else {
                    statusMessage.textContent = '{{ __('Failed to update module') }}';
                    statusMessage.className = 'text-sm font-medium text-red-600 dark:text-red-400';
                    statusMessage.classList.remove('hidden');
                    showNotification('{{ __('Failed to update module') }}', 'error');
                    setTimeout(() => statusMessage.classList.add('hidden'), 3000);
                }
            })
            .catch(() => {
                loadingElement.classList.add('hidden');
                statusMessage.textContent = '{{ __('Network error occurred') }}';
                statusMessage.className = 'text-sm font-medium text-red-600 dark:text-red-400';
                statusMessage.classList.remove('hidden');
                showNotification('{{ __('Network error occurred') }}', 'error');
                setTimeout(() => statusMessage.classList.add('hidden'), 3000);
            });
        }

        function updateStatistics() {
            const toggles = document.querySelectorAll('.module-toggle');
            let enabled = 0;
            let total = toggles.length;
            
            toggles.forEach(toggle => {
                if (toggle.checked) enabled++;
            });
            
            document.getElementById('totalModules').textContent = total;
            document.getElementById('enabledModules').textContent = enabled;
            document.getElementById('disabledModules').textContent = total - enabled;
        }

        function toggleAllModules(enable) {
            const toggles = document.querySelectorAll('.module-toggle');
            let completed = 0;
            
            if (toggles.length === 0) {
                showNotification('{{ __('No modules found') }}', 'warning');
                return;
            }
            
            showNotification(
                enable 
                    ? '{{ __('Enabling all modules...') }}' 
                    : '{{ __('Disabling all modules...') }}', 
                'info'
            );
            
            toggles.forEach(toggle => {
                if (toggle.checked !== enable) {
                    toggle.checked = enable;
                    updateModuleStatus(toggle.getAttribute('data-id'), enable ? 1 : 0);
                }
                completed++;
                
                if (completed === toggles.length) {
                    setTimeout(() => {
                        showNotification(
                            enable 
                                ? '{{ __('All modules have been enabled') }}' 
                                : '{{ __('All modules have been disabled') }}', 
                            'success'
                        );
                    }, 1000);
                }
            });
        }

        function showModuleInfo() {
            const total = document.getElementById('totalModules').textContent;
            const enabled = document.getElementById('enabledModules').textContent;
            const disabled = document.getElementById('disabledModules').textContent;
            
            showNotification(
                `{{ __('Modules Overview') }}: ${total} {{ __('total') }}, ${enabled} {{ __('enabled') }}, ${disabled} {{ __('disabled') }}`, 
                'info'
            );
        }

        function showNotification(message, type = 'info') {
            const colors = {
                success: 'bg-green-500',
                info: 'bg-blue-500',
                warning: 'bg-yellow-500',
                error: 'bg-red-500'
            };

            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 ${colors[type]} text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300`;
            notification.textContent = message;
            document.body.appendChild(notification);

            setTimeout(() => notification.classList.remove('translate-x-full'), 100);
            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => notification.remove(), 300);
            }, 4000);
        }

        // Initialize event listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Module toggle event listeners
            document.querySelectorAll('.module-toggle').forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    const moduleId = this.getAttribute('data-id');
                    const status = this.checked ? 1 : 0;
                    updateModuleStatus(moduleId, status);
                });
            });

            // Add smooth entrance animation
            const card = document.querySelector('.bg-white');
            if (card) {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.6s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 100);
            }

            // Initialize statistics
            updateStatistics();
        });
    </script>
</x-app-layout>