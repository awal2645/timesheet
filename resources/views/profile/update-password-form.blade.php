<x-form-section submit="updatePassword">
    <x-slot name="title">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-gradient-to-r from-red-500 to-pink-600 rounded-xl flex items-center justify-center">
                <i class="fa-solid fa-shield-halved text-white text-lg"></i>
            </div>
            <div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ __('Update Password') }}</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('Strengthen your account security') }}</p>
            </div>
        </div>
    </x-slot>

    <x-slot name="description">
        <div class="bg-red-50 dark:bg-red-900/20 rounded-lg p-4 border border-red-200 dark:border-red-800">
            <div class="flex items-start gap-3">
                <div class="w-6 h-6 bg-red-100 dark:bg-red-800 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                    <i class="fa-solid fa-lock text-red-600 dark:text-red-400 text-sm"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-red-900 dark:text-red-100">
                        {{ __('Ensure your account is using a long, random password to stay secure.') }}
                    </p>
                    <p class="text-xs text-red-700 dark:text-red-300 mt-1">
                        {{ __('Use a combination of letters, numbers, and special characters for maximum security.') }}
                    </p>
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6" x-data="passwordForm()">
            <!-- Security Guidelines -->
            <div class="mb-6 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                <h4 class="text-sm font-semibold text-blue-900 dark:text-blue-100 mb-3 flex items-center gap-2">
                    <i class="fa-solid fa-info-circle text-blue-600 dark:text-blue-400"></i>
                    {{ __('Password Security Guidelines') }}
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-xs">
                    <div class="flex items-center gap-2 text-blue-800 dark:text-blue-200">
                        <i class="fa-solid fa-check-circle text-green-500"></i>
                        {{ __('At least 8 characters long') }}
                    </div>
                    <div class="flex items-center gap-2 text-blue-800 dark:text-blue-200">
                        <i class="fa-solid fa-check-circle text-green-500"></i>
                        {{ __('Include uppercase letters') }}
                    </div>
                    <div class="flex items-center gap-2 text-blue-800 dark:text-blue-200">
                        <i class="fa-solid fa-check-circle text-green-500"></i>
                        {{ __('Include lowercase letters') }}
                    </div>
                    <div class="flex items-center gap-2 text-blue-800 dark:text-blue-200">
                        <i class="fa-solid fa-check-circle text-green-500"></i>
                        {{ __('Include numbers and symbols') }}
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 space-y-6">
                <!-- Current Password -->
                <div>
                    <x-label for="current_password" class="flex items-center gap-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        <i class="fa-solid fa-key text-gray-500 text-xs"></i>
                        {{ __('Current Password') }}
                    </x-label>
                    <div class="mt-2 relative">
                        <x-input id="current_password" 
                            type="password" 
                            class="block w-full pl-12 pr-12 py-3 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200" 
                            wire:model="state.current_password"
                            autocomplete="current-password"
                            placeholder="{{ __('Enter your current password') }}"
                            x-ref="currentPassword" />
                     
                        <button type="button" 
                            class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors duration-200"
                            @click="togglePasswordVisibility('currentPassword')">
                            <i class="fa-solid fa-eye text-sm" x-show="!showCurrentPassword"></i>
                            <i class="fa-solid fa-eye-slash text-sm" x-show="showCurrentPassword"></i>
                        </button>
                    </div>
                    <x-input-error for="current_password" class="mt-2" />
                </div>

                <!-- New Password -->
                <div>
                    <x-label for="password" class="flex items-center gap-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        <i class="fa-solid fa-lock text-gray-500 text-xs"></i>
                        {{ __('New Password') }}
                    </x-label>
                    <div class="mt-2 relative">
                        <x-input id="password" 
                            type="password" 
                            class="block w-full pl-12 pr-12 py-3 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200" 
                            wire:model="state.password"
                            autocomplete="new-password"
                            placeholder="{{ __('Enter your new password') }}"
                            x-ref="newPassword"
                            @input="checkPasswordStrength($event.target.value)" />
                        <button type="button" 
                            class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors duration-200"
                            @click="togglePasswordVisibility('newPassword')">
                            <i class="fa-solid fa-eye text-sm" x-show="!showNewPassword"></i>
                            <i class="fa-solid fa-eye-slash text-sm" x-show="showNewPassword"></i>
                        </button>
                    </div>
                    
                    <!-- Password Strength Indicator -->
                    <div class="mt-3 w-full overflow-hidden" x-show="passwordStrength.score > 0">
                        <div class="flex flex-col sm:flex-row sm:items-center gap-2 mb-2">
                            <span class="text-xs font-medium text-gray-600 dark:text-gray-400 flex-shrink-0">{{ __('Password Strength:') }}</span>
                            <span class="text-xs font-bold flex-shrink-0" :class="passwordStrength.color" x-text="passwordStrength.text"></span>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 overflow-hidden">
                            <div class="h-2 rounded-full transition-all duration-300" 
                                :class="passwordStrength.bgColor" 
                                :style="`width: ${passwordStrength.score * 20}%`"></div>
                        </div>
                        <div class="mt-2 space-y-1" x-show="passwordChecks.length > 0">
                            <template x-for="check in passwordChecks" :key="check.text">
                                <div class="flex items-start gap-2 text-xs">
                                    <i class="fa-solid fa-check-circle text-green-500 flex-shrink-0 mt-0.5" x-show="check.passed"></i>
                                    <i class="fa-solid fa-times-circle text-red-500 flex-shrink-0 mt-0.5" x-show="!check.passed"></i>
                                    <span class="break-words" :class="check.passed ? 'text-green-700 dark:text-green-400' : 'text-red-700 dark:text-red-400'" x-text="check.text"></span>
                                </div>
                            </template>
                        </div>
                    </div>
                    
                    <x-input-error for="password" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-label for="password_confirmation" class="flex items-center gap-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        <i class="fa-solid fa-shield-check text-gray-500 text-xs"></i>
                        {{ __('Confirm Password') }}
                    </x-label>
                    <div class="mt-2 relative">
                        <x-input id="password_confirmation" 
                            type="password" 
                            class="block w-full pl-12 pr-12 py-3 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200" 
                            wire:model="state.password_confirmation"
                            autocomplete="new-password"
                            placeholder="{{ __('Confirm your new password') }}"
                            x-ref="confirmPassword"
                            @input="checkPasswordMatch($event.target.value)" />
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fa-solid fa-shield-check text-gray-400 text-sm"></i>
                        </div>
                        <button type="button" 
                            class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors duration-200"
                            @click="togglePasswordVisibility('confirmPassword')">
                            <i class="fa-solid fa-eye text-sm" x-show="!showConfirmPassword"></i>
                            <i class="fa-solid fa-eye-slash text-sm" x-show="showConfirmPassword"></i>
                        </button>
                    </div>
                    
                    <!-- Password Match Indicator -->
                    <div class="mt-2" x-show="passwordMatch.show">
                        <div class="flex items-center gap-2 text-xs">
                            <i class="fa-solid fa-check-circle text-green-500" x-show="passwordMatch.matches"></i>
                            <i class="fa-solid fa-times-circle text-red-500" x-show="!passwordMatch.matches"></i>
                            <span :class="passwordMatch.matches ? 'text-green-700 dark:text-green-400' : 'text-red-700 dark:text-red-400'" x-text="passwordMatch.text"></span>
                        </div>
                    </div>
                    
                    <x-input-error for="password_confirmation" class="mt-2" />
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="actions">
        <div class="flex flex-col sm:flex-row items-center gap-4">
            <!-- Success Message -->
            <x-action-message class="text-green-600 dark:text-green-400 font-medium" on="saved">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-check-circle"></i>
                    {{ __('Password updated successfully!') }}
                </div>
            </x-action-message>

            <!-- Action Buttons -->
            <div class="flex gap-3">
                @if (env('APP_MODE') === 'demo')
                <button type="button" disabled
                    class="inline-flex items-center px-6 py-3 bg-gray-400 text-white text-sm font-medium rounded-lg cursor-not-allowed opacity-60">
                    <i class="fa-solid fa-lock mr-2"></i>
                    {{ __('Update (Demo Mode)') }}
                </button>
                @else
                <button type="submit" 
                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-red-600 to-pink-600 hover:from-red-700 hover:to-pink-700 text-white text-sm font-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-200 shadow-md hover:shadow-lg disabled:opacity-50 disabled:cursor-not-allowed"
                    wire:loading.attr="disabled">
                    <span wire:loading.remove>
                        <i class="fa-solid fa-shield-check mr-2"></i>
                        {{ __('Update Password') }}
                    </span>
                    <span wire:loading>
                        <i class="fa-solid fa-spinner fa-spin mr-2"></i>
                        {{ __('Updating...') }}
                    </span>
                </button>
                @endif
            </div>
        </div>
    </x-slot>
</x-form-section>

<script>
function passwordForm() {
    return {
        showCurrentPassword: false,
        showNewPassword: false,
        showConfirmPassword: false,
        passwordStrength: {
            score: 0,
            text: '',
            color: '',
            bgColor: ''
        },
        passwordChecks: [],
        passwordMatch: {
            show: false,
            matches: false,
            text: ''
        },
        
        togglePasswordVisibility(field) {
            if (field === 'currentPassword') {
                this.showCurrentPassword = !this.showCurrentPassword;
                this.$refs.currentPassword.type = this.showCurrentPassword ? 'text' : 'password';
            } else if (field === 'newPassword') {
                this.showNewPassword = !this.showNewPassword;
                this.$refs.newPassword.type = this.showNewPassword ? 'text' : 'password';
            } else if (field === 'confirmPassword') {
                this.showConfirmPassword = !this.showConfirmPassword;
                this.$refs.confirmPassword.type = this.showConfirmPassword ? 'text' : 'password';
            }
        },
        
        checkPasswordStrength(password) {
            let score = 0;
            let checks = [
                { text: '{{ __("At least 8 characters") }}', passed: false },
                { text: '{{ __("Contains uppercase letter") }}', passed: false },
                { text: '{{ __("Contains lowercase letter") }}', passed: false },
                { text: '{{ __("Contains number") }}', passed: false },
                { text: '{{ __("Contains special character") }}', passed: false }
            ];
            
            if (password.length >= 8) {
                score++;
                checks[0].passed = true;
            }
            if (/[A-Z]/.test(password)) {
                score++;
                checks[1].passed = true;
            }
            if (/[a-z]/.test(password)) {
                score++;
                checks[2].passed = true;
            }
            if (/[0-9]/.test(password)) {
                score++;
                checks[3].passed = true;
            }
            if (/[^A-Za-z0-9]/.test(password)) {
                score++;
                checks[4].passed = true;
            }
            
            this.passwordChecks = checks;
            this.passwordStrength.score = score;
            
            switch (score) {
                case 0:
                case 1:
                    this.passwordStrength.text = '{{ __("Very Weak") }}';
                    this.passwordStrength.color = 'text-red-600 dark:text-red-400';
                    this.passwordStrength.bgColor = 'bg-red-500';
                    break;
                case 2:
                    this.passwordStrength.text = '{{ __("Weak") }}';
                    this.passwordStrength.color = 'text-orange-600 dark:text-orange-400';
                    this.passwordStrength.bgColor = 'bg-orange-500';
                    break;
                case 3:
                    this.passwordStrength.text = '{{ __("Fair") }}';
                    this.passwordStrength.color = 'text-yellow-600 dark:text-yellow-400';
                    this.passwordStrength.bgColor = 'bg-yellow-500';
                    break;
                case 4:
                    this.passwordStrength.text = '{{ __("Good") }}';
                    this.passwordStrength.color = 'text-blue-600 dark:text-blue-400';
                    this.passwordStrength.bgColor = 'bg-blue-500';
                    break;
                case 5:
                    this.passwordStrength.text = '{{ __("Excellent") }}';
                    this.passwordStrength.color = 'text-green-600 dark:text-green-400';
                    this.passwordStrength.bgColor = 'bg-green-500';
                    break;
            }
        },
        
        checkPasswordMatch(confirmPassword) {
            const newPassword = this.$refs.newPassword.value;
            this.passwordMatch.show = confirmPassword.length > 0;
            this.passwordMatch.matches = newPassword === confirmPassword;
            this.passwordMatch.text = this.passwordMatch.matches ? 
                '{{ __("Passwords match") }}' : 
                '{{ __("Passwords do not match") }}';
        }
    }
}
</script>