<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center">
                <i class="fa-solid fa-user text-white text-lg"></i>
            </div>
            <div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ __('Profile Information') }}</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('Manage your personal details') }}</p>
            </div>
        </div>
    </x-slot>

    <x-slot name="description">
        <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-4 border border-blue-200 dark:border-blue-800">
            <div class="flex items-start gap-3">
                <div class="w-6 h-6 bg-blue-100 dark:bg-blue-800 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                    <i class="fa-solid fa-info text-blue-600 dark:text-blue-400 text-sm"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-blue-900 dark:text-blue-100">
                        {{ __('Update your account\'s profile information and email address.') }}
                    </p>
                    <p class="text-xs text-blue-700 dark:text-blue-300 mt-1">
                        {{ __('Make sure your information is current and accurate for the best experience.') }}
                    </p>
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo Section -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
        <div x-data="{photoName: null, photoPreview: null}" class="col-span-6">
            <!-- Section Header -->
            <div class="mb-6">
                <h4 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                    <i class="fa-solid fa-camera text-purple-600 text-sm"></i>
                    {{ __('Profile Photo') }}
                </h4>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    {{ __('Upload a professional photo to personalize your profile.') }}
                </p>
            </div>

            <!-- Profile Photo File Input -->
            <input type="file" id="photo" class="hidden" wire:model.live="photo" x-ref="photo" 
                accept="image/*"
                x-on:change="
                    photoName = $refs.photo.files[0].name;
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        photoPreview = e.target.result;
                    };
                    reader.readAsDataURL($refs.photo.files[0]);
                " />

            <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                <div class="flex flex-col sm:flex-row items-center gap-6">
                    <!-- Photo Display -->
                    <div class="relative">
                        <!-- Current Profile Photo -->
                        <div class="relative" x-show="! photoPreview">
                            <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->username }}"
                                class="w-24 h-24 rounded-full object-cover border-4 border-white dark:border-gray-700 shadow-lg">
                            <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-green-500 border-2 border-white dark:border-gray-700 rounded-full"></div>
                        </div>

                        <!-- New Profile Photo Preview -->
                        <div class="relative" x-show="photoPreview" style="display: none;">
                            <div class="w-24 h-24 rounded-full bg-cover bg-center border-4 border-white dark:border-gray-700 shadow-lg"
                                x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                            </div>
                            <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-blue-500 border-2 border-white dark:border-gray-700 rounded-full flex items-center justify-center">
                                <i class="fa-solid fa-check text-white text-xs"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Photo Actions -->
                    <div class="flex-1 text-center sm:text-left">
                        <h5 class="font-medium text-gray-900 dark:text-white mb-2">
                            {{ __('Profile Picture') }}
                        </h5>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                            {{ __('Choose a clear photo that represents you professionally.') }}
                        </p>
                        
                        <div class="flex flex-col sm:flex-row gap-3">
                            <button type="button" 
                                class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-sm font-medium rounded-lg hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-md hover:shadow-lg"
                                x-on:click.prevent="$refs.photo.click()">
                                <i class="fa-solid fa-upload mr-2"></i>
                                {{ __('Select New Photo') }}
                            </button>

                            @if ($this->user->profile_photo_path)
                            <button type="button" 
                                class="inline-flex items-center px-4 py-2 bg-red-100 hover:bg-red-200 dark:bg-red-900/30 dark:hover:bg-red-900/50 text-red-700 dark:text-red-400 text-sm font-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-200"
                                wire:click="deleteProfilePhoto">
                                <i class="fa-solid fa-trash mr-2"></i>
                                {{ __('Remove Photo') }}
                            </button>
                            @endif
                        </div>

                        <!-- File info -->
                        <div x-show="photoName" class="mt-3 text-xs text-gray-600 dark:text-gray-400">
                            <i class="fa-solid fa-file-image mr-1"></i>
                            <span x-text="photoName"></span>
                        </div>
                    </div>
                </div>
                
                <x-input-error for="photo" class="mt-4" />
            </div>
        </div>
        @endif

        <!-- Personal Information Section -->
        <div class="col-span-6">
            <div class="mb-6">
                <h4 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                    <i class="fa-solid fa-id-card text-green-600 text-sm"></i>
                    {{ __('Personal Information') }}
                </h4>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    {{ __('Update your basic account information below.') }}
                </p>
            </div>

            <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 space-y-6">
                <!-- Name -->
                <div>
                    <x-label for="name" value="{{ __('Full Name') }}" class="flex items-center gap-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        <i class="fa-solid fa-user text-gray-500 text-xs"></i>
                        {{ __('Full Name') }}
                    </x-label>
                    <div class="mt-2 relative">
                        <x-input id="name" type="text" 
                            class="block w-full pl-10 pr-4 py-3 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                            wire:model="state.username" 
                            required
                            autocomplete="name" 
                            placeholder="{{ __('Enter your full name') }}" />
                       
                    </div>
                    <x-input-error for="name" class="mt-2" />
                </div>

                <!-- Email -->
                <div>
                    <x-label for="email" value="{{ __('Email Address') }}" class="flex items-center gap-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        <i class="fa-solid fa-envelope text-gray-500 text-xs"></i>
                        {{ __('Email Address') }}
                    </x-label>
                    <div class="mt-2 relative">
                        <x-input id="email" type="email" 
                            class="block w-full pl-10 pr-4 py-3 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                            wire:model="state.email" 
                            required
                            autocomplete="email" 
                            placeholder="{{ __('Enter your email address') }}" />
                       
                    </div>
                    <x-input-error for="email" class="mt-2" />

                    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && !$this->user->hasVerifiedEmail())
                    <div class="mt-4 p-4 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg">
                        <div class="flex items-start gap-3">
                            <div class="w-5 h-5 bg-yellow-100 dark:bg-yellow-800 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i class="fa-solid fa-exclamation-triangle text-yellow-600 dark:text-yellow-400 text-xs"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-yellow-800 dark:text-yellow-200">
                                    {{ __('Email Verification Required') }}
                                </p>
                                <p class="text-sm text-yellow-700 dark:text-yellow-300 mt-1">
                                    {{ __('Your email address is unverified.') }}
                                </p>
                                <button type="button"
                                    class="mt-3 inline-flex items-center px-3 py-2 bg-yellow-600 hover:bg-yellow-700 text-white text-xs font-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition-all duration-200"
                                    wire:click.prevent="sendEmailVerification">
                                    <i class="fa-solid fa-paper-plane mr-2"></i>
                                    {{ __('Resend Verification Email') }}
                                </button>
                            </div>
                        </div>

                        @if ($this->verificationLinkSent)
                        <div class="mt-3 p-3 bg-green-100 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-lg">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-check-circle text-green-600 dark:text-green-400"></i>
                                <p class="text-sm font-medium text-green-800 dark:text-green-200">
                                    {{ __('Verification email sent successfully!') }}
                                </p>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif
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
                    {{ __('Profile updated successfully!') }}
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
                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white text-sm font-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-md hover:shadow-lg disabled:opacity-50 disabled:cursor-not-allowed"
                    wire:loading.attr="disabled" 
                    wire:target="photo">
                    <span wire:loading.remove wire:target="updateProfileInformation">
                        <i class="fa-solid fa-save mr-2"></i>
                        {{ __('Save Changes') }}
                    </span>
                    <span wire:loading wire:target="updateProfileInformation">
                        <i class="fa-solid fa-spinner fa-spin mr-2"></i>
                        {{ __('Saving...') }}
                    </span>
                </button>
                @endif
            </div>
        </div>
    </x-slot>
</x-form-section>