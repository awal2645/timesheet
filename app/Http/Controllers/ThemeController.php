<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index()
    {
        $theme = Theme::getActive();
        return view('themes.index', compact('theme'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'primary_color' => 'required|string',
            'secondary_color' => 'required|string',
            'font_family' => 'required|string',
        ]);

        $theme = Theme::getActive();
        $theme->update($validated);

        // Generate CSS variables for different shades
        $this->generateColorShades($theme);

        return redirect()->back()->with('success', 'Theme updated successfully');
    }

    private function generateColorShades($theme)
    {
        $primaryColor = $this->hexToRgb($theme->primary_color);
        $secondaryColor = $this->hexToRgb($theme->secondary_color);

        $shades = [50, 100, 200, 300, 400, 500, 600, 700, 800, 900];
        $css = ":root {\n";

        // Generate primary shades
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

        // Generate secondary shades
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

        $css .= "}\n";

        // Create the css directory if it doesn't exist
        if (!file_exists(public_path('css'))) {
            mkdir(public_path('css'), 0755, true);
        }

        file_put_contents(public_path('css/theme.css'), $css);
    }

    private function hexToRgb($hex)
    {
        // Remove the hash if present
        $hex = ltrim($hex, '#');

        // Parse the hex color
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
