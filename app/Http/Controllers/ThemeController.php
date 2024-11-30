<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index()
    {
        $theme = Theme::first();
        return view('themes.index', compact('theme'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'primary_color' => 'required|string',
            'secondary_color' => 'required|string',
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

        $theme = Theme::first();

        if ($theme) {
            $theme->update($validated);
        } else {
            return redirect()->back()->with('error', 'No theme found to update.');
        }

        $this->generateColorShades($theme);

        return redirect()->back()->with('success', 'Theme updated successfully');
    }

    public function reset()
    {
        try {
            $theme = Theme::first();

            if ($theme) {
                $theme->update(Theme::DEFAULT_COLORS);
                $this->generateColorShades($theme);
                return redirect()->back()->with('success', 'Theme reset to default colors successfully');
            } else {
                return redirect()->back()->with('error', 'No theme found to reset.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to reset theme: ' . $e->getMessage());
        }
    }

    private function generateColorShades($theme)
    {
        $primaryColor = $this->hexToRgb($theme->primary_color);
        $secondaryColor = $this->hexToRgb($theme->secondary_color);
        $sidebarDark = $this->hexToRgb($theme->sidebar_dark);
        $sidebarLight = $this->hexToRgb($theme->sidebar_light);
        $headerDark = $this->hexToRgb($theme->header_dark);
        $headerLight = $this->hexToRgb($theme->header_light);
        $bodyDark = $this->hexToRgb($theme->body_dark);
        $bodyLight = $this->hexToRgb($theme->body_light);
        $textLight = $this->hexToRgb($theme->text_light);
        $textDark = $this->hexToRgb($theme->text_dark);

        $css = ":root {\n";
        
        $css .= "  --font-family: \"{$theme->font_family}\";\n";

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

        foreach ($shades as $shade) {
            $opacity = 1 - ($shade / 1000);
            $css .= sprintf(
                "  --secondary-%d: rgba(%d, %d, %d, %s);\n",
                $shade,
                $secondaryColor['r'],
                $secondaryColor['g'],
                $secondaryColor['b'],
                $opacity
            );
        }

        $css .= sprintf("  --sidebar-dark: %s;\n", $theme->sidebar_dark);
        $css .= sprintf("  --sidebar-light: %s;\n", $theme->sidebar_light);
        $css .= sprintf("  --header-dark: %s;\n", $theme->header_dark);
        $css .= sprintf("  --header-light: %s;\n", $theme->header_light);
        $css .= sprintf("  --body-dark: %s;\n", $theme->body_dark);
        $css .= sprintf("  --body-light: %s;\n", $theme->body_light);
        $css .= sprintf("  --text-light: %s;\n", $theme->text_light);
        $css .= sprintf("  --text-dark: %s;\n", $theme->text_dark);

        $css .= "}\n\n";
        
        $css .= "body {\n";
        $css .= "  font-family: var(--font-family), system-ui, sans-serif;\n";
        $css .= "}\n";

        if (!file_exists(public_path('css'))) {
            mkdir(public_path('css'), 0755, true);
        }

        file_put_contents(public_path('css/theme.css'), $css);
    }

    private function hexToRgb($hex)
    {
        $hex = ltrim($hex, '#');

        if (strlen($hex) == 3) {
            $r = hexdec(str_repeat(substr($hex, 0, 1), 2));
            $g = hexdec(str_repeat(substr($hex, 1, 1), 2));
            $b = hexdec(str_repeat(substr($hex, 2, 1), 2));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }

        return compact('r', 'g', 'b');
    }
}
