@section('title')
    {{ __('Theme Customization') }}
@endsection

<x-app-layout>
    <div class="m-6">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-text-light dark:text-text-dark">
               🎨 {{ __(' Theme Customization') }}
            </h1>
            <p class="mt-2 text-text-light dark:text-text-dark">
                {{ __('Customize your site\'s appearance with colors and fonts') }}
            </p>
        </div>

        <!-- Main Content -->
        <div
            class="bg-white/10 dark:bg-black/10 border border-black/10 dark:border-white/10 rounded-2xl shadow-xl overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-8">
                <!-- Form Section -->
                <div class="space-y-6">
                    <form method="POST" action="{{ route('themes.update') }}" class="space-y-6">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-4 gap-4">
                            <!-- Primary Color -->
                            <div class="space-y-2">
                                <label for="primary_color"
                                    class="flex items-center text-sm font-medium text-text-light dark:text-text-dark">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01">
                                        </path>
                                    </svg>
                                    Primary Color
                                </label>
                                <div class="flex items-center space-x-3">
                                    <input type="color"
                                        class="h-10 w-14 rounded-lg border border-gray-300 shadow-sm cursor-pointer"
                                        id="primary_color" name="primary_color"
                                        value="{{ $theme->primary_color ?? '#0d6efd' }}">
                                    <span class="text-sm font-mono text-gray-600 dark:text-white/60">
                                        {{ $theme->primary_color ?? '#0d6efd' }}
                                    </span>
                                </div>
                            </div>
    
                            <!-- Secondary Color -->
                            <div class="space-y-2">
                                <label for="secondary_color"
                                    class="flex items-center text-sm font-medium text-text-light dark:text-text-dark">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                        </path>
                                    </svg>
                                    Secondary Color
                                </label>
                                <div class="flex items-center space-x-3">
                                    <input type="color"
                                        class="h-10 w-14 rounded-lg border border-gray-300 shadow-sm cursor-pointer"
                                        id="secondary_color" name="secondary_color"
                                        value="{{ $theme->secondary_color ?? '#6c757d' }}">
                                    <span class="text-sm font-mono text-gray-600 dark:text-white/60">
                                        {{ $theme->secondary_color ?? '#6c757d' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Sidebar Dark -->
                            <div class="space-y-2">
                                <label for="sidebar_dark"
                                    class="flex items-center text-sm font-medium text-text-light dark:text-text-dark">
                                    {{ __('Sidebar Dark') }}   
                                </label>
                                <input type="color"
                                    class="h-10 w-14 rounded-lg border border-gray-300 shadow-sm cursor-pointer"
                                    id="sidebar_dark" name="sidebar_dark" value="{{ $theme->sidebar_dark ?? '#f8f9fa' }}">
                                    <span class="text-sm font-mono text-gray-600 dark:text-white/60">
                                        {{ $theme->secondary_color ?? '#6c757d' }}
                                    </span>
                            </div>

                            <!-- Sidebar Light -->
                            <div class="space-y-2">
                                <label for="sidebar_light"
                                    class="flex items-center text-sm font-medium text-text-light dark:text-text-dark">
                                    {{ __('Sidebar Light') }}   
                                </label>
                                <input type="color"
                                    class="h-10 w-14 rounded-lg border border-gray-300 shadow-sm cursor-pointer"
                                    id="sidebar_light" name="sidebar_light" value="{{ $theme->sidebar_light ?? '#f8f9fa' }}">
                            </div>

                            <!-- Header Dark -->
                            <div class="space-y-2">
                                <label for="header_dark"
                                    class="flex items-center text-sm font-medium text-text-light dark:text-text-dark">
                                    {{ __('Header Dark') }}
                                </label>
                                <input type="color" class="h-10 w-14 rounded-lg border border-gray-300 shadow-sm cursor-pointer"
                                    id="header_dark" name="header_dark" value="{{ $theme->header_dark ?? '#f8f9fa' }}">
                            </div>

                            <!-- Header Light -->
                            <div class="space-y-2">
                                <label for="header_light"
                                    class="flex items-center text-sm font-medium text-text-light dark:text-text-dark">
                                    {{ __('Header Light') }}
                                </label>
                                <input type="color"
                                    class="h-10 w-14 rounded-lg border border-gray-300 shadow-sm cursor-pointer"
                                    id="header_light" name="header_light" value="{{ $theme->header_light ?? '#f8f9fa' }}">
                            </div>

                            <!-- Body Dark -->
                            <div class="space-y-2">
                                <label for="body_dark"
                                    class="flex items-center text-sm font-medium text-text-light dark:text-text-dark">
                                    {{ __('Body Dark') }}
                                </label>
                                <input type="color" class="h-10 w-14 rounded-lg border border-gray-300 shadow-sm cursor-pointer"
                                    id="body_dark" name="body_dark" value="{{ $theme->body_dark ?? '#f8f9fa' }}">
                            </div>

                            <!-- Body Light -->
                            <div class="space-y-2">
                                <label for="body_light"
                                    class="flex items-center text-sm font-medium text-text-light dark:text-text-dark">
                                    {{ __('Body Light') }}
                                </label>
                                <input type="color"
                                    class="h-10 w-14 rounded-lg border border-gray-300 shadow-sm cursor-pointer"
                                    id="body_light" name="body_light" value="{{ $theme->body_light ?? '#f8f9fa' }}">
                            </div>

                            <!-- Text Light -->
                            <div class="space-y-2">
                                <label for="text_light"
                                    class="flex items-center text-sm font-medium text-text-light dark:text-text-dark">
                                    {{ __('Text Light') }}
                                </label>
                                <input type="color" class="h-10 w-14 rounded-lg border border-gray-300 shadow-sm cursor-pointer"
                                    id="text_light" name="text_light" value="{{ $theme->text_light ?? '#000' }}">
                            </div>

                            <!-- Text Dark -->
                            <div class="space-y-2">
                                <label for="text_dark"
                                    class="flex items-center text-sm font-medium text-text-light dark:text-text-dark">
                                    {{ __('Text Dark') }}
                                </label>
                                <input type="color"
                                    class="h-10 w-14 rounded-lg border border-gray-300 shadow-sm cursor-pointer"
                                    id="text_dark" name="text_dark" value="{{ $theme->text_dark ?? '#fff' }}">
                            </div>
                        </div>

                        <!-- Font Family -->
                        <div class="space-y-2">
                            <label for="font_family"
                                class="flex items-center text-sm font-medium text-text-light dark:text-text-dark">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                {{ __('Font Family') }}
                            </label>
                            <select id="font_family" name="font_family"
                                class="w-full rounded-lg border-gray-300 bg-body-light dark:bg-body-dark shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @foreach (['Inter', 'Poppins', 'Roboto', 'Open Sans', 'Montserrat'] as $font)
                                    <option value="{{ $font }}"
                                        class="text-text-light dark:text-text-dark bg-body-light dark:bg-body-dark "
                                        {{ ($theme->font_family ?? '') == $font ? 'selected' : '' }}
                                        style="font-family: '{{ $font }}'">
                                        {{ $font }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit"
                            class="mt-6 w-full flex justify-center text-text-light dark:text-text-dark py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium bg-primary-300 hover:bg-primary-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            {{ __('Save Theme') }}
                        </button>
                    </form>
                </div>

                <!-- Preview Section -->
                <div class="lg:sticky lg:top-8">
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-text-light dark:text-text-dark">
                            {{ __('Live Preview') }}
                        </h3>
                        <div id="preview" class="p-6 rounded-xl border shadow-sm transition-all duration-200">
                            <h4 class="text-2xl font-bold mb-4">
                                {{ __('Primary text') }}
                            </h4>
                            <p class="mb-6">
                                {{ __('This is secondary text. Try changing the colors and fonts to see it update in real-time!') }}
                            </p>
                            <div class="flex flex-wrap gap-4">
                                <button
                                    class="preview-button bg-primary-300 text-text-light dark:text-text-dark px-4 py-2 rounded-lg transition-all duration-200 transform hover:-translate-y-0.5">
                                    {{ __('Primary button') }}
                                </button>
                                <button
                                    class="preview-button bg-secondary-500 text-text-light dark:text-text-dark px-4 py-2 rounded-lg transition-all duration-200 transform hover:-translate-y-0.5">
                                    {{ __('Secondary button') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                    const r = parseInt(hexcolor.substr(1, 2), 16);
                    const g = parseInt(hexcolor.substr(3, 2), 16);
                    const b = parseInt(hexcolor.substr(5, 2), 16);
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
</x-app-layout>
