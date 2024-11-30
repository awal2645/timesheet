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
            class="bg-card-light dark:bg-card-dark border border-black/10 dark:border-white/10 rounded-2xl shadow-xl overflow-hidden">
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
                                <div class="flex gap-3 items-center">
                                    <input type="color"
                                        class="h-10 w-14 rounded-lg border border-gray-300 shadow-sm cursor-pointer"
                                        id="primary_color" name="primary_color" value="{{ $theme->primary_color ?? '#ffffff' }}">
                                    <span class="text-sm font-mono text-gray-600 dark:text-white/60">
                                        {{ $theme->primary_color ?? '#ffffff' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Secondary Color -->
                            <div class="space-y-2">
                                <label for="card_dark"
                                    class="flex items-center text-sm font-medium text-text-light dark:text-text-dark">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                        </path>
                                    </svg>
                                    Card Dark
                                </label>
                                <div class="flex gap-3 items-center">
                                    <input type="color"
                                        class="h-10 w-14 rounded-lg border border-gray-300 shadow-sm cursor-pointer"
                                        id="card_dark" name="card_dark"
                                        value="{{ $theme->card_dark ?? '#000000' }}">
                                    <span class="text-sm font-mono text-gray-600 dark:text-white/60">
                                        {{ $theme->card_dark ?? '#000000' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Secondary Color -->
                            <div class="space-y-2">
                                <label for="card_light"
                                    class="flex items-center text-sm font-medium text-text-light dark:text-text-dark">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                        </path>
                                    </svg>
                                    Card Light
                                </label>
                                <div class="flex gap-3 items-center">
                                    <input type="color"
                                        class="h-10 w-14 rounded-lg border border-gray-300 shadow-sm cursor-pointer"
                                        id="card_light" name="card_light"
                                        value="{{ $theme->card_light ?? '#ffffff' }}">
                                    <span class="text-sm font-mono text-gray-600 dark:text-white/60">
                                        {{ $theme->card_light ?? '#ffffff' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Sidebar Dark -->
                            <div class="space-y-2">
                                <label for="sidebar_dark"
                                    class="flex items-center text-sm font-medium text-text-light dark:text-text-dark">
                                    {{ __('Sidebar Dark') }}
                                </label>
                                <div class="flex gap-3 items-center">
                                    <input type="color"
                                        class="h-10 w-14 rounded-lg border border-gray-300 shadow-sm cursor-pointer"
                                        id="sidebar_dark" name="sidebar_dark" value="{{ $theme->sidebar_dark ?? '#ffffff' }}">
                                    <span class="text-sm font-mono text-gray-600 dark:text-white/60">
                                        {{ $theme->sidebar_dark ?? '#ffffff' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Sidebar Light -->
                            <div class="space-y-2">
                                <label for="sidebar_light"
                                    class="flex items-center text-sm font-medium text-text-light dark:text-text-dark">
                                    {{ __('Sidebar Light') }}
                                </label>
                                <div class="flex gap-3 items-center">
                                    <input type="color"
                                        class="h-10 w-14 rounded-lg border border-gray-300 shadow-sm cursor-pointer"
                                        id="sidebar_light" name="sidebar_light" value="{{ $theme->sidebar_light ?? '#ffffff' }}">
                                    <span class="text-sm font-mono text-gray-600 dark:text-white/60">
                                        {{ $theme->sidebar_light ?? '#ffffff' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Header Dark -->
                            <div class="space-y-2">
                                <label for="header_dark"
                                    class="flex items-center text-sm font-medium text-text-light dark:text-text-dark">
                                    {{ __('Header Dark') }}
                                </label>
                                <div class="flex gap-3 items-center">
                                    <input type="color"
                                        class="h-10 w-14 rounded-lg border border-gray-300 shadow-sm cursor-pointer"
                                        id="header_dark" name="header_dark" value="{{ $theme->header_dark ?? '#ffffff' }}">
                                    <span class="text-sm font-mono text-gray-600 dark:text-white/60">
                                        {{ $theme->header_dark ?? '#ffffff' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Header Light -->
                            <div class="space-y-2">
                                <label for="header_light"
                                    class="flex items-center text-sm font-medium text-text-light dark:text-text-dark">
                                    {{ __('Header Light') }}
                                </label>
                                <div class="flex gap-3 items-center">
                                    <input type="color"
                                        class="h-10 w-14 rounded-lg border border-gray-300 shadow-sm cursor-pointer"
                                        id="header_light" name="header_light" value="{{ $theme->header_light ?? '#ffffff' }}">
                                    <span class="text-sm font-mono text-gray-600 dark:text-white/60">
                                        {{ $theme->header_light ?? '#ffffff' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Body Dark -->
                            <div class="space-y-2">
                                <label for="body_dark"
                                    class="flex items-center text-sm font-medium text-text-light dark:text-text-dark">
                                    {{ __('Body Dark') }}
                                </label>
                                <div class="flex gap-3 items-center">
                                    <input type="color"
                                        class="h-10 w-14 rounded-lg border border-gray-300 shadow-sm cursor-pointer"
                                        id="body_dark" name="body_dark" value="{{ $theme->body_dark ?? '#ffffff' }}">
                                    <span class="text-sm font-mono text-gray-600 dark:text-white/60">
                                        {{ $theme->body_dark ?? '#ffffff' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Body Light -->
                            <div class="space-y-2">
                                <label for="body_light"
                                    class="flex items-center text-sm font-medium text-text-light dark:text-text-dark">
                                    {{ __('Body Light') }}
                                </label>
                                <div class="flex gap-3 items-center">
                                    <input type="color"
                                        class="h-10 w-14 rounded-lg border border-gray-300 shadow-sm cursor-pointer"
                                        id="body_light" name="body_light" value="{{ $theme->body_light ?? '#ffffff' }}">
                                    <span class="text-sm font-mono text-gray-600 dark:text-white/60">
                                        {{ $theme->body_light ?? '#ffffff' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Text Light -->
                            <div class="space-y-2">
                                <label for="text_light"
                                    class="flex items-center text-sm font-medium text-text-light dark:text-text-dark">
                                    {{ __('Text Light') }}
                                </label>
                                <div class="flex gap-3 items-center">
                                    <input type="color"
                                        class="h-10 w-14 rounded-lg border border-gray-300 shadow-sm cursor-pointer"
                                        id="text_light" name="text_light" value="{{ $theme->text_light ?? '#ffffff' }}">
                                    <span class="text-sm font-mono text-gray-600 dark:text-white/60">
                                        {{ $theme->text_light ?? '#ffffff' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Text Dark -->
                            <div class="space-y-2">
                                <label for="text_dark"
                                    class="flex items-center text-sm font-medium text-text-light dark:text-text-dark">
                                    {{ __('Text Dark') }}
                                </label>
                                <div class="flex gap-3 items-center">
                                    <input type="color"
                                        class="h-10 w-14 rounded-lg border border-gray-300 shadow-sm cursor-pointer"
                                        id="text_dark" name="text_dark" value="{{ $theme->text_dark ?? '#ffffff' }}">
                                    <span class="text-sm font-mono text-gray-600 dark:text-white/60">
                                        {{ $theme->text_dark ?? '#ffffff' }}
                                    </span>
                                </div>
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
                                @foreach (App\Models\Theme::AVAILABLE_FONTS as $name => $style)
                                    <option value="{{ $name }}"
                                        {{ ($theme->font_family ?? 'Inter') === $name ? 'selected' : '' }}
                                        style="font-family: {{ $style }}">
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-2 gap-5 mt-6">
                            <button type="submit"
                                class="flex-1 mr-2 justify-center text-text-light dark:text-text-dark py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium bg-primary-300 hover:bg-primary-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                                <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                {{ __('Update Theme') }}
                            </button>
                        </form>

                        <form action="{{ route('themes.reset') }}" method="POST" class="flex-1 ml-2">
                            @csrf
                            <button type="submit"
                                class="w-full justify-center text-text-light dark:text-text-dark py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium bg-secondary-300 hover:bg-secondary-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-secondary-500 transition-all duration-200">
                                <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                    </path>
                                </svg>
                                {{ __('Reset to Default') }}
                            </button>
                        </form>
                    </div>
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

            // Add default colors
            const defaultColors = @json(\App\Models\Theme::DEFAULT_COLORS);

            // Add reset preview function
            function resetPreview() {
                primaryColorInput.value = defaultColors.primary_color;
                secondaryColorInput.value = defaultColors.secondary_color;
                fontFamilySelect.value = defaultColors.font_family;
                // Update all other color inputs
                document.getElementById('sidebar_dark').value = defaultColors.sidebar_dark;
                document.getElementById('sidebar_light').value = defaultColors.sidebar_light;
                document.getElementById('header_dark').value = defaultColors.header_dark;
                document.getElementById('header_light').value = defaultColors.header_light;
                document.getElementById('body_dark').value = defaultColors.body_dark;
                document.getElementById('body_light').value = defaultColors.body_light;
                document.getElementById('text_light').value = defaultColors.text_light;
                document.getElementById('text_dark').value = defaultColors.text_dark;

                updatePreview();
            }

            // Add click handler for reset button
            document.querySelector('form[action*="reset"]').addEventListener('submit', function(e) {
                if (!confirm('Are you sure you want to reset to default colors?')) {
                    e.preventDefault();
                } else {
                    resetPreview(); // Call resetPreview if user confirms
                }
            });
        });
    </script>
</x-app-layout>
