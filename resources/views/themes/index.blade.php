@section('title')
    {{ __('Theme Customization') }}
@endsection

<x-app-layout>
    <div class="min-h-screen py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white/90">
                    🎨 Theme Customization
                </h1>
                <p class="mt-2 text-gray-600 dark:text-white/60">
                    Customize your site's appearance with colors and fonts
                </p>
            </div>

            <!-- Main Content -->
            <div class="bg-white/10 dark:bg-black/10 border border-black/10 dark:border-white/10 rounded-2xl shadow-xl overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-8">
                    <!-- Form Section -->
                    <div class="space-y-6">
                        <form method="POST" action="{{ route('themes.update') }}" class="space-y-6">
                            @csrf
                            @method('PUT')
                            
                            <!-- Primary Color -->
                            <div class="space-y-2">
                                <label for="primary_color" class="flex items-center text-sm font-medium text-gray-700 dark:text-white/90">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                                    </svg>
                                    Primary Color
                                </label>
                                <div class="flex items-center space-x-3">
                                    <input type="color" 
                                        class="h-10 w-14 rounded-lg border border-gray-300 shadow-sm cursor-pointer"
                                        id="primary_color"
                                        name="primary_color" 
                                        value="{{ $theme->primary_color ?? '#0d6efd' }}">
                                    <span class="text-sm font-mono text-gray-600 dark:text-white/60">
                                        {{ $theme->primary_color ?? '#0d6efd' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Secondary Color -->
                            <div class="space-y-2">
                                <label for="secondary_color" class="flex items-center text-sm font-medium text-gray-700 dark:text-white/90">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                    </svg>
                                    Secondary Color
                                </label>
                                <div class="flex items-center space-x-3">
                                    <input type="color" 
                                        class="h-10 w-14 rounded-lg border border-gray-300 shadow-sm cursor-pointer"
                                        id="secondary_color"
                                        name="secondary_color" 
                                        value="{{ $theme->secondary_color ?? '#6c757d' }}">
                                    <span class="text-sm font-mono text-gray-600 dark:text-white/60">
                                        {{ $theme->secondary_color ?? '#6c757d' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Font Family -->
                            <div class="space-y-2">
                                <label for="font_family" class="flex items-center text-sm font-medium text-gray-700 dark:text-white/90">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Font Family
                                </label>
                                <select id="font_family" 
                                    name="font_family"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    @foreach(['Inter', 'Poppins', 'Roboto', 'Open Sans', 'Montserrat'] as $font)
                                        <option value="{{ $font }}" 
                                            {{ ($theme->font_family ?? '') == $font ? 'selected' : '' }}
                                            style="font-family: {{ $font }}">
                                            {{ $font }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" 
                                class="mt-6 w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Save Theme
                            </button>
                        </form>
                    </div>

                    <!-- Preview Section -->
                    <div class="lg:sticky lg:top-8">
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-900">Live Preview</h3>
                            <div id="preview" class="p-6 rounded-xl border shadow-sm transition-all duration-200">
                                <h4 class="text-2xl font-bold mb-4">Welcome to Your Site</h4>
                                <p class="mb-6">This is how your content will look with the selected theme settings. Try changing the colors and fonts to see it update in real-time!</p>
                                <button class="preview-button px-4 py-2 rounded-lg transition-all duration-200 transform hover:-translate-y-0.5">
                                    Sample Button
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const primaryColorInput = document.getElementById('primary_color');
            const secondaryColorInput = document.getElementById('secondary_color');
            const fontFamilySelect = document.getElementById('font_family');
            const preview = document.getElementById('preview');
            const previewButton = preview.querySelector('.preview-button');

            function updatePreview() {
                const primaryColor = primaryColorInput.value;
                const secondaryColor = secondaryColorInput.value;
                const fontFamily = fontFamilySelect.value;

                preview.style.backgroundColor = secondaryColor;
                preview.style.fontFamily = fontFamily;
                preview.style.color = getContrastColor(secondaryColor);
                
                previewButton.style.backgroundColor = primaryColor;
                previewButton.style.color = getContrastColor(primaryColor);
                previewButton.style.boxShadow = `0 4px 14px ${primaryColor}40`;

                // Update color value displays
                primaryColorInput.nextElementSibling.textContent = primaryColor;
                secondaryColorInput.nextElementSibling.textContent = secondaryColor;
            }

            function getContrastColor(hexcolor) {
                const r = parseInt(hexcolor.substr(1,2), 16);
                const g = parseInt(hexcolor.substr(3,2), 16);
                const b = parseInt(hexcolor.substr(5,2), 16);
                const yiq = ((r * 299) + (g * 587) + (b * 114)) / 1000;
                return (yiq >= 128) ? '#000000' : '#ffffff';
            }

            primaryColorInput.addEventListener('input', updatePreview);
            secondaryColorInput.addEventListener('input', updatePreview);
            fontFamilySelect.addEventListener('change', updatePreview);

            // Initial preview
            updatePreview();
        });
    </script>
    @endpush
</x-app-layout>
