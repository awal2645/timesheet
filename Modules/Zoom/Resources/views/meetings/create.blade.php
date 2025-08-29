@section('title', 'Create Meeting')

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>

<x-app-layout>
    <!-- Breadcrumb Navigation -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6 mt-6">
        <x-breadcrumb :items="[
            [
                'label' => __('Communication'),
                'url' => '#',
                'icon' => false
            ],
            [
                'label' => __('Zoom Meetings'),
                'url' => route('zoom.meeting.index'),
                'icon' => false
            ],
            [
                'label' => __('Create Meeting'),
                'icon' => true
            ]
        ]" />
    </div>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white dark:bg-slate-800 shadow-2xl rounded-3xl overflow-hidden border border-gray-200 dark:border-gray-700">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-slate-700 dark:to-slate-800 px-8 py-8 border-b border-gray-200 dark:border-gray-600">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                    <div class="mb-6 lg:mb-0">
                        <h2 class="text-3xl font-bold text-gray-900 dark:text-white flex items-center">
                            <div class="w-10 h-10 bg-green-100 dark:bg-green-900/30 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            {{ __('Create Meeting') }}
                        </h2>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Set up a new video conference meeting with participants and scheduling.') }}
                        </p>
                    </div>
                    
                    <!-- Back Button -->
                    <div class="flex-shrink-0">
                        <a href="{{ route('zoom.meeting.index') }}" 
                           class="group inline-flex items-center px-6 py-3 bg-gradient-to-r from-gray-600 to-slate-600 hover:from-gray-700 hover:to-slate-700 text-white font-bold rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-gray-500/50">
                            <svg class="w-4 h-4 mr-3 transition-transform duration-200 group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5 5-5M18 12H6"/>
                            </svg>
                            {{ __('Back to Meetings') }}
                        </a>
                    </div>
                </div>
            </div>

            <!-- Form Content -->
            <div class="p-8">
                <form method="POST" action="{{ route('zoom.meeting.store') }}" class="space-y-8">
                    @csrf

                    <!-- Zoom Credentials Section -->
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-800 dark:to-gray-700 rounded-2xl border border-blue-200 dark:border-gray-600 overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-6">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                                        <svg class="w-5 h-5 mr-3 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                        </svg>
                                        {{ __('Zoom API Credentials') }}
                                    </h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('Configure your Zoom account settings for meeting creation') }}</p>
                                </div>
                                
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" id="toggleZoomCredentialsCheckbox" class="sr-only peer">
                                    <div class="relative w-14 h-7 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 shadow-inner"></div>
                                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('Configure Credentials') }}</span>
                                </label>
                            </div>

                            <div id="zoomCredentials" class="hidden space-y-6">
                                <!-- Account ID -->
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        {{ __('Zoom Account ID') }} <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="zoom_account_id" id="zoom_account_id"
                                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                           value="{{ old('zoom_account_id', auth()->user()->zoom_account_id) }}" 
                                           placeholder="{{ __('Enter your Zoom Account ID') }}" required>
                                    @error('zoom_account_id')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Client ID -->
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                                        </svg>
                                        {{ __('Zoom Client ID') }} <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="zoom_client_id" id="zoom_client_id"
                                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                           value="{{ old('zoom_client_id', auth()->user()->zoom_client_id) }}" 
                                           placeholder="{{ __('Enter your Zoom Client ID') }}" required>
                                    @error('zoom_client_id')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Client Secret -->
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                        </svg>
                                        {{ __('Zoom Client Secret') }} <span class="text-red-500">*</span>
                                    </label>
                                    <input type="password" name="zoom_client_secret" id="zoom_client_secret"
                                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                           value="{{ old('zoom_client_secret', auth()->user()->zoom_client_secret) }}" 
                                           placeholder="{{ __('Enter your Zoom Client Secret') }}" required>
                                    @error('zoom_client_secret')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Meeting Details Section -->
                    <div class="bg-gradient-to-r from-purple-50 to-indigo-50 dark:from-gray-800 dark:to-gray-700 rounded-2xl border border-purple-200 dark:border-gray-600 p-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                            <svg class="w-5 h-5 mr-3 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ __('Meeting Information') }}
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Topic -->
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200">
                                    {{ __('Meeting Topic') }} <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="topic" id="topic"
                                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200"
                                       value="{{ old('topic') }}" 
                                       placeholder="{{ __('Enter meeting topic') }}" required>
                                @error('topic')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Duration -->
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200">
                                    {{ __('Duration (minutes)') }} <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="duration" id="duration"
                                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200"
                                       value="{{ old('duration', 60) }}" min="1" max="1440"
                                       placeholder="{{ __('Meeting duration') }}" required>
                                @error('duration')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Start Date -->
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200">
                                    {{ __('Start Date') }} <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="start_date" id="start_date"
                                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200"
                                       value="{{ old('start_date') }}" required>
                                @error('start_date')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Start Time -->
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200">
                                    {{ __('Start Time') }} <span class="text-red-500">*</span>
                                </label>
                                <input type="time" name="start_time" id="start_time"
                                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200"
                                       value="{{ old('start_time') }}" required>
                                @error('start_time')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Meeting Password -->
                            <div class="space-y-2 md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                    {{ __('Meeting Password') }} <span class="text-red-500">*</span>
                                </label>
                                <input type="password" name="password" id="password"
                                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200"
                                       value="{{ old('password') }}" 
                                       placeholder="{{ __('Set a secure meeting password') }}" required>
                                @error('password')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="space-y-2 md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200">
                                    {{ __('Meeting Description') }}
                                </label>
                                <textarea name="description" id="description" rows="3"
                                          class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200"
                                          placeholder="{{ __('Optional meeting description or agenda') }}">{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Participants Section -->
                    <div class="bg-gradient-to-r from-orange-50 to-red-50 dark:from-gray-800 dark:to-gray-700 rounded-2xl border border-orange-200 dark:border-gray-600 p-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                            <svg class="w-5 h-5 mr-3 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            {{ __('Meeting Participants') }}
                        </h3>

                        <!-- Role Selection -->
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-4">
                                {{ __('Select Participant Role') }} <span class="text-red-500">*</span>
                            </label>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                @foreach ($roles as $role)
                                <div class="relative">
                                    <input type="radio" id="role_{{ $role->id }}" name="selected_role" value="{{ $role->name }}"
                                           class="peer sr-only" {{ old('selected_role') == $role->name ? 'checked' : '' }} required>
                                    <label for="role_{{ $role->id }}" 
                                           class="flex items-center justify-center px-4 py-3 bg-white dark:bg-gray-700 border-2 border-gray-200 dark:border-gray-600 rounded-lg cursor-pointer transition-all duration-200 peer-checked:border-orange-500 peer-checked:bg-orange-50 dark:peer-checked:bg-orange-900/30 hover:border-orange-300">
                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300 peer-checked:text-orange-600 dark:peer-checked:text-orange-400">
                                            {{ ucfirst($role->name) }}
                                        </span>
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            @error('selected_role')
                                <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Participant Selection -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200">
                                {{ __('Select Participants') }}
                            </label>
                            <select name="participants[]" id="participants" multiple 
                                    class="w-full border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ collect(old('participants'))->contains($user->id) ? 'selected' : '' }}>
                                        {{ ucfirst($user->username) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('participants')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit" 
                                class="group inline-flex items-center px-8 py-4 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-green-500/50">
                            <div class="flex items-center justify-center w-6 h-6 bg-white/20 rounded-lg mr-3">
                                <svg class="w-4 h-4 transition-transform duration-200 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            {{ __('Create Meeting') }}
                            <svg class="w-5 h-5 ml-3 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5-5 5M6 12h12"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Enhanced JavaScript -->
    <script>
        $(document).ready(function() {
            // Initialize Select2 with custom styling
            $('#participants').select2({
                placeholder: "{{ __('Select participants for the meeting') }}",
                allowClear: true,
                width: '100%',
                templateResult: function(option) {
                    if (!option.id) return option.text;
                    return $('<span><i class="fas fa-user mr-2"></i>' + option.text + '</span>');
                }
            });

            // Toggle zoom credentials
            $('#toggleZoomCredentialsCheckbox').change(function() {
                const $credentials = $('#zoomCredentials');
                if (this.checked) {
                    $credentials.removeClass('hidden').hide().slideDown(300);
                } else {
                    $credentials.slideUp(300, function() {
                        $(this).addClass('hidden');
                    });
                }
            });

            // Auto-generate meeting password
            $('#generatePassword').click(function() {
                const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                let password = '';
                for (let i = 0; i < 8; i++) {
                    password += chars.charAt(Math.floor(Math.random() * chars.length));
                }
                $('#password').val(password);
            });

            // Form submission enhancement
            $('form').on('submit', function() {
                const submitBtn = $(this).find('button[type="submit"]');
                submitBtn.prop('disabled', true).html(`
                    <div class="flex items-center justify-center">
                        <svg class="animate-spin w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        {{ __('Creating Meeting...') }}
                    </div>
                `);
            });

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
        });
    </script>
</x-app-layout>
