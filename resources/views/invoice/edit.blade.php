@section('title')
    {{ __('Edit Invoice') }}
@endsection
<x-app-layout>
    <div class="flex justify-between m-6 card">
        <h2 class="text-xl font-medium text-text-light dark:text-text-dark">{{ __('Edit Notice') }}</h2>
        <a href="{{ route('notices.index') }}"
            class="btn bg-primary-50 dark:bg-primary-50 text-text-light dark:text-text-dark">{{ __('Go to Notice List') }}</a>
    </div>
    <div class="m-6">
        <div class="card">
            <h2 class="text-2xl text-text-light dark:text-text-dark font-bold mb-5">{{ __('Edit Invoice') }}</h2>
            <form method="POST" action="{{ route('invoice.update', $invoice->id) }}">
                @csrf
                @method('PUT')

                <!-- Project Name -->
                <div class="form-field">
                    <select name="project_id" id="project_id" class="form-select">
                        @foreach ($projects as $project)
                            <option class="text-text-light dark:text-text-dark bg-card-light dark:bg-card-dark" value="{{ $project->id }}"
                                {{ $invoice->project_id == $project->id ? 'selected' : '' }}>
                                {{ $project->project_name }}</option>
                        @endforeach
                    </select>
                    <label for="project_id" class="form-label">{{ __('Project Name') }}</label>
                </div>

                <!-- Invoice Number -->
                <div class="form-field">
                    <input type="text" name="invoice_number" id="invoice_number" required
                        value="{{ $invoice->invoice_number }}" placeholder=" " />
                    <label for="invoice_number"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0">{{ __('Invoice Number') }}</label>
                </div>

                <!-- Invoice Date -->
                <div class="form-field">
                    <input type="date" name="invoice_date" id="invoice_date" required onclick="this.showPicker()"
                        value="{{ $invoice->invoice_date }}" />
                    <label for="invoice_date"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0">{{ __('Invoice Date') }}</label>
                </div>

                <button type="submit"
                    class="text-white bg-primary-50 hover:bg-primary-50 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">{{ __('Update') }}</button>
            </form>
        </div>
    </div>
</x-app-layout>