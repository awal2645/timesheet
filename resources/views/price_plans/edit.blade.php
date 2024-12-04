@section('title')
    {{ 'Edit Plan' }}
@endsection

<x-app-layout>
    <div class="flex justify-between m-6 card">
        <h2 class="text-xl font-medium text-text-light dark:text-text-dark">{{ __('Edit Plan') }}</h2>
        <a href="{{ route('plans.index') }}"
            class="btn bg-primary-50 dark:bg-primary-50 text-text-light dark:text-text-dark">{{ __('Go to Plan List') }}</a>
    </div>
    <div class="m-6 card">
        <h2 class="text-2xl font-bold mb-4 text-text-light dark:text-text-dark"> {{ __('Edit Plan') }}</h2>
        <form method="POST" action="{{ route('plans.update', $plan->id) }}">
            @csrf
            @method('PUT') <!-- Specify the form method for update -->

            <!-- Plan Label -->
            <div class="form-field">
                <input type="text" name="label" id="label" placeholder=" " required
                    value="{{ old('label', $plan->label) }}" />
                <label for="label">
                    {{ __('Plan Label') }}
                </label>
                @error('label')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Description -->
            <div class="form-field">
                <textarea name="description" id="description" placeholder=" ">{{ old('description', $plan->description) }}</textarea>
                <label for="description">
                    {{ __('Plan Description') }}
                </label>
                @error('description')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Plan Price -->
            <div class="form-field">
                <input type="number" step="0.01" name="price" id="price" placeholder=" " required
                    value="{{ old('price', $plan->price) }}" />
                <label for="price">
                    {{ __('Price') }}
                </label>
                @error('price')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Employee Limit -->
            <div class="form-field">
                <input type="number" name="employee_limit" id="employee_limit" placeholder=" " required
                    value="{{ old('employee_limit', $plan->employee_limit) }}" />
                <label for="employee_limit">
                    {{ __('Employee Limit') }}
                </label>
                @error('employee_limit')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Client Limit -->
            <div class="form-field">
                <input type="number" name="client_limit" id="client_limit" placeholder=" " required
                    value="{{ old('client_limit', $plan->client_limit) }}" />
                <label for="client_limit">
                    {{ __('Client Limit') }}
                </label>
                @error('client_limit')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Project Limit -->
            <div class="form-field">
                <input type="number" name="project_limit" id="project_limit" placeholder=" " required
                    value="{{ old('project_limit', $plan->project_limit) }}" />
                <label for="project_limit">
                    {{ __('Project Limit') }}
                </label>
                @error('project_limit')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Recommended -->
            <label for="recommended" class="inline-flex items-center cursor-pointer">
                <input {{ old('recommended', $plan->recommended) ? 'checked' : '' }} id="recommended" type="checkbox"
                    name="recommended" value="" class="sr-only peer">
                <div
                    class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary-300 dark:peer-focus:ring-primary-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-primary-50">
                </div>
                <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                    {{ __('Recommended') }}
                </span>
            </label>

            <br>
            <br>
            <!-- Frontend Show -->
            <label for="frontend_show" class="inline-flex items-center cursor-pointer">
                <input {{ old('frontend_show', $plan->frontend_show) ? 'checked' : '' }} id="frontend_show"
                    type="checkbox" name="frontend_show" value="" class="sr-only peer">
                <div
                    class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary-300 dark:peer-focus:ring-primary-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-primary-50">
                </div>
                <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                    {{ __('Show User Panel') }}
                </span>
            </label>
            <br>
            <br>
            <!-- Submit Button -->
            <div class="col-span-full">
                <button type="submit"
                    class="px-4 py-2 text-white bg-primary-50 rounded-lg hover:bg-primary-50 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-50 dark:hover:bg-primary-400 dark:focus:ring-primary-600 font-medium text-sm">
                    {{ __('Update Plan') }}
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
