<x-app-layout>
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">{{ __('Edit Testimonial') }}</h1>

        <form action="{{ route('testimonial.update', $testimonial) }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Name') }}</label>
                <input type="text" name="name" id="name" value="{{ old('name', $testimonial->name) }}" required
                       class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-primary-50 focus:ring focus:ring-primary-50 focus:ring-opacity-50">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="designation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Designation') }}</label>
                <input type="text" name="designation" id="designation" value="{{ old('designation', $testimonial->designation) }}" required
                       class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-primary-50 focus:ring focus:ring-primary-50 focus:ring-opacity-50">
                @error('designation')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="company" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Company') }}</label>
                <input type="text" name="company" id="company" value="{{ old('company', $testimonial->company) }}" required
                       class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-primary-50 focus:ring focus:ring-primary-50 focus:ring-opacity-50">
                @error('company')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Description') }}</label>
                <textarea name="description" id="description" rows="4" required
                          class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-primary-50 focus:ring focus:ring-primary-50 focus:ring-opacity-50">{{ old('description', $testimonial->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="rating" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Rating') }}</label>
                <select name="rating" id="rating" required
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-primary-50 focus:ring focus:ring-primary-50 focus:ring-opacity-50">
                    <option value="">{{ __('Select Rating') }}</option>
                    @for($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ old('rating', $testimonial->rating) == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
                @error('rating')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Image') }}</label>
                @if($testimonial->image)
                    <div class="mb-2">
                        <img src="{{ asset($testimonial->image) }}" alt="{{ $testimonial->name }}" class="h-20 w-20 rounded-full">
                    </div>
                @endif
                <input type="file" name="image" id="image" accept="image/*"
                       class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-400
                              file:mr-4 file:py-2 file:px-4
                              file:rounded-md file:border-0
                              file:text-sm file:font-semibold
                              file:bg-primary-50 file:text-white
                              hover:file:bg-primary-300">
                @error('image')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-4">
                <a href="{{ route('testimonial.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                    {{ __('Cancel') }}
                </a>
                <button type="submit" class="px-4 py-2 bg-primary-50 text-white rounded-md hover:bg-primary-300">
                    {{ __('Update Testimonial') }}
                </button>
            </div>
        </form>
    </div>
</div>
</x-app-layout>