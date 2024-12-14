@section('title')
    {{ __('General Setting') }}
@endsection
<x-app-layout>
    @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">{{ __('Oops! Something went wrong.') }}</strong>
        <ul class="mt-2 list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="py-12 px-8">
        <h2 class="text-2xl mb-6 text-black/90 dark:text-white/90">{{ __('Employer Settings') }}</h2>
        <form action="{{ route('employer.info.update', $employer->id) }}" method="Post" enctype="multipart/form-data"
            class="bg-card-light dark:bg-card-dark p-8 border border-black/10 dark:border-white/10 rounded-xl">
            @csrf
            <div class="flex flex-wrap gap-6">
                <!-- Upload Logo -->
                <div class="flex-1 border border-gray-300 dark:border-gray-600 p-6 rounded-lg" x-data="logoUpload()">
                    <h3 class="text-xl mb-4 text-text-light dark:text-text-dark">{{ __('Upload Logo') }}</h3>
                    <div class="flex flex-col gap-6 items-center">
                        <div class="preview-container">
                            <img :src="logoPreview" alt="Logo preview"
                                class="w-full h-[300px] rounded object-contain" x-show="logoPreview">
                        </div>
                        <div>
                            <p class="max-w-3xl text-base mb-5">{{ __('Upload a high-resolution company logo in JPEG or PNG format.') }}</p>
                            <div>
                                <div class="flex gap-3 items-center flex-wrap">
                                    <label
                                        class="flex gap-3 items-center px-6 py-3 rounded-md bg-primary-50 shadow-md text-white dark:text-black">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
                                            <path
                                                d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                                            <path
                                                d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708z" />
                                        </svg>
                                        {{ __('Replace Logo') }}
                                        <input type="file" name="logo" @change="handleLogoUpload"
                                            accept="image/jpeg,image/png" style="display:none;">
                                    </label>
                                    <button @click="removeLogo" type="button"
                                        class="flex gap-3 items-center px-6 py-3 rounded-md border shadow-md border-primary-500 dark:text-white">
                                        <span>{{ __('Remove Logo') }}</span>
                                    </button>
                                </div>
                                <p x-show="logoError" x-text="logoError" class="error-message"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6 mt-8">
                <!-- Employer Name -->
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="employer_name" id="employer_name"
                        class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-primary-500 focus:outline-none focus:ring-0 focus:border-primary-600 peer"
                        placeholder=" " required value="{{ old('employer_name', $employer->employer_name) }}" />
                    <label for="employer_name"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-text-dark peer-focus:bg-primary-50 peer-focus:dark:bg-primary-50 peer-focus:rounded peer-focus:border peer-focus:border-primary-600 peer-focus:dark:text-text-dark  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                        {{ __('Employer Name') }}
                    </label>
                    @error('employer_name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                 <!-- Employer Phone -->
                    <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="phone" id="phone"
                        class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-primary-500 focus:outline-none focus:ring-0 focus:border-primary-600 peer"
                        placeholder=" " required value="{{ old('phone', $employer->phone) }}" />
                    <label for="phone"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-text-dark peer-focus:bg-primary-50 peer-focus:dark:bg-primary-50 peer-focus:rounded peer-focus:border peer-focus:border-primary-600 peer-focus:dark:text-text-dark  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                        {{ __('Employer Phone') }}
                    </label>
                    @error('employer_name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- FEIN Number -->
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="fein_number" id="fein_number"
                        class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-primary-500 focus:outline-none focus:ring-0 focus:border-primary-600 peer"
                        placeholder=" " value="{{ old('fein_number', $employer->fein_number) }}" />
                    <label for="fein_number"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-text-dark peer-focus:bg-primary-50 peer-focus:dark:bg-primary-50 peer-focus:rounded peer-focus:border peer-focus:border-primary-600 peer-focus:dark:text-text-dark  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                        {{ __('FEIN Number') }}
                    </label>
                    @error('fein_number')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Contact Person Name -->
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="contact_person_name" id="contact_person_name"
                        class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-primary-500 focus:outline-none focus:ring-0 focus:border-primary-600 peer"
                        placeholder=" " value="{{ old('contact_person_name', $employer->contact_person_name) }}" />
                    <label for="contact_person_name"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-text-dark peer-focus:bg-primary-50 peer-focus:dark:bg-primary-50 peer-focus:rounded peer-focus:border peer-focus:border-primary-600 peer-focus:dark:text-text-dark  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                        {{ __('Contact Person Name') }}
                    </label>
                    @error('contact_person_name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Website -->
                <div class="relative z-0 w-full mb-5 group">
                    <input type="url" name="website" id="website"
                        class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-primary-500 focus:outline-none focus:ring-0 focus:border-primary-600 peer"
                        placeholder=" " value="{{ old('website', $employer->website) }}" />
                    <label for="website"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-text-dark peer-focus:bg-primary-50 peer-focus:dark:bg-primary-50 peer-focus:rounded peer-focus:border peer-focus:border-primary-600 peer-focus:dark:text-text-dark  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                        {{ __('Website') }}
                    </label>
                    @error('website')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                   <!-- Address -->
                   <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="address" id="address"
                        class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-primary-500 focus:outline-none focus:ring-0 focus:border-primary-600 peer"
                        placeholder=" " value="{{ old('address', $employer->address) }}" />
                    <label for="address"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-text-dark peer-focus:bg-primary-50 peer-focus:dark:bg-primary-50 peer-focus:rounded peer-focus:border peer-focus:border-primary-600 peer-focus:dark:text-text-dark  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                        {{ __('Address') }}
                    </label>
                    @error('address')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Address1 -->
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="address1" id="address1"
                        class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-primary-500 focus:outline-none focus:ring-0 focus:border-primary-600 peer"
                        placeholder=" " value="{{ old('address1', $employer->address1) }}" />
                    <label for="address1"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-text-dark peer-focus:bg-primary-50 peer-focus:dark:bg-primary-50 peer-focus:rounded peer-focus:border peer-focus:border-primary-600 peer-focus:dark:text-text-dark  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                        {{ __('Address 1') }}
                    </label>
                    @error('address1')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

             

                <!-- City -->
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="city" id="city"
                        class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-primary-500 focus:outline-none focus:ring-0 focus:border-primary-600 peer"
                        placeholder=" " value="{{ old('city', $employer->city) }}" />
                    <label for="city"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-text-dark peer-focus:bg-primary-50 peer-focus:dark:bg-primary-50 peer-focus:rounded peer-focus:border peer-focus:border-primary-600 peer-focus:dark:text-text-dark  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                        {{ __('City') }}
                    </label>
                    @error('city')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- State -->
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="state" id="state"
                        class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-primary-500 focus:outline-none focus:ring-0 focus:border-primary-600 peer"
                        placeholder=" " value="{{ old('state', $employer->state) }}" />
                    <label for="state"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-text-dark peer-focus:bg-primary-50 peer-focus:dark:bg-primary-50 peer-focus:rounded peer-focus:border peer-focus:border-primary-600 peer-focus:dark:text-text-dark  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                        {{ __('State') }}
                    </label>
                    @error('state')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Country -->
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="country" id="country"
                        class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-primary-500 focus:outline-none focus:ring-0 focus:border-primary-600 peer"
                        placeholder=" " value="{{ old('country', $employer->country) }}" />
                    <label for="country"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-text-dark peer-focus:bg-primary-50 peer-focus:dark:bg-primary-50 peer-focus:rounded peer-focus:border peer-focus:border-primary-600 peer-focus:dark:text-text-dark  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                        {{ __('Country') }}
                    </label>
                    @error('country')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Zip -->
                <div class="relative z-0 w-full mb-5 group ">
                    <input type="text" name="zip" id="zip"
                        class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-primary-500 focus:outline-none focus:ring-0 focus:border-primary-600 peer"
                        placeholder=" " value="{{ old('zip', $employer->zip) }}" />
                    <label for="zip"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-text-dark peer-focus:bg-primary-50 peer-focus:dark:bg-primary-50 peer-focus:rounded peer-focus:border peer-focus:border-primary-600 peer-focus:dark:text-text-dark  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                        {{ __('Zip') }}
                    </label>
                    @error('zip')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                {{-- Account Details --}}
                <div class="form-field">
                    <textarea name="account_details" id="account_details" placeholder=" {{ old('account_details', $employer->account_details) }} "> {{ old('account_details', $employer->account_details) }} </textarea>
                    <label for="account_details">
                        {{ __('Account Details') }}
                    </label>
                </div>
            </div>

            <button type="submit"
                class="mt-6 text-text-light dark:text-text-dark bg-primary-50 hover:bg-primary-300 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-primary-50 dark:hover:bg-primary-50 dark:focus:ring-primary-800">
                {{ __('Save Settings') }}
            </button>
        </form>
    </div>
</x-app-layout>

<!-- Add this script for preview functionality -->
<script>
    function logoUpload() {
        return {
            logoPreview: '{{ asset($employer->image) }}', // Set default logo preview from existing data
            logoError: '',
            handleLogoUpload(event) {
                const file = event.target.files[0];
                if (!file) return;

                // Check file type
                if (!['image/jpeg', 'image/png'].includes(file.type)) {
                    this.logoError = 'Please upload a JPEG or PNG file.';
                    return;
                }

                // Check dimensions
                const img = new Image();
                img.crossOrigin = 'anonymous';
                img.onload = () => {
                    if (img.width < 200 || img.height < 200) {
                        this.logoError = 'Image must be at least 200x200 pixels.';
                        return;
                    }
                    this.logoError = '';
                };

                // Create preview URL
                const reader = new FileReader();
                reader.onloadend = () => {
                    this.logoPreview = reader.result;
                };
                reader.readAsDataURL(file);
                img.src = URL.createObjectURL(file);
            },
            removeLogo() {
                this.logoPreview = '{{ $employer->image }}'; // Reset to existing logo
                this.logoError = '';
            }
        };
    }

</script>