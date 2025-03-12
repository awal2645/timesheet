@section('title')
    {{ __('Edit Testimonial') }}
@endsection
<x-app-layout>
    <div class="flex justify-between items-center m-6 card">
        <h2 class="text-xl text-text-light dark:text-text-dark font-medium">{{ __('Edit Testimonial') }}</h2>
        <a href="{{ route('testimonial.index') }}"
            class="btn bg-primary-50 dark:bg-primary-50 text-text-light dark:text-text-dark">{{ __('Go to Testimonial List') }}</a>
    </div>
    <div class="card m-6 p-6">
        <h2 class="text-2xl text-text-light dark:text-text-dark font-bold mb-4">{{ __('Edit Testimonial') }}</h2>
        <form method="POST" action="{{ route('testimonial.update', $testimonial->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- Testimonial Name -->
            <div class="form-field mb-4">
                <input type="text" name="name" id="name" placeholder=" " required value="{{ old('name', $testimonial->name) }}" class="border rounded-lg p-2 w-full" />
                <label for="name" class="text-sm text-gray-600">{{ __('Name') }}</label>
                @error('name')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- Designation -->
            <div class="form-field mb-4">
                <input type="text" name="designation" id="designation" placeholder=" " required value="{{ old('designation', $testimonial->designation) }}" class="border rounded-lg p-2 w-full" />
                <label for="designation" class="text-sm text-gray-600">{{ __('Designation') }}</label>
                @error('designation')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- Company -->
            <div class="form-field mb-4">
                <input type="text" name="company" id="company" placeholder=" " required value="{{ old('company', $testimonial->company) }}" class="border rounded-lg p-2 w-full" />
                <label for="company" class="text-sm text-gray-600">{{ __('Company') }}</label>
                @error('company')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- Description -->
            <div class="form-field mb-4">
                <textarea name="description" id="description" placeholder=" " required class="border rounded-lg p-2 w-full">{{ old('description', $testimonial->description) }}</textarea>
                <label for="description" class="text-sm text-gray-600">{{ __('Description') }}</label>
                @error('description')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- Rating -->
            <div class="form-field mb-4">
                <input type="text" name="rating" id="rating" placeholder=" " required value="{{ old('rating', $testimonial->rating) }}" class="border rounded-lg p-2 w-full" />
                <label for="rating" class="text-sm text-gray-600">{{ __('Rating') }}</label>
                @error('rating')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- Image -->
            <div class="form-field mb-4">
                <input type="file" name="image" id="image" class="border rounded-lg p-2 w-full" />
                <label for="image" class="text-sm text-gray-600">{{ __('Image') }}</label>
                @error('image')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="text-text-light dark:text-text-dark bg-primary-50 dark:bg-primary-50 hover:bg-primary-50 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-md text-sm w-full sm:w-auto px-5 py-2.5 text-center">{{ __('Update') }}</button>
        </form>
    </div>
</x-app-layout>