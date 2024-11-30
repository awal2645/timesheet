@section('title')
    {{ __('Update CMS') }}
@endsection

<x-app-layout>
    <div class="m-6 card">
        <h1 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">{{ __('Update CMS') }}</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                role="alert">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('cms.update') }}" method="POST" enctype="multipart/form-data"
            class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @csrf
            @method('PUT')

            @foreach (['banner_image', 'approach_image', 'client_image1', 'client_image2', 'client_image3', 'client_image4', 'client_image5'] as $image)
                <div class="form-field">
                    <label for="{{ $image }}">
                        {{ ucfirst(str_replace('_', ' ', $image)) }}
                    </label>
                    <input type="file" id="{{ $image }}" name="{{ $image }}">
                </div>
            @endforeach

            <div class="col-span-full">
                <button type="submit"
                    class="text-white bg-primary-500 dark:bg-primary-900 hover:bg-primary-600 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    {{ __('Update') }}
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
