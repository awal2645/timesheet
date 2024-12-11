<?php

use App\Models\Cms;
use App\Models\Role;
use App\Models\Smtp;
use App\Models\Task;
use App\Models\Client;
use App\Models\Notice;
use App\Models\Earning;
use App\Models\Employee;
use App\Models\Employer;
use App\Models\Language;
use App\Models\TimeReport;
use App\Models\Testimonial;
use App\Models\Notificattion;
use App\Models\SearchCountry;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\EmailTemplateController;

if (! function_exists('employerCount')) {
    function employerCount()
    {
        return Employer::count();
    }
}

if (! function_exists('employeeCount')) {
    function employeeCount()
    {
        if (auth('web')->user()->role == 'employer') {
            return Employee::where('employer_id', auth('web')->user()->employer->id)->count();
        } else {
            return Employee::count();
        }
    }
}

if (! function_exists('clientCount')) {
    function clientCount()
    {
        if (auth('web')->user()->role == 'employer') {
            return Client::where('employer_id', auth('web')->user()->employer->id)->count();
        } else {
            return Client::count();
        }
    }
}

if (! function_exists('earningCount')) {
    function earningCount()
    {
        // Summing the `amount` field after converting it to a float
        $totalAmount = DB::table('earnings')
            ->whereNotNull('amount') // Ensure non-null amounts
            ->sum(DB::raw('CAST(amount AS DECIMAL(10, 2))'));

        return $totalAmount;
    }
}

if (! function_exists('countries')) {
    function countries()
    {

        return SearchCountry::all();
    }
}
if (! function_exists('reportCount')) {
    function reportCount($status = null)
    {
        if (auth('web')->user()->role == 'employer') {
            return TimeReport::where('employer_id', auth('web')->user()->employer->id)->count();
        } else {
            return TimeReport::where('employee_id', auth('web')->user()->employee->id)
                ->where('status', $status)
                ->count();
        }
    }
}

if (! function_exists('notification')) {
    function notification()
    {
        return Notificattion::where('to', auth('web')->user()->id)->get();
    }
}

if (! function_exists('envUpdate')) {
    function envUpdate($key, $value)
    {
        $envFile = base_path('.env');
        $envContent = file_get_contents($envFile);

        $newLine = "$key=$value";

        if (strpos($envContent, "$key=") !== false) {
            $envContent = preg_replace("/$key=.*/", $newLine, $envContent);
        } else {
            $envContent .= "\n" . $newLine;
        }

        file_put_contents($envFile, $envContent);

        if (function_exists('opcache_reset')) {
            opcache_reset();
        }
    }
}

if (! function_exists('replaceAppName')) {
    function replaceAppName($name, $value)
    {
        $path = base_path('.env');
        if (file_exists($path)) {
            // Wrap the value in double quotes and replace the line
            $escapedValue = '"' . str_replace('"', '\"', $value) . '"';
            file_put_contents($path, preg_replace(
                "/^$name=.*/m",
                "$name=$escapedValue",
                file_get_contents($path)
            ));
        }

        if (file_exists(App::getCachedConfigPath())) {
            Artisan::call('config:clear');
        }
    }
}

if (! function_exists('getEmailTemplateFormatFlagsByType')) {
    function getEmailTemplateFormatFlagsByType($type)
    {
        return EmailTemplateController::getFormatterByType($type) ?? [];
    }
}

if (! function_exists('getFormattedTextByType')) {
    function getFormattedTextByType($type, $data = null)
    {
        $template = DB::table('email_templates')
            ->where('type', $type)
            ->first();

        if (! $template) {
            return null; // or handle this case appropriately
        }

        return replacePlaceholders($template->message, $data);
    }
}

if (! function_exists('replacePlaceholders')) {

    function replacePlaceholders($text, $data)
    {
        foreach ($data as $key => $value) {
            $text = str_replace('{' . $key . '}', $value, $text);
        }

        return $text;
    }
}

if (! function_exists('currencyConversion')) {
    function currencyConversion($amount, $fromCurrency, $toCurrency)
    {
        // Use a currency conversion API like ExchangeRatesAPI or CurrencyLayer
        $apiKey = env(''); // Add your API key in config/services.php
        $response = Http::get('https://api.exchangeratesapi.io/latest', [
            'access_key' => $apiKey,
            'base' => $fromCurrency,
            'symbols' => $toCurrency,
        ]);

        if ($response->ok()) {
            $conversionRate = $response->json()['rates'][$toCurrency];

            return $amount * $conversionRate;
        }

        // Fallback if the API call fails
        return $amount; // Handle failure gracefully (you could throw an exception if needed)
    }
}

if (! function_exists('formatTime')) {

    function formatTime($date, $format = 'F d, Y H:i A')
    {
        return Carbon::parse($date)->format($format);
    }
}

if (! function_exists('checkMailConfig')) {

    function checkMailConfig()
    {
        $status = config('mail.mailers.smtp.transport') && config('mail.mailers.smtp.host') && config('mail.mailers.smtp.port') && config('mail.mailers.smtp.username') && config('mail.mailers.smtp.password') && config('mail.mailers.smtp.encryption') && config('mail.from.address') && config('mail.from.name');

        ! $status ? flashError(__('Mail not sent for the reason of incomplete mail configuration')) : '';

        return $status ? 1 : 0;
    }
}

if (! function_exists('flashError')) {
    function flashError(?string $message = null)
    {
        if (! $message) {
            $message = __('something_went_wrong');
        }

        return session()->flash('error', $message);
    }
}

if (!function_exists('checkSetConfig')) {
    function checkSetConfig($key, $value)
    {
        // Check if the current config value is different
        if (config($key) != $value) {
            setConfig($key, $value);
        }
    }
}

if (! function_exists('setConfig')) {
    function setConfig($key, $value)
    {
        Config::write($key, $value);

        sleep(3);
        if (file_exists(App::getCachedConfigPath())) {
            Artisan::call('config:cache');
        }

        return 'Configuration set successfully!';
    }
}


if (! function_exists('currentLanguage')) {

    function currentLanguage()
    {
        return session('current_lang');
    }
}

if (! function_exists('loadDefaultLanguage')) {
    function loadDefaultLanguage()
    {
        return Cache::remember('default_language', now()->addDays(30), function () {
            return Language::where('code', config('zenxserv.default_language'))->first();
        });
    }
}

if (! function_exists('loadLanguage')) {
    function loadLanguage()
    {
        return Cache::remember('languages', now()->addDays(2), function () {
            return Language::all();
        });
    }
}

if (!function_exists('zMeetConfig')) {
    function zMeetConfig()
    {
        $status = env('ZOOM_API_URL') && env('ZOOM_ACCOUNT_ID') && env('ZOOM_CLIENT_ID') && env('ZOOM_CLIENT_SECRET');

        !$status ? session()->flash('warning', 'incomplete zoom meeting configuration') : '';

        return $status ? 1 : 0;
    }
}

if (! function_exists('notice')) {
    function notice()
    {
        return Notice::all();
    }
}

if (! function_exists('roles')) {
    function roles()
    {
        return Role::all();
    }
}

if (! function_exists('tasks')) {
    function tasks()
    {
        return Task::all();
    }
}

if (! function_exists('earnings')) {
    function earnings()
    {
        return Earning::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');
    }
}

if (! function_exists('smtp')) {
    function smtp()
    {
        return Smtp::where('created_by', auth()->user()->id)->first();
    }
}

if (! function_exists('cms')) {
    function cms()
    {
        return Cms::first();
    }
}

if (! function_exists('testimonials')) {
    function testimonials()
    {
        return Testimonial::all();
    }
}
