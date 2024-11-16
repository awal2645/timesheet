@section('title')
    {{ __('Create Employer') }}
@endsection
<x-app-layout>
    <div class="max-w-lg mx-auto mt-6 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4"> {{ __('Create Employer') }}</h2>

        <form method="POST" action="{{ route('employer.store') }}" class="max-w-md mx-auto">
            @csrf
            <!-- Employer Name -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="employer_name" id="employer_name"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " required value="{{ old('employer_name') }}" />
                <label for="employer_name"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    {{ __('Employer Name') }}
                </label>
                @error('employer_name')
                    <span class=" text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- Employer Email -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="email" name="email" id="email"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " required value="{{ old('email') }}" />
                <label for="email"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    {{ __('Email') }}
                </label>
                @error('email')
                    <span class=" text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- FEIN Number -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="fein_number" id="fein_number"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " value="{{ old('fein_number') }}" />
                <label for="fein_number"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    {{ __('FEIN/Registration Number') }} </label>
                @error('fein_number')
                    <span class=" text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Phone -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="phone" id="phone"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " value="{{ old('phone') }}" />
                <label for="phone"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    {{ __('Phone') }}
                </label>
                @error('phone')
                    <span class=" text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- Contact Person Name -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="contact_person_name" id="contact_person_name"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " value="{{ old('contact_person_name') }}" />
                <label for="contact_person_name"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    {{ __('Contact Person Name') }}</label>
                @error('contact_person_name')
                    <span class=" text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Website -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="website" id="website"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " value="{{ old('website') }}" />
                <label for="website"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    {{ __('Website') }}</label>
                @error('website')
                    <span class=" text-red-500">{{ $message }}</span>
                @enderror
            </div>
            @if (auth('web')->user()->role != 'employer')
                <!-- User Role -->
                <div class="relative z-0 w-full mb-5 group">
                    <select name="role_name" id="role_name"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900  bg-transparent 	 border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:bg-color-gray-600 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                        <option value="" class="dark:bg-slate-800">
                            {{ __('Select Role') }}
                        </option>
                        @foreach ($roles as $role)
                            <option class="dark:bg-slate-800 capitalize" value="employer">
                                {{ ucfirst($role->name) }}
                            </option>
                        @endforeach
                    </select>
                    <label for="client_id"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        {{ __('Role Name') }}</label>
                    @error('role_name')
                        <span class=" text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            @endif

            <!-- Address -->
            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="address" id="address"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " value="{{ old('address') }}" />
                    <label for="address"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        {{ __('Address 1') }}</label>
                    @error('address')
                        <span class=" text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="address1" id="address1"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " value="{{ old('address1') }}" />
                    <label for="address1"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        {{ __('Address 2') }}</label>
                    @error('address1')
                        <span class=" text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <!-- Additional Address Fields -->
            <div class="grid md:grid-cols-2 md:gap-6">
                <!-- City -->
                <div class="relative w-full mb-5 group">
                    <input type="text" name="city" id="leaflet_search_city"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " value="{{ old('city') }}" />
                    <label for="city"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3  origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        {{ __('City') }}</label>
                    @error('city')
                        <span class=" text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- State -->
                <div class="relative w-full mb-5 group">
                    <input type="text" name="state" id="leaflet_search_state"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " value="{{ old('state') }}" />
                    <label for="state"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        {{ __('State') }}</label>
                    @error('state')
                        <span class=" text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="grid md:grid-cols-2 md:gap-6">
                {{-- @livewire('country-state-city') --}}

                <!-- Country -->
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="country" id="country"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " value="" />
                    <label for="country"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        {{ __('Country') }}</label>
                    @error('country')
                        <span class=" text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Zip -->
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="zip" id="zip"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " value="{{ old('zip') }}" />
                    <label for="zip"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        {{ __('Zip') }}</label>
                    @error('zip')
                        <span class=" text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-purple-500 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                {{ __('Submit') }}</button>
        </form>
    </div>
    <style>
        :root {
            --close-button: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath d='M18.984 6.422 13.406 12l5.578 5.578-1.406 1.406L12 13.406l-5.578 5.578-1.406-1.406L10.594 12 5.016 6.422l1.406-1.406L12 10.594l5.578-5.578z'/%3E%3C/svg%3E");
            --loupe-icon: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath fill='%23929292' d='M16.041 15.856a.995.995 0 0 0-.186.186A6.97 6.97 0 0 1 11 18c-1.933 0-3.682-.782-4.95-2.05S4 12.933 4 11s.782-3.682 2.05-4.95S9.067 4 11 4s3.682.782 4.95 2.05S18 9.067 18 11a6.971 6.971 0 0 1-1.959 4.856zm5.666 4.437-3.675-3.675A8.967 8.967 0 0 0 20 11c0-2.485-1.008-4.736-2.636-6.364S13.485 2 11 2 6.264 3.008 4.636 4.636 2 8.515 2 11s1.008 4.736 2.636 6.364S8.515 20 11 20a8.967 8.967 0 0 0 5.618-1.968l3.675 3.675a.999.999 0 1 0 1.414-1.414z'/%3E%3C/svg%3E")
        }

        .auto-search-wrapper {
            display: block;
            position: relative;
            width: 100%
        }

        .auto-search-wrapper input {
            border: 1px solid #d7d7d7;
            box-shadow: none;
            box-sizing: border-box;
            font-size: 16px;
            padding: 12px 45px 12px 10px;
            width: 100%
        }

        .auto-search-wrapper input:focus {
            border: 1px solid #858585;
            outline: none
        }

        .auto-search-wrapper input::-ms-clear {
            display: none
        }

        .auto-search-wrapper ul {
            list-style: none;
            margin: 0;
            overflow: hidden;
            padding: 0
        }

        .auto-search-wrapper ul li {
            cursor: pointer;
            margin: 0;
            overflow: hidden;
            padding: 10px;
            position: relative
        }

        .auto-search-wrapper ul li:not(:last-child) {
            border-top: none
        }

        .auto-search-wrapper ul li[disabled] {
            background: #ececec;
            opacity: .5;
            pointer-events: none
        }

        .auto-search-wrapper .auto-expanded {
            border: 1px solid #858585;
            outline: none
        }

        .auto-search-wrapper.loupe:before {
            filter: invert(60%)
        }

        .auto-is-loading:after {
            animation: auto-spinner .6s linear infinite;
            border-color: #d9d9d9 grey grey #d9d9d9;
            border-radius: 50%;
            border-style: solid;
            border-width: 2px;
            bottom: 0;
            box-sizing: border-box;
            content: "";
            height: 20px;
            margin: auto;
            position: absolute;
            right: 10px;
            top: 0;
            width: 20px
        }

        .auto-is-loading .auto-clear {
            display: none
        }

        @keyframes auto-spinner {
            to {
                transform: rotate(1turn)
            }
        }

        .loupe input {
            padding: 12px 45px 12px 35px
        }

        .loupe:before {
            bottom: 0;
            content: "";
            height: 17px;
            left: 10px;
            margin: auto;
            position: absolute;
            top: 0;
            width: 17px
        }

        .auto-clear {
            align-items: center;
            background-color: transparent;
            border: none;
            bottom: 0;
            cursor: pointer;
            display: flex;
            height: auto;
            justify-content: center;
            margin: auto;
            position: absolute;
            right: 0;
            top: 0;
            width: 40px
        }

        .auto-clear:before {
            content: var(--close-button);
            display: none;
            height: 24px;
            line-height: 100%;
            width: 24px
        }

        .auto-clear span {
            display: none
        }

        .auto-results-wrapper {
            background-color: #fff;
            border: 1px solid #858585;
            border-top: none;
            box-sizing: border-box;
            display: none;
            overflow: hidden
        }

        .auto-results-wrapper ul>.loupe {
            padding: 10px;
            cursor: pointer;
            font-size: 13px;
        }

        .auto-results-wrapper.auto-is-active {
            display: block;
            margin-top: -1px;
            position: absolute;
            width: 100%;
            z-index: 99999
        }

        .auto-selected {
            background-color: #1d4ed8;
            color: #fff;
        }

        .auto-selected+li:before {
            border-top: none
        }

        .auto-error {
            border: 1px solid #ff3838
        }

        .auto-error::placeholder {
            color: #f66;
            opacity: 1
        }

        .hidden {
            display: none
        }
    </style>
</x-app-layout>
