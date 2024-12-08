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

class LanguageController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('access_limitation')->only(['destroy', 'update']);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index()
    {
        try {
            $languagesList = Language::paginate(10);

            return view('languages.index', compact('languagesList'));
        } catch (\Exception $e) {
            flashError('An error occurred: ' . $e->getMessage());
            return back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create()
    {
        try {

            $path = base_path('lang/languages.json');
            $translations = json_decode(file_get_contents($path), true);

            return view('languages.create', compact('translations'));
        } catch (\Exception $e) {
            flashError('An error occurred: ' . $e->getMessage());
            return back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Renderable
     */
    public function store(Request $request)
    {
        // try {

            $request->validate([
                'name' => 'required|unique:languages,name',
                'icon' => 'required',
                'direction' => 'required',
            ], [
                'name.required' => 'You must select a language',
                'icon.required' => 'You must select a flag',
                'direction.required' => 'You must select a direction',
            ]);

            // Remove 'flag-icon-' prefix
            $countryCode = $request->name;

            $path = base_path('lang/languages.json');
            $translations = json_decode(file_get_contents($path), true);

            $language = Language::create([
                'name' => $translations[$request->name]['name'],
                'code' => $countryCode,
                'icon' => $request->icon,
                'direction' => $request->direction,
            ]);

            // if ($language) {
                $baseFile = base_path('lang/en.json');
                $fileName = base_path('lang/' . Str::slug($countryCode) . '.json');
                copy($baseFile, $fileName);

                $this->createLanguageData($countryCode);


            return redirect()->route('languages.index')->with('success', 'Language created successfully');
            // } else {
            //     return back();
            // }
        // } catch (\Exception $e) {
        //     flashError('An error occurred: ' . $e->getMessage());
        //     return back();
        // }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Language  $language
     * @return Renderable
     */
    public function edit(Language $language)
    {
        try {


            $path = base_path('lang/languages.json');
            $translations = json_decode(file_get_contents($path), true);
            return view('languages.edit', compact('language', 'translations'));
        } catch (\Exception $e) {
            flashError('An error occurred: ' . $e->getMessage());
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Language  $language
     * @return Renderable
     */
    public function update(Request $request, Language $language)
    {
        try {
            $request->validate([
                'name' => "required|unique:languages,name,{$language->id}",
                'icon' => "required|unique:languages,icon,{$language->id}",
                'direction' => 'required',
            ], [
                'name.required' => 'You must select a language',
                'icon.required' => 'You must select a flag',
                'direction.required' => 'You must select a direction',
            ]);

            // Remove 'flag-icon-' prefix
            $countryCode = str_replace('flag-icon-', '', $request->icon);
             // rename file
             $oldFile = $language->code.'.json';
             $oldName = base_path('lang/'.$oldFile);
             $newFile = Str::slug($countryCode).'.json';
             $newName = base_path('lang/'.$newFile);
 
             rename($oldName, $newName);

            $language->update([
                'name' => $request->name,
                'code' => $countryCode,
                'icon' => $request->icon,
                'direction' => $request->direction,
            ]);

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
     * Remove the specified resource from storage.
     *
     * @param  Language  $language
     * @return Renderable
     */
    public function destroy(Language $language)
    {
        try {

            // Delete the language file
            if (File::exists(base_path('lang/' . $language->code . '.json'))) {
                File::delete(base_path('lang/' . $language->code . '.json'));
            }

            $language->delete();


            return redirect()->route('languages.index')->with('success', 'Language deleted successfully');
        } catch (\Exception $e) {
            flashError('An error occurred: ' . $e->getMessage());
            return back();
        }
    }

    private function createLanguageData($code)
    {
        // try {
            $currentJsonPath = base_path('lang/' . $code . '.json');
            $currentJson = json_decode(File::get($currentJsonPath), true);

            LanguageData::create([
                'code' => $code,
                'data' => json_encode($currentJson),
            ]);
            return redirect()->route('languages.index')->with('success', 'Language created successfully');

        // } catch (\Exception $e) {
        //     flashError('An error occurred: ' . $e->getMessage());
        //     return back();
        // }
    }

    public function editJson($code)
    {
        try {
            $path = base_path('lang/'.$code.'.json');
            $language = Language::where('code', $code)->first();
            $originalTranslations = json_decode(file_get_contents($path), true);

            // Get the search keyword from the request
            $keyword = request('keyword');

            // Filter translations based on the keyword
            $translations = $originalTranslations;
            if (! empty($keyword)) {
                $translations = array_filter($translations, function ($value) use ($keyword) {
                    // You can customize the condition based on your requirements
                    return stripos($value, $keyword) !== false;
                });
            }

            // Set the number of items per page to 100
            $perPage = 100;

            // Create a paginator using the paginate method
            $page = request()->input('page', 1);
            $offset = ($page - 1) * $perPage;
            $slicedTranslations = array_slice($translations, $offset, $perPage);
            $translations = new LengthAwarePaginator($slicedTranslations, count($translations), $perPage, $page, ['path' => route('languages.json.edit', ['code' => $code])]);

            return view('languages.edit_json', compact('language', 'translations', 'keyword'));
        } catch (\Exception $e) {
            flashError('An error occurred: '.$e->getMessage());

            return back();
        }
    }

    public function transUpdate(Request $request)
    {
        try {
            $language = Language::findOrFail($request->lang_id);
    
            // Load the existing translations from the JSON file
            $data = file_get_contents(base_path('lang/' . $language->code . '.json'));
            $translations = json_decode($data, true);
    
            // Update translations based on the request input
            foreach ($translations as $key => $value) {
                // Check if the request has a value for the current key
                if ($request->has($key) && is_string($request->$key)) {
                    // Update the translation with the new value
                    $translations[$key] = $request->$key;
                }
            }
    
            // Save the updated translations back to the JSON file
            file_put_contents(base_path('lang/' . $language->code . '.json'), json_encode($translations, JSON_UNESCAPED_UNICODE));
    
            // Update the database with the new translations
            $this->updateInDatabase($language->code);
    
            return back()->with('success', 'Translations updated successfully');
        } catch (\Exception $e) {
            flashError('An error occurred: ' . $e->getMessage());
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }


    private function updateInDatabase($code)
    {
        try {
            $value = LanguageData::where('code', $code)->first();

            $currentJsonPath = base_path('lang/'.$value->code.'.json');
            $currentJson = json_decode(File::get($currentJsonPath), true);
            $databaseJson = json_decode($value->data, true);

            // Merge the current JSON with the database JSON, keeping existing keys
            $mergedJson = array_merge($databaseJson, $currentJson);

            // Save the merged JSON back to the database
            $value->update(['data' => json_encode($mergedJson)]);

            return back()->with('success', 'Translations updated successfully');

        } catch (\Exception $e) {
            flashError('An error occurred: '.$e->getMessage());

            return back();
        }
    }
}
