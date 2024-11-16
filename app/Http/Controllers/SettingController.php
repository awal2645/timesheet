<?php

namespace App\Http\Controllers;

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
        return view('setting.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'app_name' => 'required|string|max:255',
            'logo' => 'nullable|max:1024',  // Max size of 1MB
            'favicon' => 'nullable|max:512', // Max size of 512KB
        ]);

        // Update .env file for the application name
        replaceAppName('APP_NAME', $request->app_name);

        // Handle logo upload, saving to /images/logo-inv.png
        if ($request->hasFile('logo')) {
            $this->saveLogo($request->file('logo'));
        }

        // Handle favicon upload, saving to /images/logo_symbol.png
        if ($request->hasFile('favicon')) {
            $this->saveFavicon($request->file('favicon'));
        }

        return redirect()->route('dashboard')->with('success', 'Settings updated successfully! Please log in again.');
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
