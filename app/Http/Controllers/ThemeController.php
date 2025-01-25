<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\Http\Request;

/**
 * Controller for managing application themes
 * Handles theme colors, fonts, and CSS generation
 */
class ThemeController extends Controller
{
    /**
     * Display theme settings page
     * Shows current theme configuration
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $theme = Theme::first();
        return view('themes.index', compact('theme'));
    }

    /**
     * Update theme settings
     * Handles color scheme and font updates
     * 
     * @param Request $request Contains theme configuration
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        // Validate theme settings
        $validated = $request->validate([
            'primary_color' => 'required|string',
            'card_dark' => 'required|string',
            'card_light' => 'required|string',
            'sidebar_dark' => 'required|string',
            'sidebar_light' => 'required|string',
            'header_dark' => 'required|string',
            'header_light' => 'required|string',
            'body_dark' => 'required|string',
            'body_light' => 'required|string',
            'text_light' => 'required|string',
            'text_dark' => 'required|string',
            'font_family' => 'required|string',
        ]);

        // Get or create theme record
        $theme = Theme::first();

        if ($theme) {
            // Update existing theme
            $theme->update($validated);
        } else {
            return redirect()
                ->back()
                ->with('error', 'No theme found to update.');
        }

        // Generate CSS with new colors
        $this->generateColorShades($theme);

        return redirect()
            ->back()
            ->with('success', 'Theme updated successfully');
    }

    /**
     * Reset theme to default colors
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reset()
    {
        try {
            $theme = Theme::first();

            if ($theme) {
                // Reset to default colors
                $theme->update(Theme::DEFAULT_COLORS);
                $this->generateColorShades($theme);
                return redirect()
                    ->back()
                    ->with('success', 'Theme reset to default colors successfully');
            } else {
                return redirect()
                    ->back()
                    ->with('error', 'No theme found to reset.');
            }
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Failed to reset theme: ' . $e->getMessage());
        }
    }

    /**
     * Generate CSS variables for color shades
     * Creates theme.css file with color variables
     * 
     * @param Theme $theme Current theme configuration
     */
    private function generateColorShades($theme)
    {
        // Convert hex colors to RGB
        $primaryColor = $this->hexToRgb($theme->primary_color);
        $cardDark = $this->hexToRgb($theme->card_dark);
        $cardLight = $this->hexToRgb($theme->card_light);
        $sidebarDark = $this->hexToRgb($theme->sidebar_dark);
        $sidebarLight = $this->hexToRgb($theme->sidebar_light);
        $headerDark = $this->hexToRgb($theme->header_dark);
        $headerLight = $this->hexToRgb($theme->header_light);
        $bodyDark = $this->hexToRgb($theme->body_dark);
        $bodyLight = $this->hexToRgb($theme->body_light);
        $textLight = $this->hexToRgb($theme->text_light);
        $textDark = $this->hexToRgb($theme->text_dark);

        // Start CSS content
        $css = ":root {\n";
        
        // Add font family
        $css .= "  --font-family: \"{$theme->font_family}\";\n";

        // Generate primary color shades
        $shades = [50, 100, 200, 300, 400, 500, 600, 700, 800, 900];
        foreach ($shades as $shade) {
            $opacity = 1 - ($shade / 1000);
            $css .= sprintf(
                "  --primary-%d: rgba(%d, %d, %d, %s);\n",
                $shade,
                $primaryColor['r'],
                $primaryColor['g'],
                $primaryColor['b'],
                $opacity
            );
        }

        // Add theme colors
        $css .= sprintf("  --card-dark: %s;\n", $theme->card_dark);
        $css .= sprintf("  --card-light: %s;\n", $theme->card_light);
        $css .= sprintf("  --sidebar-dark: %s;\n", $theme->sidebar_dark);
        $css .= sprintf("  --sidebar-light: %s;\n", $theme->sidebar_light);
        $css .= sprintf("  --header-dark: %s;\n", $theme->header_dark);
        $css .= sprintf("  --header-light: %s;\n", $theme->header_light);
        $css .= sprintf("  --body-dark: %s;\n", $theme->body_dark);
        $css .= sprintf("  --body-light: %s;\n", $theme->body_light);
        $css .= sprintf("  --text-light: %s;\n", $theme->text_light);
        $css .= sprintf("  --text-dark: %s;\n", $theme->text_dark);

        $css .= "}\n\n";
        
        // Add body font family
        $css .= "body {\n";
        $css .= "  font-family: var(--font-family), system-ui, sans-serif;\n";
        $css .= "}\n";

        // Create CSS directory if it doesn't exist
        if (!file_exists(public_path('css'))) {
            mkdir(public_path('css'), 0755, true);
        }

        // Write CSS file
        file_put_contents(public_path('css/theme.css'), $css);
    }

    /**
     * Convert hex color to RGB values
     * 
     * @param string $hex Hex color code
     * @return array RGB color values
     */
    private function hexToRgb($hex)
    {
        $hex = ltrim($hex, '#');

        if (strlen($hex) == 3) {
            // Convert shorthand hex to full hex
            $r = hexdec(str_repeat(substr($hex, 0, 1), 2));
            $g = hexdec(str_repeat(substr($hex, 1, 1), 2));
            $b = hexdec(str_repeat(substr($hex, 2, 1), 2));
        } else {
            // Convert full hex to RGB
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }

        return compact('r', 'g', 'b');
    }
}
