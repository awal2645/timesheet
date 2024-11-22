@section('title')
    {{ __('Send Invite') }}
@endsection

<x-app-layout>
    @if (auth('web')->user()->role == 'superadmin')
        <div class="m-6 p-6 bg-white dark:bg-black/10 border border-black/10 dark:border-white/10 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-4">{{ __('Send Invite') }}</h2>

            <form method="POST" action="{{ route('invite.send.employer') }}"
                class="rounded-lg p-6 bg-white/30 dark:bg-black/30 border border-black/10 dark:border-white/10">
                @csrf
                <div class="relative z-0 w-full mb-5 group">
                    <select name="role_name" id="role_name"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:bg-color-gray-600 dark:border-gray-600 dark:focus:border-purple-500 focus:outline-none focus:ring-0 focus:border-purple-600 peer">
                        <option value="" class="dark:bg-slate-800">
                            {{ __('Select Role') }}
                        </option>
                        @foreach ($roles as $role)
                            <option class="dark:bg-slate-800 capitalize" value="{{ $role->name }}">
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                    <label for="role_name"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-purple-600 peer-focus:dark:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        {{ __('Role Name') }}</label>
                    @error('role_name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Employer Email -->
                <div class="relative z-0 w-full mb-5 group">
                    <input type="email" name="email" id="email"
                        class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-purple-500 focus:outline-none focus:ring-0 focus:border-purple-600 peer"
                        placeholder=" " required value="{{ old('email') }}" />
                    <label for="email"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-purple-600 peer-focus:dark:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{ __('Employer Email') }}</label>
                    @error('email')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit"
                    class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-purple-500 dark:hover:bg-purple-700 dark:focus:ring-purple-800">{{ __('Submit') }}</button>
            </form>
        </div>
    @else
        <div class="max-w-lg mx-auto mt-6 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-4">{{ __('Send Invite to Employee') }}</h2>
            <form method="POST" action="{{ route('invite.send.employee') }}" class="max-w-md mx-auto">
                @csrf
                <div class="relative z-0 w-full mb-5 group">
                    <select name="role_name" id="role_name"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:bg-color-gray-600 dark:border-gray-600 dark:focus:border-purple-500 focus:outline-none focus:ring-0 focus:border-purple-600 peer">
                        <option value="" class="dark:bg-slate-800">
                            {{ __('Select Role') }}
                        </option>
                        @foreach ($roles as $role)
                            @if ($role->name != 'superadmin')
                                <option class="dark:bg-slate-800 capitalize" value="{{ $role->name }}">
                                    {{ $role->name }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                    <label for="role_name"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-purple-600 peer-focus:dark:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        {{ __('Role Name') }}</label>
                    @error('role_name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Employee Email -->
                <div class="relative z-0 w-full mb-5 group">
                    <input type="email" name="email" id="email"
                        class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-purple-500 focus:outline-none focus:ring-0 focus:border-purple-600 peer @error('email') border-red-500 @enderror"
                        placeholder=" " required value="{{ old('email') }}" />
                    <label for="email"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-purple-600 peer-focus:dark:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{ __('Employee Email') }}</label>
                    @error('email')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit"
                    class="text-white bg-purple-500 dark:bg-purple-900 hover:bg-[#1da8f7] focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-purple-500 dark:hover:bg-purple-700 dark:focus:ring-purple-800">{{ __('Submit') }}</button>
            </form>
        </div>
    @endif
</x-app-layout>
