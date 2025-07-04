@section('title', 'Edit Role')

<x-app-layout>
    <!-- Breadcrumb Navigation -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6 mt-6">
        <x-breadcrumb :items="[
            [
                'label' => __('User Management'),
                'url' => '#',
                'icon' => false
            ],
            [
                'label' => __('Role Management'),
                'url' => route('role.page'),
                'icon' => false
            ],
            [
                'label' => __('Edit Role'),
                'icon' => true
            ]
        ]" />
    </div>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white dark:bg-slate-800 shadow-2xl rounded-3xl overflow-hidden border border-gray-200 dark:border-gray-700">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-orange-50 to-amber-50 dark:from-slate-700 dark:to-slate-800 px-8 py-8 border-b border-gray-200 dark:border-gray-600">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                    <div class="mb-6 lg:mb-0">
                        <h2 class="text-3xl font-bold text-gray-900 dark:text-white flex items-center">
                            <div class="w-10 h-10 bg-orange-100 dark:bg-orange-900/30 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </div>
                            {{ __('Edit Role') }}: <span class="text-orange-600 dark:text-orange-400">{{ $role->name }}</span>
                        </h2>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Modify role permissions and settings. Changes will affect all users with this role.') }}
                        </p>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex space-x-3">
                        <!-- Change Indicator -->
                        <div id="changeIndicator" class="hidden bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300 px-3 py-2 rounded-lg text-sm font-medium flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.96-.833-2.73 0L4.084 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                            </svg>
                            {{ __('Unsaved Changes') }}
                        </div>
                        
                        <!-- Back Button -->
                        <a href="{{ route('role.page') }}" 
                           class="group inline-flex items-center px-6 py-3 bg-gradient-to-r from-gray-600 to-slate-600 hover:from-gray-700 hover:to-slate-700 text-white font-bold rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-gray-500/50">
                            <svg class="w-4 h-4 mr-3 transition-transform duration-200 group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5 5-5M18 12H6"/>
                            </svg>
                            {{ __('Back to Roles') }}
                        </a>
                    </div>
                </div>
            </div>

            <!-- Form Content -->
            <div class="p-8">
                <form method="POST" action="{{ route('role.update', $role->id) }}" class="space-y-8" id="roleForm">
                    @csrf
                    @method('PUT')

                    <!-- Role Information Section -->
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-800 dark:to-gray-700 rounded-2xl border border-blue-200 dark:border-gray-600 p-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                            <svg class="w-5 h-5 mr-3 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            {{ __('Role Information') }}
                        </h3>

                        <!-- Current Role Info -->
                        <div class="bg-white dark:bg-gray-700 rounded-xl p-4 mb-6 border border-gray-200 dark:border-gray-600">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 w-12 h-12">
                                    <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-amber-600 rounded-xl flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m3 4.197a4 4 0 11-3.8-5.438M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4 flex-1">
                                    <div class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ __('Current Role') }}</div>
                                    <div class="text-lg font-bold text-orange-600 dark:text-orange-400 capitalize">{{ $role->name }}</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ trans_choice('permission.count', $role->permissions->count(), ['count' => $role->permissions->count()]) }}
                                    </div>
                                </div>
                                <div class="flex flex-col text-right">
                                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ __('Created') }}</div>
                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                        {{ $role->created_at ? $role->created_at->format('M j, Y') : __('Unknown') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Role Name -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                                {{ __('Role Name') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="role_name" id="role_name"
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                   value="{{ old('role_name') ?? $role->name }}" 
                                   data-original-value="{{ $role->name }}"
                                   placeholder="{{ __('Enter a descriptive role name') }}" required>
                            @error('role_name')
                                <span class="text-red-500 text-sm flex items-center mt-2">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $message }}
                                </span>
                            @enderror
                            <div class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                                {{ __('Changing the role name will update it for all users assigned to this role.') }}
                            </div>
                        </div>
                    </div>

                    <!-- Permissions Section -->
                    <div class="bg-gradient-to-r from-purple-50 to-indigo-50 dark:from-gray-800 dark:to-gray-700 rounded-2xl border border-purple-200 dark:border-gray-600 p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                                <svg class="w-5 h-5 mr-3 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                                {{ __('Role Permissions') }}
                                <span id="selectedCount" class="ml-3 inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300">
                                    {{ $role->permissions->count() }} {{ __('selected') }}
                                </span>
                            </h3>
                            
                            <!-- Quick Action Buttons -->
                            <div class="flex space-x-2">
                                <button type="button" onclick="selectAllPermissions()" 
                                        class="px-3 py-1 bg-green-100 hover:bg-green-200 text-green-800 dark:bg-green-900/30 dark:text-green-300 dark:hover:bg-green-800/30 text-xs font-medium rounded-lg transition-colors duration-200">
                                    {{ __('Select All') }}
                                </button>
                                <button type="button" onclick="clearAllPermissions()" 
                                        class="px-3 py-1 bg-red-100 hover:bg-red-200 text-red-800 dark:bg-red-900/30 dark:text-red-300 dark:hover:bg-red-800/30 text-xs font-medium rounded-lg transition-colors duration-200">
                                    {{ __('Clear All') }}
                                </button>
                                <button type="button" onclick="resetPermissions()" 
                                        class="px-3 py-1 bg-blue-100 hover:bg-blue-200 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300 dark:hover:bg-blue-800/30 text-xs font-medium rounded-lg transition-colors duration-200">
                                    {{ __('Reset') }}
                                </button>
                            </div>
                        </div>

                        <!-- Permission Search -->
                        <div class="mb-6">
                            <div class="relative">
                                <input type="text" id="permissionSearch" placeholder="{{ __('Search permissions...') }}"
                                       class="w-full pl-10 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200">
                                <svg class="absolute left-3 top-3.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                        </div>

                        <!-- Permission Changes Summary -->
                        <div id="changesSummary" class="hidden mb-6 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-xl p-4">
                            <h4 class="text-sm font-semibold text-yellow-800 dark:text-yellow-300 mb-3 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.96-.833-2.73 0L4.084 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                </svg>
                                {{ __('Permission Changes Detected') }}
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                <div id="addedPermissions" class="hidden">
                                    <div class="font-medium text-green-800 dark:text-green-300 mb-2">{{ __('Added:') }}</div>
                                    <div id="addedList" class="space-y-1"></div>
                                </div>
                                <div id="removedPermissions" class="hidden">
                                    <div class="font-medium text-red-800 dark:text-red-300 mb-2">{{ __('Removed:') }}</div>
                                    <div id="removedList" class="space-y-1"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Permissions Grid -->
                        <div id="permissionsContainer" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($permissions as $permission)
                                @if (auth()->user()->role != 'superadmin' &&
                                        in_array($permission->name, [
                                            'Employer view',
                                            'Employer create',
                                            'Role view',
                                            'Role create',
                                            'Role edit',
                                            'Role update',
                                            'Role destroy',
                                            'Invite employer',
                                            'Employer update',
                                            'Employer destroy',
                                        ]))
                                    @continue
                                @endif
                                
                                <div class="permission-item bg-white dark:bg-gray-700 rounded-xl p-4 border border-gray-200 dark:border-gray-600 hover:shadow-md transition-all duration-200" 
                                     data-permission-name="{{ strtolower($permission->name) }}"
                                     data-permission-id="{{ $permission->id }}">
                                    <label class="flex items-center cursor-pointer group">
                                        <div class="relative">
                                            <input type="checkbox" name="permissions[]" id="permission_{{ $permission->id }}"
                                                   value="{{ $permission->id }}" class="sr-only peer permission-checkbox"
                                                   data-original-state="{{ in_array($permission->id, $role->permissions->pluck('id')->toArray()) ? 'true' : 'false' }}"
                                                   {{ in_array($permission->id, old('permissions', $role->permissions->pluck('id')->toArray())) ? 'checked' : '' }}
                                                   onchange="updatePermissionCount(); trackChanges();">
                                            <div class="w-5 h-5 border-2 border-gray-300 dark:border-gray-500 rounded peer-checked:bg-purple-600 peer-checked:border-purple-600 flex items-center justify-center transition-all duration-200">
                                                <svg class="w-3 h-3 text-white opacity-0 peer-checked:opacity-100 transition-opacity duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ml-3 flex-1">
                                            <span class="text-sm font-medium text-gray-900 dark:text-gray-100 group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors duration-200">
                                                {{ $permission->name }}
                                            </span>
                                            @php
                                                $category = '';
                                                if (str_contains(strtolower($permission->name), 'view')) $category = 'Read';
                                                elseif (str_contains(strtolower($permission->name), 'create')) $category = 'Create';
                                                elseif (str_contains(strtolower($permission->name), 'edit') || str_contains(strtolower($permission->name), 'update')) $category = 'Update';
                                                elseif (str_contains(strtolower($permission->name), 'destroy') || str_contains(strtolower($permission->name), 'delete')) $category = 'Delete';
                                                else $category = 'Action';
                                            @endphp
                                            <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium 
                                                    @if($category === 'Read') bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300
                                                    @elseif($category === 'Create') bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300
                                                    @elseif($category === 'Update') bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300
                                                    @elseif($category === 'Delete') bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300
                                                    @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300 @endif">
                                                    {{ $category }}
                                                </span>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <!-- No Results Message -->
                        <div id="noResults" class="hidden text-center py-8">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                <p class="text-gray-500 dark:text-gray-400">{{ __('No permissions found matching your search.') }}</p>
                            </div>
                        </div>

                        @error('permissions')
                            <div class="mt-4 text-red-500 text-sm flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('role.page') }}" 
                           class="inline-flex items-center px-6 py-3 bg-gray-300 hover:bg-gray-400 dark:bg-gray-600 dark:hover:bg-gray-500 text-gray-700 dark:text-gray-200 font-medium rounded-xl transition-all duration-200">
                            {{ __('Cancel') }}
                        </a>
                        <button type="submit" 
                                class="group inline-flex items-center px-8 py-3 bg-gradient-to-r from-orange-600 to-amber-600 hover:from-orange-700 hover:to-amber-700 text-white font-bold rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-orange-500/50"
                                id="submitBtn">
                            <div class="flex items-center justify-center w-5 h-5 bg-white/20 rounded-lg mr-3">
                                <svg class="w-3 h-3 transition-transform duration-200 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            {{ __('Update Role') }}
                            <svg class="w-4 h-4 ml-3 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5-5 5M6 12h12"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Help Section -->
        <div class="mt-8 bg-orange-50 dark:bg-orange-900/20 border border-orange-200 dark:border-orange-800 rounded-xl p-6">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-semibold text-orange-800 dark:text-orange-300 mb-2">{{ __('Role Editing Guidelines') }}</h3>
                    <div class="text-sm text-orange-700 dark:text-orange-400 space-y-2">
                        <p class="flex items-start">
                            <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            {{ __('Changes to this role will immediately affect all users who have been assigned this role') }}
                        </p>
                        <p class="flex items-start">
                            <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            {{ __('Use the permission search to quickly find specific permissions in large lists') }}
                        </p>
                        <p class="flex items-start">
                            <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            {{ __('Review the changes summary before submitting to ensure all modifications are intentional') }}
                        </p>
                        <p class="flex items-start">
                            <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            {{ __('Be especially careful with delete and admin permissions as they can have significant security implications') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced JavaScript -->
    <script>
        let originalPermissions = @json($role->permissions->pluck('id')->toArray());
        let originalRoleName = @json($role->name);
        
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize permission count
            updatePermissionCount();
            
            // Track initial state
            trackChanges();
            
            // Permission search functionality
            const searchInput = document.getElementById('permissionSearch');
            const permissionItems = document.querySelectorAll('.permission-item');
            const noResults = document.getElementById('noResults');
            
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                let visibleCount = 0;
                
                permissionItems.forEach(item => {
                    const permissionName = item.dataset.permissionName;
                    if (permissionName.includes(searchTerm)) {
                        item.style.display = 'block';
                        visibleCount++;
                    } else {
                        item.style.display = 'none';
                    }
                });
                
                noResults.classList.toggle('hidden', visibleCount > 0);
            });
            
            // Track role name changes
            document.getElementById('role_name').addEventListener('input', trackChanges);
            
            // Add smooth entrance animations
            const sections = document.querySelectorAll('.bg-gradient-to-r');
            sections.forEach((section, index) => {
                section.style.opacity = '0';
                section.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    section.style.transition = 'all 0.6s ease';
                    section.style.opacity = '1';
                    section.style.transform = 'translateY(0)';
                }, index * 200);
            });
            
            // Form submission enhancement
            document.getElementById('roleForm').addEventListener('submit', function() {
                const submitBtn = document.getElementById('submitBtn');
                submitBtn.disabled = true;
                submitBtn.innerHTML = `
                    <div class="flex items-center">
                        <svg class="animate-spin w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        {{ __('Updating Role...') }}
                    </div>
                `;
            });
        });
        
        // Update permission count
        function updatePermissionCount() {
            const checkedBoxes = document.querySelectorAll('.permission-checkbox:checked');
            const count = checkedBoxes.length;
            document.getElementById('selectedCount').textContent = `${count} {{ __('selected') }}`;
        }
        
        // Track changes and show summary
        function trackChanges() {
            const currentPermissions = Array.from(document.querySelectorAll('.permission-checkbox:checked')).map(cb => parseInt(cb.value));
            const currentRoleName = document.getElementById('role_name').value;
            
            const hasNameChange = currentRoleName !== originalRoleName;
            const hasPermissionChanges = !arraysEqual(currentPermissions, originalPermissions);
            const hasChanges = hasNameChange || hasPermissionChanges;
            
            // Show/hide change indicator
            document.getElementById('changeIndicator').classList.toggle('hidden', !hasChanges);
            
            if (hasPermissionChanges) {
                showPermissionChanges(currentPermissions);
            } else {
                document.getElementById('changesSummary').classList.add('hidden');
            }
        }
        
        // Show permission changes
        function showPermissionChanges(currentPermissions) {
            const added = currentPermissions.filter(id => !originalPermissions.includes(id));
            const removed = originalPermissions.filter(id => !currentPermissions.includes(id));
            
            const changesSummary = document.getElementById('changesSummary');
            const addedSection = document.getElementById('addedPermissions');
            const removedSection = document.getElementById('removedPermissions');
            const addedList = document.getElementById('addedList');
            const removedList = document.getElementById('removedList');
            
            if (added.length > 0 || removed.length > 0) {
                changesSummary.classList.remove('hidden');
                
                if (added.length > 0) {
                    addedSection.classList.remove('hidden');
                    addedList.innerHTML = added.map(id => {
                        const item = document.querySelector(`[data-permission-id="${id}"]`);
                        const name = item ? item.dataset.permissionName : 'Unknown';
                        return `<div class="text-green-700 dark:text-green-300">+ ${name}</div>`;
                    }).join('');
                } else {
                    addedSection.classList.add('hidden');
                }
                
                if (removed.length > 0) {
                    removedSection.classList.remove('hidden');
                    removedList.innerHTML = removed.map(id => {
                        const item = document.querySelector(`[data-permission-id="${id}"]`);
                        const name = item ? item.dataset.permissionName : 'Unknown';
                        return `<div class="text-red-700 dark:text-red-300">- ${name}</div>`;
                    }).join('');
                } else {
                    removedSection.classList.add('hidden');
                }
            } else {
                changesSummary.classList.add('hidden');
            }
        }
        
        // Helper function to compare arrays
        function arraysEqual(a, b) {
            if (a.length !== b.length) return false;
            const sortedA = [...a].sort();
            const sortedB = [...b].sort();
            return sortedA.every((val, i) => val === sortedB[i]);
        }
        
        // Select all permissions
        function selectAllPermissions() {
            const visibleItems = document.querySelectorAll('.permission-item[style="display: block"], .permission-item:not([style*="display: none"])');
            
            visibleItems.forEach(item => {
                const checkbox = item.querySelector('.permission-checkbox');
                if (checkbox) {
                    checkbox.checked = true;
                }
            });
            
            updatePermissionCount();
            trackChanges();
        }
        
        // Clear all permissions
        function clearAllPermissions() {
            const checkboxes = document.querySelectorAll('.permission-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
            updatePermissionCount();
            trackChanges();
        }
        
        // Reset to original permissions
        function resetPermissions() {
            const checkboxes = document.querySelectorAll('.permission-checkbox');
            checkboxes.forEach(checkbox => {
                const originalState = checkbox.dataset.originalState === 'true';
                checkbox.checked = originalState;
            });
            
            // Reset role name
            document.getElementById('role_name').value = originalRoleName;
            
            updatePermissionCount();
            trackChanges();
            
            // Show toast notification
            showToast('{{ __("Role reset to original state") }}', 'info');
        }
        
        // Toast notification function
        function showToast(message, type = 'info') {
            const toast = document.createElement('div');
            toast.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg text-white font-medium transform transition-all duration-300 translate-x-full ${
                type === 'success' ? 'bg-green-500' : 
                type === 'error' ? 'bg-red-500' : 
                'bg-blue-500'
            }`;
            toast.textContent = message;
            
            document.body.appendChild(toast);
            
            // Slide in
            setTimeout(() => {
                toast.style.transform = 'translateX(0)';
            }, 100);
            
            // Slide out and remove
            setTimeout(() => {
                toast.style.transform = 'translateX(full)';
                setTimeout(() => {
                    if (document.body.contains(toast)) {
                        document.body.removeChild(toast);
                    }
                }, 300);
            }, 3000);
        }
    </script>
</x-app-layout>
