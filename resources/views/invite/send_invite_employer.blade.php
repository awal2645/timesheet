@section('title')
    {{ __('Send Invite') }}
@endsection

<x-app-layout>
    @if (auth('web')->user()->role == 'superadmin')
        <div class="m-6 card">
            <h2 class="text-2xl font-bold mb-4">{{ __('Send Invite') }}</h2>

            <form method="POST" action="{{ route('invite.send.employer') }}" class="card">
                @csrf
                <div class="form-field">
                    <select name="role_name" id="role_name"
                        class="form-select">
                        <option value="" class="dark:bg-slate-800   text-text-light  
 dark:text-text-dark  ">
                            {{ __('Select Role') }}
                        </option>
                        @foreach ($roles as $role)
                            <option class="dark:bg-slate-800   text-text-light  
 dark:text-text-dark   capitalize" value="{{ $role->name }}">
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                    <label for="role_name" class="form-label">
                        {{ __('Role Name') }}</label>
                    @error('role_name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Employer Email -->
                <div class="form-field">
                    <input type="email" name="email" id="email" placeholder=" " required
                        value="{{ old('email') }}" />
                    <label for="email">{{ __('Employer Email') }}</label>
                    @error('email')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit"
                    class="text-white bg-primary-300 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-primary-300 dark:hover:bg-primary-300 dark:focus:ring-primary-800">{{ __('Submit') }}</button>
            </form>
        </div>
    @else
        <div class="max-w-lg mx-auto mt-6 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-4">{{ __('Send Invite to Employee') }}</h2>
            <form method="POST" action="{{ route('invite.send.employee') }}" class="max-w-md mx-auto">
                @csrf
                <div class="form-field">
                    <select name="role_name" id="role_name"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:bg-color-gray-600 dark:border-gray-600 dark:focus:border-primary-500 focus:outline-none focus:ring-0 focus:border-primary-600 peer">
                        <option value="" class="dark:bg-slate-800   text-text-light  
 dark:text-text-dark  ">
                            {{ __('Select Role') }}
                        </option>
                        @foreach ($roles as $role)
                            @if ($role->name != 'superadmin')
                                <option class="dark:bg-slate-800   text-text-light  
 dark:text-text-dark   capitalize" value="{{ $role->name }}">
                                    {{ $role->name }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                    <label for="role_name">
                        {{ __('Role Name') }}</label>
                    @error('role_name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Employee Email -->
                <div class="form-field">
                    <input type="email" name="email" id="email"
                        class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-primary-500 focus:outline-none focus:ring-0 focus:border-primary-600 peer @error('email') border-red-500 @enderror"
                        placeholder=" " required value="{{ old('email') }}" />
                    <label for="email">{{ __('Employee Email') }}</label>
                    @error('email')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit"
                    class="text-white bg-primary-300 dark:bg-primary-900 hover:bg-[#1da8f7] focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-primary-300 dark:hover:bg-primary-300 dark:focus:ring-primary-800">{{ __('Submit') }}</button>
            </form>
        </div>
    @endif
</x-app-layout>
