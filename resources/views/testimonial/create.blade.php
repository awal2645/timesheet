@section('title')
    {{ __('Create Testimonial') }}
@endsection
<x-app-layout>
    <div class="flex justify-between items-center m-6 card">
        <h2 class="text-xl text-text-light dark:text-text-dark font-medium">{{ __('Create Testimonial') }}</h2>
        <a href="{{ route('testimonial.index') }}"
            class="btn bg-primary-50 dark:bg-primary-50 text-text-light dark:text-text-dark">{{ __('Go to Testimonial List') }}</a>
    </div>
    <div class="card m-6">
        <h2 class="text-2xl text-text-light dark:text-text-dark font-bold mb-4">{{ __('Create New Testimonial') }}</h2>
        <form method="POST" action="{{ route('testimonial.store') }}" enctype="multipart/form-data">
            @csrf
            <!-- Testimonial Name -->
            <div class="form-field">
                <input type="text" name="name" id="name" placeholder=" " required value="{{ old('name') }}" />
                <label for="name">{{ __('Name') }}</label>
                @error('name')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- Designation -->
            <div class="form-field">
                <input type="text" name="designation" id="designation" placeholder=" " required value="{{ old('designation') }}" />
                <label for="designation">{{ __('Designation') }}</label>
                @error('designation')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- Company -->
            <div class="form-field">
                <input type="text" name="company" id="company" placeholder=" " required value="{{ old('company') }}" />
                <label for="company">{{ __('Company') }}</label>
                @error('company')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- Description -->
            <div class="form-field">
                <textarea name="description" id="description" placeholder=" " required class="border rounded-lg p-2 w-full">{{ old('description') }}</textarea>
                <label for="description" class="text-sm text-gray-600">{{ __('Description') }}</label>
                @error('description')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- Rating -->
            <div class="form-field">
                <input type="number" name="rating" id="rating" placeholder=" " required value="{{ old('rating') }}" />
                <label for="rating">{{ __('Rating') }}</label>
                @error('rating')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- Image -->
            <div class="form-field">
                <input type="file" name="image" id="image" required />
                <label for="image">{{ __('Image') }}</label>
                @error('image')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="text-text-light dark:text-text-dark bg-primary-50 dark:bg-primary-50 hover:bg-primary-50 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-md text-sm w-full sm:w-auto px-5 py-2.5 text-center">{{ __('Submit') }}</button>
        </form>
    </div>
</x-app-layout>