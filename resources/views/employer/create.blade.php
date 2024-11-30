@section('title')
    {{ __('Create Employer') }}
@endsection
<x-app-layout>
    <div class="flex justify-between m-6 card">
        <h2 class="text-xl font-medium">{{ __('Create Employer') }}</h2>
        <a href="{{ route('employer.index') }}"
            class="btn bg-primary-300 dark:bg-primary-900 text-white">{{ __('Go to Employer List') }}</a>
    </div>

    <div class="card m-6">
        <h2 class="text-2xl font-bold mb-4">{{ __('Create New Employer') }}</h2>

        <form method="POST" action="{{ route('employer.store') }}">
            @csrf
            <!-- Employer Name -->
            <div class="form-field">
                <input type="text" name="employer_name" id="employer_name" placeholder=" " required
                    value="{{ old('employer_name') }}" />
                <label for="employer_name">
                    {{ __('Employer Name') }}
                </label>
                @error('employer_name')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Employer Email -->
            <div class="form-field">
                <input type="email" name="email" id="email" placeholder=" " required
                    value="{{ old('email') }}" />
                <label for="email">
                    {{ __('Email') }}
                </label>
                @error('email')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- FEIN Number -->
            <div class="form-field">
                <input type="text" name="fein_number" id="fein_number" placeholder=" "
                    value="{{ old('fein_number') }}" />
                <label for="fein_number">
                    {{ __('FEIN/Registration Number') }}
                </label>
                @error('fein_number')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Phone -->
            <div class="form-field">
                <input type="text" name="phone" id="phone" placeholder=" " value="{{ old('phone') }}" />
                <label for="phone">
                    {{ __('Phone') }}
                </label>
                @error('phone')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Contact Person Name -->
            <div class="form-field">
                <input type="text" name="contact_person_name" id="contact_person_name" placeholder=" "
                    value="{{ old('contact_person_name') }}" />
                <label for="contact_person_name">
                    {{ __('Contact Person Name') }}
                </label>
                @error('contact_person_name')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Website -->
            <div class="form-field">
                <input type="text" name="website" id="website" placeholder=" " value="{{ old('website') }}" />
                <label for="website">
                    {{ __('Website') }}
                </label>
                @error('website')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            @if (auth('web')->user()->role != 'employer')
                <!-- User Role -->
                <div class="form-field">
                    <select name="role_name" id="role_name" class="form-select">
                        <option value="" class="dark:bg-slate-800">{{ __('Select Role') }}</option>
                        @foreach ($roles as $role)
                            <option class="dark:bg-slate-800 capitalize" value="employer">{{ ucfirst($role->name) }}
                            </option>
                        @endforeach
                    </select>
                    <label for="role_name" class="form-label">
                        {{ __('Role Name') }}
                    </label>
                    @error('role_name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            @endif

            <!-- Address Fields -->
            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="form-field">
                    <input type="text" name="address" id="address" placeholder=" " value="{{ old('address') }}" />
                    <label for="address">
                        {{ __('Address 1') }}
                    </label>
                    @error('address')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-field">
                    <input type="text" name="address1" id="address1" placeholder=" "
                        value="{{ old('address1') }}" />
                    <label for="address1">
                        {{ __('Address 2') }}
                    </label>
                    @error('address1')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <button type="submit"
                class="text-white bg-primary-300 dark:bg-primary-900 hover:bg-primary-600 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                {{ __('Submit') }}
            </button>
        </form>
    </div>
</x-app-layout>
