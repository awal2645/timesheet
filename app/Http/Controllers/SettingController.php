<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

/**
 * Controller for managing application settings
 * Handles system configuration, logos, and payment settings
 */
class SettingController extends Controller
{
    /**
     * Set up middleware for access control
     * Restricts access to settings updates in demo mode
     */
    public function __construct()
    {
        // Apply access limitation middleware for update methods
        $this->middleware('access_limitation', ['only' => ['update']]);
    }

    /**
     * Display settings page with current configuration
     * 
     * @return \Illuminate\View\View
     */
    public function setting()
    {
        // Get current settings from database
        $settings = Setting::first();
        return view('setting.index', compact('settings'));
    }

    /**
     * Update application settings
     * Handles general settings and file uploads
     * 
     * @param Request $request Contains settings data and files
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        // Validate settings data
        $request->validate([
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Max size of 2MB
            'dark_logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Max size of 2MB
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg|max:512', // Max size of 512KB
            'copyright' => 'required|string|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
        ]);

        // Handle file uploads
        if ($request->hasFile('logo')) {
            $this->saveLogo($request->file('logo'));
        }

        if ($request->hasFile('dark_logo')) {
            $this->saveDarkLogo($request->file('dark_logo'));
        }

        if ($request->hasFile('favicon')) {
            $this->saveFavicon($request->file('favicon'));
        }

        // Update settings in database
        Setting::updateOrCreate(
            ['id' => 1], // Assuming a single settings record
            $request->only([
                'email', 
                'phone', 
                'address', 
                'copyright', 
                'facebook_url', 
                'instagram_url', 
                'linkedin_url', 
                'twitter_url', 
                'youtube_url'
            ])
        );

        return redirect()->route('setting')->with('success', 'Settings updated successfully!');
    }

    /**
     * Save main logo file
     * 
     * @param \Illuminate\Http\UploadedFile $file Logo file
     */
    private function saveLogo($file)
    {
        $logoPath = public_path('/images/logo-inv.png');

        // Delete the old logo if it exists
        if (File::exists($logoPath)) {
            File::delete($logoPath);
        }

        // Save the new logo
        $file->move(public_path('/images'), 'logo-inv.png');
    }
    
    /**
     * Save dark mode logo file
     * 
     * @param \Illuminate\Http\UploadedFile $file Dark logo file
     */
    private function saveDarkLogo($file)
    {
        $darkLogoPath = public_path('/images/dark_logo.png');

        // Delete the old dark logo if it exists
        if (File::exists($darkLogoPath)) {
            File::delete($darkLogoPath);
        }

        // Save the new dark logo
        $file->move(public_path('/images'), 'dark_logo.png');
    }

    /**
     * Save favicon file
     * 
     * @param \Illuminate\Http\UploadedFile $file Favicon file
     */
    private function saveFavicon($file)
    {
        $faviconPath = public_path('/images/logo_symbol.png');

        // Delete the old favicon if it exists
        if (File::exists($faviconPath)) {
            File::delete($faviconPath);
        }

        // Save the new favicon
        $file->move(public_path('/images'), 'logo_symbol.png');
    }

    /**
     * Change application language
     * 
     * @param string $lang Language code
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeLanguage($lang)
    {
        try {
            // Set session and app locale
            session()->put('set_lang', $lang);
            app()->setLocale($lang);
            
            return back()->with('success', 'Language updated successfully!');
        } catch (\Exception $e) {
            // Log error and return error message
            Log::error('Error changing language: ' . $e->getMessage());
            return back()->with('error', 'Unable to change the language.');
        }
    }

    /**
     * Display upgrade page
     * 
     * @return \Illuminate\View\View
     */
    public function upgrade()
    {
        return view('upgrade.index');
    }

    /**
     * Apply system upgrade
     * Runs database migrations
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function upgradeApply()
    {
        try {
            // Run database migrations
            Artisan::call('migrate');

            return redirect()
                ->back()
                ->with('success', 'Application updated successfully');
        } catch (\Exception $e) {
            flashError('An error occurred: ' . $e->getMessage());
            return back();
        }
    }
}
