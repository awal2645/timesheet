@section('title')
    {{ __('SMTP Config') }}
@endsection

<x-app-layout>
    <div class="m-6 p-6 bg-white/10 dark:bg-black/10 border border-black/10 dark:border-white/10 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">{{ __('SMTP Config') }}</h2>
        <form method="POST" action="{{ route('email.update') }}" class="p-8 rounded-lg bg-white/30 dark:bg-black/30 border border-black/30 dark:border-white/30" autocomplete="off">
            @method('PUT')
            @csrf

            <!-- MAIL HOST -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" id="mail_host"
                    class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder="" required name="mail_host" value="{{ env('MAIL_HOST') }}" />
                <label for="mail_host"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    {{ __('MAIL HOST') }}
                </label>
                @error('mail_host')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- MAIL PORT -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" id="mail_port"
                    class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder="" required name="mail_port" value="{{ env('MAIL_PORT') }}" />
                <label for="mail_port"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    {{ __('MAIL PORT') }}
                </label>
                @error('mail_port')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- MAIL USERNAME -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" id="mail_username"
                    class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder="" name="mail_username" value="{{ env('MAIL_USERNAME') }}" />
                <label for="mail_username"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    {{ __('MAIL USERNAME') }}
                </label>
                @error('mail_username')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- MAIL PASSWORD -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="password" id="mail_password"
                    class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder="" name="mail_password" value="{{ env('MAIL_PASSWORD') }}" autocomplete="false" />
                <label for="mail_password"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    {{ __('MAIL PASSWORD') }}
                </label>
                @error('mail_password')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- MAIL ENCRYPTION -->
            <div class="relative z-0 w-full mb-5 group">
                <select name="mail_encryption" id="mail_encryption"
                    class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                    <option class="dark:bg-slate-800" value="tls"
                        {{ env('MAIL_ENCRYPTION') == 'tls' ? 'selected' : '' }}>
                        {{ __('TLS') }}
                    </option>
                    <option class="dark:bg-slate-800" value="ssl"
                        {{ env('MAIL_ENCRYPTION') == 'ssl' ? 'selected' : '' }}>
                        {{ __('SSL') }}
                    </option>
                </select>
                <label for="mail_encryption"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    {{ __('MAIL ENCRYPTION') }}
                </label>
                @error('mail_encryption')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- MAIL FROM ADDRESS -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="email" id="mail_from_address"
                    class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder="" required name="mail_from_address" value="{{ env('MAIL_FROM_ADDRESS') }}" />
                <label for="mail_from_address"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    {{ __('MAIL FROM ADDRESS') }}
                </label>
                @error('mail_from_address')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- MAIL FROM NAME -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" id="mail_from_name"
                    class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder="" required name="mail_from_name" value="{{ env('MAIL_FROM_NAME') }}" />
                <label for="mail_from_name"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    {{ __('MAIL FROM NAME') }}
                </label>
                @error('mail_from_name')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- SAVE BUTTON -->
            <button type="submit"
                class="w-full text-white bg-purple-500 hover:bg-purple-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none focus:ring-opacity-50">
                {{ __('Save') }}
            </button>
        </form>
    </div>
</x-app-layout>
