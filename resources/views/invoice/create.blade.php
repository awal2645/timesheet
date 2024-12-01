@section('title')
    {{ __('Create Invoice') }}
@endsection
<x-app-layout>
    <div class="m-6">
        <div class="mb-12 card flex flex-col md:flex-row justify-end items-center md:space-y-0 ">

            <a href="{{ route('invoice.index') }}" class="bg-primary-300 text-text-light dark:text-text-dark px-4 py-2 rounded-lg"><i
                    class="fa-solid fa-plus"></i> {{ __('Back to Invoice List') }}</a>
        </div>
        <div class="card">
            <h2 class="text-2xl text-text-light dark:text-text-dark font-bold mb-5">{{ __('Create New Invoice') }}</h2>

            <form method="POST" action="{{ route('invoice.store') }}">
                @csrf
                <!-- Employer Name -->
                <div class="form-field">
                    <select name="employer_id" id="employer_id" class="form-select">
                        <option class="text-text-light dark:text-text-dark bg-card-light dark:bg-card-dark" value="" selected>{{ __('Select Employer') }}</option>
                        @foreach ($employers as $employer)
                            <option class="text-text-light dark:text-text-dark bg-card-light dark:bg-card-dark" {{ old('employer_id') == $employer->id ? 'selected' : '' }} value="{{ $employer->id }}">{{ $employer->employer_name }}</option>
                        @endforeach
                    </select>
                    <label for="employer_id"
                        class="form-label">{{ __('Employer Name') }}</label>
                </div>

                <!-- Client Name -->
                <div class="form-field">
                    <select name="client_id" id="client_id" class="form-select">
                        <option class="text-text-light dark:text-text-dark bg-card-light dark:bg-card-dark"  value="" selected>{{ __('Select Client') }}</option>
                        @foreach ($clients as $client)
                            <option class="text-text-light dark:text-text-dark bg-card-light dark:bg-card-dark" {{ old('client_id') == $client->id ? 'selected' : '' }} value="{{ $client->id }}">{{ $client->client_name }}</option>
                        @endforeach
                    </select>
                    <label for="client_id"
                        class="form-label">{{ __('Client Name') }}</label>
                </div>

                <!-- Project Name -->
                <div class="form-field">
                    <select name="project_id" id="project_id" class="form-select">
                        <option class="text-text-light dark:text-text-dark bg-card-light dark:bg-card-dark"  value="" selected>{{ __('Select Project') }}</option>
                        @foreach ($projects as $project)
                            <option class="text-text-light dark:text-text-dark bg-card-light dark:bg-card-dark" {{ old('project_id') == $project->id ? 'selected' : '' }} value="{{ $project->id }}">{{ $project->project_name }}</option>
                        @endforeach
                    </select>
                    <label for="project_id"
                        class="form-label">{{ __('Project Name') }}</label>
                </div>

                <!-- Invoice Number -->
                <div class="form-field">
                    <input type="text" name="invoice_number" id="invoice_number" placeholder=" " required />
                    <label for="invoice_number"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0">{{ __('Invoice Number') }}</label>
                </div>
                <button type="submit"
                    class="text-white bg-primary-300 hover:bg-primary-600 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">{{ __('Submit') }}</button>
            </form>
        </div>
    </div>
</x-app-layout>
