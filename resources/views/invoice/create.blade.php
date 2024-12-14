@section('title')
    {{ __('Create Invoice') }}
@endsection
<x-app-layout>
    <div class="flex justify-between items-center m-6 card">
        <h2 class="text-xl font-medium text-text-light dark:text-text-dark">{{ __('Create Invoice') }}</h2>
        <a href="{{ route('invoice.index') }}"
            class="btn bg-primary-50 dark:bg-primary-50 text-text-light dark:text-text-dark">{{ __('Go to Invoice List') }}</a>
    </div>
    <div class="m-6">
        <div class="card">
            <h2 class="text-2xl text-text-light dark:text-text-dark font-bold mb-5">{{ __('Create New Invoice') }}</h2>

            <form method="POST" action="{{ route('invoice.store') }}">
                @csrf
                <!-- Project Name -->
                <div class="form-field">
                    <select name="project_id" id="project_id" class="form-select">
                        <option class="text-text-light dark:text-text-dark bg-card-light dark:bg-card-dark"  value="" selected>{{ __('Select Project') }}</option>
                        @foreach ($projects as $project)
                            <option class="text-text-light dark:text-text-dark bg-card-light dark:bg-card-dark" {{ old('project_id') == $project->id ? 'selected' : '' }} value="{{ $project->id }}">{{ $project->project_name }}</option>
                        @endforeach
                    </select>
                    @error('project_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Invoice Number -->
                <div class="form-field">
                    <input type="text" name="invoice_number" id="invoice_number" placeholder=" " required />
                    <label for="invoice_number"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0">{{ __('Invoice Number') }}</label>
                    @error('invoice_number')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit"
                    class="text-text-light dark:text-text-dark bg-primary-50 hover:bg-primary-50 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">{{ __('Submit') }}</button>
            </form>
        </div>
    </div>
</x-app-layout>
