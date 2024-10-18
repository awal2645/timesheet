@section('title')
{{ 'SMTP Config' }}
@endsection

<x-app-layout>
    <div class="max-w-lg mx-auto mt-6 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">SMTP Config</h2>
        <form method="POST" action="{{ route('email.update') }}" class="max-w-md mx-auto" autocomplete="off">
            @method('PUT')

            @csrf
            <!-- MAIL HOST -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" id="mail_host"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder="" required name="mail_host" value="{{ env('MAIL_HOST') }}" />
                <label for="mail_host"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    MAIL HOST
                </label>
                @error('mail_host')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- MAIL PORT -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" id="mail_port"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder="" required name="mail_port" value="{{ env('MAIL_PORT') }}" />
                <label for="mail_port"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    MAIL PORT
                </label>
                @error('mail_port')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- MAIL USERNAME -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" id="mail_username"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder="" name="mail_username" value="{{ env('MAIL_USERNAME') }}" />
                <label for="mail_username"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    MAIL USERNAME
                </label>
                @error('mail_username')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- MAIL PASSWORD -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="password" id="mail_password"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder="" name="mail_password" value="{{ env('MAIL_PASSWORD') }}"  autocomplete="false/>
                <label for="mail_password"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    MAIL PASSWORD
                </label>
                @error('mail_password')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- MAIL ENCRYPTION -->
            <div class="relative z-0 w-full mb-5 group">
                <select name="mail_encryption" id="mail_encryption"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                    <option class="dark:bg-slate-800" value="tls" {{ env('MAIL_ENCRYPTION')=='tls' ? 'selected' : '' }}>
                        TLS</option>
                    <option class="dark:bg-slate-800" value="ssl" {{ env('MAIL_ENCRYPTION')=='ssl' ? 'selected' : '' }}>
                        SSL</option>
                </select>
                <label for="mail_encryption"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    MAIL ENCRYPTION
                </label>
                @error('mail_encryption')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- MAIL FROM ADDRESS -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="email" id="mail_from_address"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder="" required name="mail_from_address" value="{{ env('MAIL_FROM_ADDRESS') }}" />
                <label for="mail_from_address"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    MAIL FROM ADDRESS
                </label>
                @error('mail_from_address')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- MAIL FROM NAME -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" id="mail_from_name"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder="" required name="mail_from_name" value="{{ env('MAIL_FROM_NAME') }}" />
                <label for="mail_from_name"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    MAIL FROM NAME
                </label>
                @error('mail_from_name')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Save SMTP Configuration
            </button>
        </form>
    </div>
</x-app-layout>