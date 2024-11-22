@section('title')
    {{ __('Create Employer') }}
@endsection
<x-app-layout>
    <div
        class="flex justify-between m-8 bg-white/10 px-8 py-4 rounded-lg border border-black/10 dark:border-white/10 dark:bg-black/10 backdrop-blur">
        <h2 class="text-xl font-medium">{{ __('Create Employer') }}</h2>
        <a href="{{ route('employer.index') }}"
            class="btn bg-purple-500 dark:bg-purple-900 text-white">{{ __('Go to Employer List') }}</a>
    </div>

    <div
        class="m-8 p-6 bg-white/10 backdrop-blur border border-black/10 dark:bg-black/10 dark:border-white/10 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">{{ __('Create New Employer') }}</h2>

        <form method="POST" action="{{ route('employer.store') }}">
            @csrf
            <!-- Employer Name -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="employer_name" id="employer_name"
                    class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-purple-500 focus:outline-none focus:ring-0 focus:border-purple-600 peer"
                    placeholder=" " required value="{{ old('employer_name') }}" />
                <label for="employer_name"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-purple-600 peer-focus:bg-purple-50 peer-focus:dark:bg-purple-300 peer-focus:rounded peer-focus:border peer-focus:border-purple-600 peer-focus:dark:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                    {{ __('Employer Name') }}
                </label>
                @error('employer_name')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Employer Email -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="email" name="email" id="email"
                    class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-purple-500 focus:outline-none focus:ring-0 focus:border-purple-600 peer"
                    placeholder=" " required value="{{ old('email') }}" />
                <label for="email"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-purple-600 peer-focus:bg-purple-50 peer-focus:dark:bg-purple-300 peer-focus:rounded peer-focus:border peer-focus:border-purple-600 peer-focus:dark:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                    {{ __('Email') }}
                </label>
                @error('email')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- FEIN Number -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="fein_number" id="fein_number"
                    class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-purple-500 focus:outline-none focus:ring-0 focus:border-purple-600 peer"
                    placeholder=" " value="{{ old('fein_number') }}" />
                <label for="fein_number"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-purple-600 peer-focus:bg-purple-50 peer-focus:dark:bg-purple-300 peer-focus:rounded peer-focus:border peer-focus:border-purple-600 peer-focus:dark:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                    {{ __('FEIN/Registration Number') }}
                </label>
                @error('fein_number')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Phone -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="phone" id="phone"
                    class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-purple-500 focus:outline-none focus:ring-0 focus:border-purple-600 peer"
                    placeholder=" " value="{{ old('phone') }}" />
                <label for="phone"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-purple-600 peer-focus:bg-purple-50 peer-focus:dark:bg-purple-300 peer-focus:rounded peer-focus:border peer-focus:border-purple-600 peer-focus:dark:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                    {{ __('Phone') }}
                </label>
                @error('phone')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Contact Person Name -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="contact_person_name" id="contact_person_name"
                    class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-purple-500 focus:outline-none focus:ring-0 focus:border-purple-600 peer"
                    placeholder=" " value="{{ old('contact_person_name') }}" />
                <label for="contact_person_name"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-purple-600 peer-focus:bg-purple-50 peer-focus:dark:bg-purple-300 peer-focus:rounded peer-focus:border peer-focus:border-purple-600 peer-focus:dark:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                    {{ __('Contact Person Name') }}
                </label>
                @error('contact_person_name')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Website -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="website" id="website"
                    class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-purple-500 focus:outline-none focus:ring-0 focus:border-purple-600 peer"
                    placeholder=" " value="{{ old('website') }}" />
                <label for="website"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-purple-600 peer-focus:bg-purple-50 peer-focus:dark:bg-purple-300 peer-focus:rounded peer-focus:border peer-focus:border-purple-600 peer-focus:dark:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                    {{ __('Website') }}
                </label>
                @error('website')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            @if (auth('web')->user()->role != 'employer')
                <!-- User Role -->
                <div class="relative z-0 w-full mb-5 group">
                    <select name="role_name" id="role_name"
                        class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-purple-500 focus:outline-none focus:ring-0 focus:border-purple-600 peer">
                        <option value="" class="dark:bg-slate-800">{{ __('Select Role') }}</option>
                        @foreach ($roles as $role)
                            <option class="dark:bg-slate-800 capitalize" value="employer">{{ ucfirst($role->name) }}
                            </option>
                        @endforeach
                    </select>
                    <label for="role_name"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-purple-600 peer-focus:bg-purple-50 peer-focus:dark:bg-purple-300 peer-focus:rounded peer-focus:border peer-focus:border-purple-600 peer-focus:dark:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                        {{ __('Role Name') }}
                    </label>
                    @error('role_name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            @endif

            <!-- Address Fields -->
            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="address" id="address"
                        class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-purple-500 focus:outline-none focus:ring-0 focus:border-purple-600 peer"
                        placeholder=" " value="{{ old('address') }}" />
                    <label for="address"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-purple-600 peer-focus:bg-purple-50 peer-focus:dark:bg-purple-300 peer-focus:rounded peer-focus:border peer-focus:border-purple-600 peer-focus:dark:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                        {{ __('Address 1') }}
                    </label>
                    @error('address')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="address1" id="address1"
                        class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-purple-500 focus:outline-none focus:ring-0 focus:border-purple-600 peer"
                        placeholder=" " value="{{ old('address1') }}" />
                    <label for="address1"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-purple-600 peer-focus:bg-purple-50 peer-focus:dark:bg-purple-300 peer-focus:rounded peer-focus:border peer-focus:border-purple-600 peer-focus:dark:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                        {{ __('Address 2') }}
                    </label>
                    @error('address1')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <button type="submit"
                class="text-white bg-purple-500 dark:bg-purple-900 hover:bg-purple-600 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                {{ __('Submit') }}
            </button>
        </form>
    </div>
</x-app-layout>
