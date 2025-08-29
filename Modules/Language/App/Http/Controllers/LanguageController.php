<?php

namespace Modules\Language\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Language\App\Models\Language;
use Modules\Language\App\Models\LanguageData;

class LanguageController extends Controller
{

    protected $module_name;
    protected $module_enabled;
    public function __construct()
    {
        $this->module_name = 'Language';
        $this->module_enabled = module_enabled($this->module_name);
        if (!$this->module_enabled) {
            abort(404);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $languagesList = Language::paginate(10);
            return view('language::languages.index', compact('languagesList'));
        } catch (\Exception $e) {
            flashError('An error occurred: ' . $e->getMessage());
            return back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $path = base_path('lang/languages.json');
            $translations = json_decode(file_get_contents($path), true);
            return view('language::languages.create', compact('translations'));
        } catch (\Exception $e) {
            flashError('An error occurred: ' . $e->getMessage());
            return back();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:languages,name',
            'icon' => 'required',
            'direction' => 'required',
        ], [
            'name.required' => 'You must select a language',
            'icon.required' => 'You must select a flag',
            'direction.required' => 'You must select a direction',
        ]);

        $countryCode = $request->name;
        $path = base_path('lang/languages.json');
        $translations = json_decode(file_get_contents($path), true);

        $language = Language::create([
            'name' => $translations[$request->name]['name'],
            'code' => $countryCode,
            'icon' => $request->icon,
            'direction' => $request->direction,
        ]);

        $baseFile = base_path('lang/en.json');
        $fileName = base_path('lang/' . Str::slug($countryCode) . '.json');
        copy($baseFile, $fileName);

        $this->createLanguageData($countryCode);

        return redirect()->route('languages.index')->with('success', 'Language created successfully');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('language::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Language $language)
    {
        try {
            $path = base_path('lang/languages.json');
            $translations = json_decode(file_get_contents($path), true);
            return view('language::languages.edit', compact('language', 'translations'));
        } catch (\Exception $e) {
            flashError('An error occurred: ' . $e->getMessage());
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
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

            $countryCode = str_replace('flag-icon-', '', $request->icon);
            
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
     */
    public function destroy(Language $language)
    {
        try {
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
        $currentJsonPath = base_path('lang/' . $code . '.json');
        $currentJson = json_decode(File::get($currentJsonPath), true);

        LanguageData::create([
            'code' => $code,
            'data' => json_encode($currentJson),
        ]);
        
        return redirect()->route('languages.index')->with('success', 'Language created successfully');
    }

    public function editJson($code)
    {
        try {
            $path = base_path('lang/'.$code.'.json');
            $language = Language::where('code', $code)->first();
            $originalTranslations = json_decode(file_get_contents($path), true);

            $keyword = request('keyword');
            $translations = $originalTranslations;
            if (!empty($keyword)) {
                $translations = array_filter($translations, function ($value) use ($keyword) {
                    return stripos($value, $keyword) !== false;
                });
            }

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

            return view('language::languages.edit_json', compact('language', 'translations', 'keyword'));
        } catch (\Exception $e) {
            flashError('An error occurred: '.$e->getMessage());
            return back();
        }
    }

    public function transUpdate(Request $request)
    {
        try {
            $language = Language::findOrFail($request->lang_id);
    
            $data = file_get_contents(base_path('lang/' . $language->code . '.json'));
            $translations = json_decode($data, true);
    
            foreach ($translations as $key => $value) {
                if ($request->has($key) && is_string($request->$key)) {
                    $translations[$key] = $request->$key;
                }
            }
    
            file_put_contents(
                base_path('lang/' . $language->code . '.json'), 
                json_encode($translations, JSON_UNESCAPED_UNICODE)
            );
    
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

            $mergedJson = array_merge($databaseJson, $currentJson);

            $value->update(['data' => json_encode($mergedJson)]);

            return back()->with('success', 'Translations updated successfully');
        } catch (\Exception $e) {
            flashError('An error occurred: '.$e->getMessage());
            return back();
        }
    }
}
