@section('title')
    {{ __('Update CMS') }}
@endsection

<x-app-layout>

    <div class="card m-6">
        <h2 class="text-2xl text-text-light dark:text-text-dark font-bold mb-4">{{ __('Update CMS') }}</h2>
        <form action="{{ route('cms.update') }}" method="POST" enctype="multipart/form-data"
            class="bg-card-light dark:bg-card-dark p-8  border-black/10 dark:border-white/10 " x-data="imageUpload()">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Upload Images -->
                @foreach (['banner_image', 'approach_image','features_image1', 'features_image2', 'client_image1', 'client_image2', 'client_image3', 'client_image4', 'client_image5', 'client_image6', 'client_image7'] as $image)
                <div class="flex flex-col border border-gray-300 dark:border-gray-600 p-6 rounded-lg">
                    <h3 class="text-xl mb-4">{{ ucfirst(str_replace('_', ' ', $image)) }}</h3>
                    <div class="preview-container mb-4">
                        <!-- Display saved image if it exists -->
                        @if ($cms->$image)
                            <img src="{{ asset( $cms->$image) }}" alt="{{ ucfirst(str_replace('_', ' ', $image)) }} preview"
                                class="w-full h-[200px] rounded object-contain">
                        @else
                            <img :src="imagePreviews['{{ $image }}']" alt="{{ ucfirst(str_replace('_', ' ', $image)) }} preview"
                                class="w-full h-[200px] rounded object-contain" x-show="imagePreviews['{{ $image }}']" x-cloak>
                        @endif
                    </div>
                    <label class="flex gap-3 items-center px-6 py-3 rounded-md bg-primary-50 shadow-md text-text-light dark:text-text-dark">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
                            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                            <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708z" />
                        </svg>
                        {{ __('Upload') }}
                        <input type="file" id="{{ $image }}" name="{{ $image }}" @change="handleImageUpload(event, '{{ $image }}')" accept="image/jpeg,image/png" style="display:none;">
                    </label>
                </div>
                @endforeach
            </div>
            

            <div class="col-span-full mt-6">
                <button type="submit"
                    class="mt-6 text-text-light dark:text-text-dark bg-primary-50 hover:bg-primary-300 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-primary-50 dark:hover:bg-primary-50 dark:focus:ring-primary-800">
                    {{ __('Update') }}
                </button>
            </div>
        </form>
    </div>
    <script>
        function imageUpload() {
            return {
                imagePreviews: {},
                handleImageUpload(event, imageKey) {
                    const file = event.target.files[0];
                    if (!file) return;
    
                    // Validate file type
                    if (!['image/jpeg', 'image/png'].includes(file.type)) {
                        alert('Please upload a JPEG or PNG file.');
                        event.target.value = ''; // Clear the input
                        return;
                    }
    
                    // Read and preview the file
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.imagePreviews[imageKey] = e.target.result;
                    };
                    reader.readAsDataURL(file);
                },
            };
        }
    </script>
    
</x-app-layout>

