<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Support\Str;
use App\Models\LanguageData;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Controller for managing application languages and translations
 * Handles CRUD operations for languages and their associated translations
 */
class LanguageController extends Controller
{
    /**
     * Optional middleware setup for access control
     * Currently commented out but can be enabled for limiting access
     */
    // public function __construct()
    // {
    //     $this->middleware('access_limitation')->only(['destroy', 'update']);
    // }

    /**
     * Display a listing of available languages
     * @return Renderable
     */
    public function index()
    {
        try {
            // Get paginated list of languages (10 per page)
            $languagesList = Language::paginate(10);
            return view('languages.index', compact('languagesList'));
        } catch (\Exception $e) {
            flashError('An error occurred: ' . $e->getMessage());
            return back();
        }
    }

    /**
     * Show form for creating a new language
     * @return Renderable
     */
    public function create()
    {
        try {
            // Load available translations from languages.json file
            $path = base_path('lang/languages.json');
            $translations = json_decode(file_get_contents($path), true);

            return view('languages.create', compact('translations'));
        } catch (\Exception $e) {
            flashError('An error occurred: ' . $e->getMessage());
            return back();
        }
    }

    /**
     * Store a newly created language
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        // Validate required fields with custom messages
        $request->validate([
            'name' => 'required|unique:languages,name',
            'icon' => 'required',
            'direction' => 'required',
        ], [
            'name.required' => 'You must select a language',
            'icon.required' => 'You must select a flag',
            'direction.required' => 'You must select a direction',
        ]);

        // Get country code from name
        $countryCode = $request->name;

        // Load available translations
        $path = base_path('lang/languages.json');
        $translations = json_decode(file_get_contents($path), true);

        // Create new language record
        $language = Language::create([
            'name' => $translations[$request->name]['name'],
            'code' => $countryCode,
            'icon' => $request->icon,
            'direction' => $request->direction,
        ]);

        // Create language file by copying English base file
        $baseFile = base_path('lang/en.json');
        $fileName = base_path('lang/' . Str::slug($countryCode) . '.json');
        copy($baseFile, $fileName);

        // Create associated language data
        $this->createLanguageData($countryCode);

        return redirect()->route('languages.index')->with('success', 'Language created successfully');
    }

    /**
     * Show form for editing a language
     * @param Language $language
     * @return Renderable
     */
    public function edit(Language $language)
    {
        try {
            // Load available translations
            $path = base_path('lang/languages.json');
            $translations = json_decode(file_get_contents($path), true);
            return view('languages.edit', compact('language', 'translations'));
        } catch (\Exception $e) {
            flashError('An error occurred: ' . $e->getMessage());
            return back();
        }
    }

    /**
     * Update the specified language
     * @param Request $request
     * @param Language $language
     * @return Renderable
     */
    public function update(Request $request, Language $language)
    {
        try {
            // Validate required fields with custom messages
            $request->validate([
                'name' => "required|unique:languages,name,{$language->id}",
                'icon' => "required|unique:languages,icon,{$language->id}",
                'direction' => 'required',
            ], [
                'name.required' => 'You must select a language',
                'icon.required' => 'You must select a flag',
                'direction.required' => 'You must select a direction',
            ]);

            // Get country code from icon
            $countryCode = str_replace('flag-icon-', '', $request->icon);
            
            // Rename language file if code changes
            $oldFile = $language->code.'.json';
            $oldName = base_path('lang/'.$oldFile);
            $newFile = Str::slug($countryCode).'.json';
            $newName = base_path('lang/'.$newFile);
            rename($oldName, $newName);

            // Update language record
            $language->update([
                'name' => $request->name,
                'code' => $countryCode,
                'icon' => $request->icon,
                'direction' => $request->direction,
            ]);

            // Update associated language data
            $data = LanguageData::where('code', $language->code)->first();
            $data->code = $countryCode;
            $data->save();
            
            return redirect()->route('languages.index');
        } catch (\Exception $e) {
            flashError('An error occurred: ' . $e->getMessage());
            return back();
        }
    }

    /**
     * Remove the specified language
     * @param Language $language
     * @return Renderable
     */
    public function destroy(Language $language)
    {
        try {
            // Delete language file if it exists
            if (File::exists(base_path('lang/' . $language->code . '.json'))) {
                File::delete(base_path('lang/' . $language->code . '.json'));
            }

            // Delete language record
            $language->delete();

            return redirect()->route('languages.index')->with('success', 'Language deleted successfully');
        } catch (\Exception $e) {
            flashError('An error occurred: ' . $e->getMessage());
            return back();
        }
    }

    /**
     * Create language data record for a new language
     * @param string $code Language code
     * @return \Illuminate\Http\RedirectResponse
     */
    private function createLanguageData($code)
    {
        // Load current language JSON
        $currentJsonPath = base_path('lang/' . $code . '.json');
        $currentJson = json_decode(File::get($currentJsonPath), true);

        // Create language data record
        LanguageData::create([
            'code' => $code,
            'data' => json_encode($currentJson),
        ]);
        
        return redirect()->route('languages.index')->with('success', 'Language created successfully');
    }

    /**
     * Edit JSON translations for a language
     * @param string $code Language code
     * @return \Illuminate\View\View
     */
    public function editJson($code)
    {
        try {
            // Load language file and data
            $path = base_path('lang/'.$code.'.json');
            $language = Language::where('code', $code)->first();
            $originalTranslations = json_decode(file_get_contents($path), true);

            // Get search keyword and filter translations
            $keyword = request('keyword');
            $translations = $originalTranslations;
            if (!empty($keyword)) {
                $translations = array_filter($translations, function ($value) use ($keyword) {
                    return stripos($value, $keyword) !== false;
                });
            }

            // Paginate translations (100 per page)
            $perPage = 100;
            $page = request()->input('page', 1);
            $offset = ($page - 1) * $perPage;
            $slicedTranslations = array_slice($translations, $offset, $perPage);
            $translations = new LengthAwarePaginator(
                $slicedTranslations, 
                count($translations), 
                $perPage, 
                $page, 
                ['path' => route('languages.json.edit', ['code' => $code])]
            );

            return view('languages.edit_json', compact('language', 'translations', 'keyword'));
        } catch (\Exception $e) {
            flashError('An error occurred: '.$e->getMessage());
            return back();
        }
    }

    /**
     * Update translations for a language
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function transUpdate(Request $request)
    {
        try {
            // Find language record
            $language = Language::findOrFail($request->lang_id);
    
            // Load existing translations
            $data = file_get_contents(base_path('lang/' . $language->code . '.json'));
            $translations = json_decode($data, true);
    
            // Update translations with new values
            foreach ($translations as $key => $value) {
                if ($request->has($key) && is_string($request->$key)) {
                    $translations[$key] = $request->$key;
                }
            }
    
            // Save updated translations back to file
            file_put_contents(
                base_path('lang/' . $language->code . '.json'), 
                json_encode($translations, JSON_UNESCAPED_UNICODE)
            );
    
            // Update database record
            $this->updateInDatabase($language->code);
    
            return back()->with('success', 'Translations updated successfully');
        } catch (\Exception $e) {
            flashError('An error occurred: ' . $e->getMessage());
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Update language data in database
     * @param string $code Language code
     * @return \Illuminate\Http\RedirectResponse
     */
    private function updateInDatabase($code)
    {
        try {
            // Find language data record
            $value = LanguageData::where('code', $code)->first();

            // Load current JSON and database JSON
            $currentJsonPath = base_path('lang/'.$value->code.'.json');
            $currentJson = json_decode(File::get($currentJsonPath), true);
            $databaseJson = json_decode($value->data, true);

            // Merge JSONs, keeping existing keys
            $mergedJson = array_merge($databaseJson, $currentJson);

            // Update database record
            $value->update(['data' => json_encode($mergedJson)]);

            return back()->with('success', 'Translations updated successfully');
        } catch (\Exception $e) {
            flashError('An error occurred: '.$e->getMessage());
            return back();
        }
    }
}
