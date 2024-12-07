@section('title')
    {{ __('SMTP Config') }}
@endsection

<x-app-layout>
    <div class="m-6 p-6 bg-card-light dark:bg-card-dark border border-black/10 dark:border-white/10 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4 text-text-light dark:text-text-dark">{{ __('SMTP Config') }}</h2>
        <form method="POST" action="{{ route('email.update') }}" class="card grid gris-cols-1 md:grid-cols-2 gap-8"
            autocomplete="off">
            @method('PUT')
            @csrf

            <!-- MAIL HOST -->
            <div class="form-field">
                <input type="text" id="mail_host" placeholder="" required name="mail_host"
                    value="{{ smtp() ? smtp()->host : env('MAIL_HOST') }}" />
                <label for="mail_host">
                    {{ __('MAIL HOST') }}
                </label>
                @error('mail_host')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- MAIL PORT -->
            <div class="form-field">
                <input type="text" id="mail_port" placeholder="" required name="mail_port"
                    value="{{ smtp() ? smtp()->port : env('MAIL_PORT') }}" />
                <label for="mail_port">
                    {{ __('MAIL PORT') }}
                </label>
                @error('mail_port')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- MAIL USERNAME -->
            <div class="form-field">
                <input type="text" id="mail_username" placeholder="" name="mail_username"
                    value="{{ smtp() ? smtp()->username : env('MAIL_USERNAME') }}" />
                <label for="mail_username">
                    {{ __('MAIL USERNAME') }}
                </label>
                @error('mail_username')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- MAIL PASSWORD -->
            <div class="form-field">
                <input type="password" id="mail_password" placeholder="" name="mail_password"
                    value="{{ smtp() ? smtp()->password : env('MAIL_PASSWORD') }}" autocomplete="false" />
                <label for="mail_password">
                    {{ __('MAIL PASSWORD') }}
                </label>
                @error('mail_password')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- MAIL ENCRYPTION -->
            <div class="form-field">
                <select name="mail_encryption" id="mail_encryption" class="form-select">
                    <option class="dark:bg-slate-800   text-text-light  
 dark:text-text-dark  " value="tls"
                        {{ smtp() ? (smtp()->encryption == 'tls' ? 'selected' : '') : (env('MAIL_ENCRYPTION') == 'tls' ? 'selected' : '') }}>
                        {{ __('TLS') }}
                    </option>
                    <option class="dark:bg-slate-800   text-text-light  
 dark:text-text-dark  " value="ssl"
                        {{ smtp() ? (smtp()->encryption == 'ssl' ? 'selected' : '') : (env('MAIL_ENCRYPTION') == 'ssl' ? 'selected' : '') }}>
                        {{ __('SSL') }}
                    </option>
                </select>

                <label for="mail_encryption" class="form-label">
                    {{ __('MAIL ENCRYPTION') }}
                </label>
                @error('mail_encryption')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- MAIL FROM ADDRESS -->
            <div class="form-field">
                <input type="email" id="mail_from_address" placeholder="" required name="mail_from_address"
                    value="{{ env('MAIL_FROM_ADDRESS') }}" />
                <label for="mail_from_address">
                    {{ __('MAIL FROM ADDRESS') }}
                </label>
                @error('mail_from_address')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- MAIL FROM NAME -->
            <div class="form-field">
                <input type="text" id="mail_from_name" placeholder="" required name="mail_from_name"
                    value="{{ smtp() ? smtp()->mail_from_name : env('MAIL_FROM_NAME') }}" />
                <label for="mail_from_name">
                    {{ __('MAIL FROM NAME') }}
                </label>
                @error('mail_from_name')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- SAVE BUTTON -->
            <div class="relative col-span-full z-0 w-full group">
                <button type="submit"
                    class="px-3 py-2 text-text-light dark:text-text-dark bg-primary-50 hover:bg-primary-50 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none focus:ring-opacity-50">
                    {{ __('Save') }}
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
