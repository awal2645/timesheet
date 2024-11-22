@section('title')
    {{ 'Create Plan' }}
@endsection
<x-app-layout>
    <div
        class="m-6 p-12 bg-white/10 dark:bg-black/10 border dark:border-white/10 border-black/10 backdrop-blur rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4"> {{ __('Create New Plan') }}</h2>
        <form method="POST" action="{{ route('plans.store') }}"
            class="w-full bg-black/30 rounded-lg p-8 border border-white/10">
            @csrf

            <!-- Plan Label -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="label" id="label"
                    class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-purple-500 focus:outline-none focus:ring-0 focus:border-purple-600 peer"
                    placeholder=" " required value="{{ old('label') }}" />
                <label for="label"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-purple-600 peer-focus:bg-purple-50 peer-focus:dark:bg-purple-300 peer-focus:rounded peer-focus:border peer-focus:border-purple-600 peer-focus:dark:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                    {{ __('Plan Label') }}
                </label>
                @error('label')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Description -->
            <div class="relative z-0 w-full mb-5 group">
                <textarea name="description" id="description"
                    class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-purple-500 focus:outline-none focus:ring-0 focus:border-purple-600 peer"
                    placeholder=" ">{{ old('description') }}</textarea>
                <label for="description"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-purple-600 peer-focus:bg-purple-50 peer-focus:dark:bg-purple-300 peer-focus:rounded peer-focus:border peer-focus:border-purple-600 peer-focus:dark:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                    {{ __('Plan Description') }}
                </label>
                @error('description')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Plan Price -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="number" step="0.01" name="price" id="price"
                    class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-purple-500 focus:outline-none focus:ring-0 focus:border-purple-600 peer"
                    placeholder=" " required value="{{ old('price') }}" />
                <label for="price"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-purple-600 peer-focus:bg-purple-50 peer-focus:dark:bg-purple-300 peer-focus:rounded peer-focus:border peer-focus:border-purple-600 peer-focus:dark:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">{{ __('Price') }}</label>
                @error('price')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Employee Limit -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="number" name="employee_limit" id="employee_limit"
                    class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-purple-500 focus:outline-none focus:ring-0 focus:border-purple-600 peer"
                    placeholder=" " required value="{{ old('employee_limit') }}" />
                <label for="employee_limit"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-purple-600 peer-focus:bg-purple-50 peer-focus:dark:bg-purple-300 peer-focus:rounded peer-focus:border peer-focus:border-purple-600 peer-focus:dark:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                    {{ __('Employee Limit') }}
                </label>
                @error('employee_limit')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Client Limit -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="number" name="client_limit" id="client_limit"
                    class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-purple-500 focus:outline-none focus:ring-0 focus:border-purple-600 peer"
                    placeholder=" " required value="{{ old('client_limit') }}" />
                <label for="client_limit"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-purple-600 peer-focus:bg-purple-50 peer-focus:dark:bg-purple-300 peer-focus:rounded peer-focus:border peer-focus:border-purple-600 peer-focus:dark:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                    {{ __('Client Limit') }}
                </label>
                @error('client_limit')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Project Limit -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="number" name="project_limit" id="project_limit"
                    class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-purple-500 focus:outline-none focus:ring-0 focus:border-purple-600 peer"
                    placeholder=" " required value="{{ old('project_limit') }}" />
                <label for="project_limit"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-purple-600 peer-focus:bg-purple-50 peer-focus:dark:bg-purple-300 peer-focus:rounded peer-focus:border peer-focus:border-purple-600 peer-focus:dark:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                    {{ __('Project Limit') }}
                </label>
                @error('project_limit')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Recommended -->
            <label for="recommended" class="inline-flex items-center cursor-pointer">
                <input id="recommended" type="checkbox" name="recommended" value="" class="sr-only peer">
                <div
                    class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 dark:peer-focus:ring-purple-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-purple-500">
                </div>
                <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('Recommended') }}</span>
            </label>

            <br>
            <br>
            <!-- Frontend Show -->
            <label for="frontend_show" class="inline-flex items-center cursor-pointer">
                <input id="frontend_show" type="checkbox" name="frontend_show" value="" class="sr-only peer">
                <div
                    class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 dark:peer-focus:ring-purple-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-purple-500">
                </div>
                <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                    {{ __('Show User Panel') }}</span>
            </label>
            <br>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full px-4 mt-2 py-2 text-white bg-purple-500 dark:bg-purple-900 rounded-lg hover:bg-purple-700 focus:ring-4 focus:outline-none focus:ring-purple-300 dark:bg-purple-500 dark:hover:bg-purple-700 dark:focus:ring-purple-800">
                {{ __('Create Plan') }}
            </button>
        </form>
    </div>
</x-app-layout>
