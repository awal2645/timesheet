<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log; // For logging errors

class SettingController extends Controller
{

    public function __construct()
    {
        // Apply the access_limitation middleware if the app is in demo mode
        $this->middleware('access_limitation', ['only' => ['update']]);
        $this->middleware('access_limitation', ['only' => ['paymentupdate']]);
    }

    public function setting()
    {
        $settings = Setting::first();
            return view('setting.index', compact('settings'));
        }

    public function update(Request $request)
    {
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

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $this->saveLogo($request->file('logo'));
        }

        // Handle dark logo upload
        if ($request->hasFile('dark_logo')) {
            $this->saveDarkLogo($request->file('dark_logo'));
        }

        // Handle favicon upload
        if ($request->hasFile('favicon')) {
            $this->saveFavicon($request->file('favicon'));
        }

        // Save new settings to the database or config
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

    public function changeLanguage($lang)
    {
        dd($lang);

        try {
            session()->put('set_lang', $lang);
            app()->setLocale($lang);
            return back()->with('success', 'language updated successfully! ');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error('Error changing language: ' . $e->getMessage());

            return back()->with('error', 'Unable to change the language.');
        }
    }

    public function paymentGateway()
    {
        return view('payment.index');
    }


    public function paymentupdate(Request $request)
    {
        try {
            switch ($request->type) {
                case 'paypal':
                    $this->paypalUpdate($request);
                    break;
                case 'stripe':
                    $this->stripeUpdate($request);
                    break;
            }
            return redirect()
                ->route('payment')
                ->with('success', 'Payment info updated successfully');
        } catch (\Exception $e) {
            flashError('An error occurred: ' . $e->getMessage());

            return back();
        }
    }

    public function paypalUpdate(Request $request)
    {
        $request->validate([
            'paypal_client_id' => 'required',
            'paypal_client_secret' => 'required',
        ]);

        try {
            if ($request->paypal_live_mode) {
                checkSetConfig('zenxserv.paypal_live_client_id', $request->paypal_client_id);
                checkSetConfig('zenxserv.paypal_live_secret', $request->paypal_client_secret);
            } else {
                checkSetConfig('zenxserv.paypal_sandbox_client_id', $request->paypal_client_id);
                checkSetConfig('zenxserv.paypal_sandbox_secret', $request->paypal_client_secret);
            }
            setConfig('zenxserv.paypal_mode', $request->paypal_live_mode ? 'live' : 'sandbox');

            checkSetConfig('zenxserv.paypal_active', $request->paypal ? true : false);


            return redirect()
                ->route('payment')
                ->with('success', 'Payment info updated successfully');
        } catch (\Exception $e) {
            flashError('An error occurred: ' . $e->getMessage());

            return back();
        }
    }

    public function stripeUpdate(Request $request)
    {
        $request->validate([
            'stripe_key' => 'required',
            'stripe_secret' => 'required',
        ]);

        try {
            checkSetConfig('zenxserv.stripe_key', $request->stripe_key);
            checkSetConfig('zenxserv.stripe_secret', $request->stripe_secret);

            checkSetConfig('zenxserv.stripe_active', $request->stripe ? true : false);
            return redirect()
                ->route('payment')
                ->with('success', 'Payment info updated successfully');
        } catch (\Exception $e) {
            flashError('An error occurred: ' . $e->getMessage());

            return back();
        }
    }


    public function upgrade()
    {
        return view('upgrade.index');
    }

    /**
     * Upgrade applying
     *
     * @return Response
     */
    public function upgradeApply()
    {
        try {
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
