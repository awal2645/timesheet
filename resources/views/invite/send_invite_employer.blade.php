@section('title')
{{ __('Send Invite') }}
@endsection

<x-app-layout>
    @if (auth('web')->user()->role == 'superadmin')
    <div class="m-6 card">
        <h2 class="text-2xl font-bold mb-4 text-text-light dark:text-text-dark">{{ __('Send Invite') }}</h2>
        <form method="POST" action="{{ route('invite.send.employer') }}">
            @csrf
            <div class="form-field">
                <select name="role_name" id="role_name" class="form-select">
                    <option value="" class="dark:bg-slate-800 text-text-light dark:text-text-dark">
                        {{ __('Select Role') }}
                    </option>
                    @foreach ($roles as $role)
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark capitalize" value="{{ $role->name }}">
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
                <input type="email" name="email" id="email" placeholder=" " required value="{{ old('email') }}" />
                <label for="email">{{ __('Employer Email') }}</label>
                @error('email')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit"
                class="text-text-light dark:text-text-dark bg-primary-50 hover:bg-primary-300 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-primary-50 dark:hover:bg-primary-50 dark:focus:ring-primary-800">{{
                __('Submit') }}</button>
        </form>
    </div>
    @else
    <div class="m-6 card">
        <h2 class="text-2xl font-bold mb-4 text-text-light dark:text-text-dark">{{ __('Send Invite') }}</h2>
        <form method="POST" action="{{ route('invite.send.employer') }}">
            @csrf
            <div class="form-field">
                <select name="role_name" id="role_name" class="form-select">
                    <option value="" class="dark:bg-slate-800 text-text-light dark:text-text-dark">
                        {{ __('Select Role') }}
                    </option>
                    @foreach ($roles as $role)
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark capitalize" value="{{ $role->name }}">
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
                <input type="email" name="email" id="email" placeholder=" " required value="{{ old('email') }}" />
                <label for="email">{{ __('Employer Email') }}</label>
                @error('email')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit"
                class="text-text-light dark:text-text-dark bg-primary-50 hover:bg-primary-300 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-primary-50 dark:hover:bg-primary-50 dark:focus:ring-primary-800">{{
                __('Submit') }}</button>
        </form>
    </div>
    @endif
</x-app-layout>