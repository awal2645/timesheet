@section('title')
    {{ __('Create Client') }}
@endsection
<x-app-layout>
    <div class="flex justify-between m-6 card">
        <h2 class="text-xl text-text-light dark:text-text-dark font-medium">{{ __('Create Client') }}</h2>
        <a href="{{ route('client.index') }}"
            class="btn bg-primary-50 dark:bg-primary-50 text-text-light dark:text-text-dark">{{ __('Go to Client
            List') }}</a>
    </div>
    <div class="card m-6">
        <h2 class="text-2xl text-text-light dark:text-text-dark font-bold mb-4">{{ __('Create New Client') }}</h2>
        <form method="POST" action="{{ route('client.store') }}">
            @csrf
            <!-- Employer Name -->
            @if (auth('web')->user()->role != 'employer')
                <div class="form-field">
                    <select name="employer_id" id="employer_id" class="form-select" required>
                        <option value="" disabled selected hidden>{{ __('Select Employer') }}</option>
                        @foreach ($employers as $employer)
                            <option class="dark:bg-slate-800 text-text-light dark:text-text-dark "
                                value="{{ $employer->id }}">
                                {{ $employer->employer_name }}
                            </option>
                        @endforeach
                    </select>
                    <label for="employer_id" class="form-label">{{ __('Employer Name') }}</label>
                </div>
            @endif
            @if (auth('web')->user()->role == 'employer')
                <input type="hidden" name="employer_id" value="{{ auth('web')->user()->employer->id }}">
            @endif
            <!-- Client Name -->
            <div class="form-field">
                <input type="text" name="client_name" id="client_name" placeholder=" " required
                    value="{{ old('client_name') }}" />
                <label for="client_name">
                    {{ __('Client Name') }}
                </label>
                @error('client_name')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- Client Email -->
            <div class="form-field">
                <input type="email" name="client_email" id="client_email" placeholder=" " required
                    value="{{ old('client_email') }}" />
                <label for="client_email">
                    {{ __('Client Email') }}
                </label>
                @error('client_email')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- Client Phone -->
            <div class="form-field">
                <input type="text" name="client_phone" id="client_phone" placeholder=" " required
                    value="{{ old('client_phone') }}" />
                <label for="client_phone">
                    {{ __('Client Phone') }}
                </label>
                @error('client_phone')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- Contact Name -->
            <div class="form-field">
                <input type="text" name="contact_name" id="contact_name" placeholder=" " required
                    value="{{ old('contact_name') }}" />
                <label for="contact_name">
                    {{ __('Contact Name') }}
                </label>
                @error('contact_name')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            {{-- <!-- Contact Image -->
            <div class="relative z-0 w-full mb-5">
                <input type="file" name="contact_name" class="filepond" required
                    value="{{ old('contact_name') }}" />
            </div> --}}
            <button type="submit"
                class="text-text-light dark:text-text-dark bg-primary-50 dark:bg-primary-50 hover:bg-primary-600 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">{{ __('Submit') }}</button>
        </form>
    </div>
</x-app-layout>
<style>
    .filepond--panel-root {
        background-color: transparent;
        border: 1px solid rgb(209, 213, 219, 1);
    }

    .dark .filepond--panel-root {
        border: 1px solid rgba(75, 85, 99, 1)
    }
</style>
@vite('resources/js/filepond.js')
<script defer>
    document.addEventListener('DOMContentLoaded', () => {
        const inputElement = document.querySelector('.filepond');
        // Create a FilePond instance
        const pond = filepond.create(inputElement, {
            acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg'],
            maxFileSize: '5MB',
            storeAsFile: true,
            allowMultiple: true,
            credits: false,
            labelIdle: `Drag & Drop Images or <span class="filepond--label-action">Browse</span><br><p class="filepone-text-size text-gray-500">Recommended image size Width:272px, Height:196px</p>`,
        });
    });
</script>
