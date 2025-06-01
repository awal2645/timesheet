<x-app-layout>
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('Testimonials') }}</h1>
        <a href="{{ route('testimonial.create') }}" class="bg-primary-50 text-white px-4 py-2 rounded-md hover:bg-primary-300">
            {{ __('Add New Testimonial') }}
        </a>
    </div>

    <!-- Search Form -->
    <form action="{{ route('testimonial.index') }}" method="GET" class="mb-6">
        <div class="flex gap-4">
            <input type="text" name="search" value="{{ request('search') }}" 
                   class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-primary-50 focus:ring focus:ring-primary-50 focus:ring-opacity-50"
                   placeholder="{{ __('Search testimonials...') }}">
            <button type="submit" class="bg-primary-50 text-white px-4 py-2 rounded-md hover:bg-primary-300">
                {{ __('Search') }}
            </button>
        </div>
    </form>

    <!-- Testimonials List -->
    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        {{ __('Image') }}
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        {{ __('Name') }}
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        {{ __('Designation') }}
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        {{ __('Company') }}
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        {{ __('Rating') }}
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        {{ __('Actions') }}
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($testimonials as $testimonial)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <img src="{{ asset($testimonial->image) }}" alt="{{ $testimonial->name }}" class="h-10 w-10 rounded-full">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                        {{ $testimonial->name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                        {{ $testimonial->designation }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                        {{ $testimonial->company }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                        {{ $testimonial->rating }}/5
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('testimonial.edit', $testimonial) }}" class="text-primary-50 hover:text-primary-300 mr-3">
                            {{ __('Edit') }}
                        </a>
                        <form action="{{ route('testimonial.destroy', $testimonial) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('{{ __('Are you sure you want to delete this testimonial?') }}')">
                                {{ __('Delete') }}
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $testimonials->links() }}
    </div>
</div>
</x-app-layout>