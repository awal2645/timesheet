@section('title')
    {{ __('Create Invoice') }}
@endsection
<x-app-layout>
    <div class="m-6">
        <div
            class="mb-12 px-5 py-6 rounded-2xl dark:bg-black/10 bg-white/10 backdrop-blur border border-black/10 dark:border-white/10 flex flex-col md:flex-row justify-end items-center md:space-y-0 ">

            <a href="{{ route('invoice.index') }}" class="bg-purple-500 text-white px-4 py-2 rounded-lg"><i
                    class="fa-solid fa-plus"></i> {{ __('Back to Invoice List') }}</a>
        </div>
        <div class="p-6 bg-white/10 dark:bg-black/10 rounded-lg border border-black/10 dark:border-white/10 shadow-md">
            <h2 class="text-2xl font-bold mb-4">{{ __('Create New Invoice') }}</h2>

            <form method="POST" action="{{ route('invoice.store') }}">
                @csrf
                <!-- Employer Name -->
                <div class="relative z-0 w-full mb-5 group">
                    <select name="employer_id" id="employer_id"
                        class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-purple-500 focus:outline-none focus:ring-0 focus:border-purple-600 peer">
                        <option value="" selected>{{ __('Select Employer') }}</option>
                        @foreach ($employers as $employer)
                            <option value="{{ $employer->id }}">{{ $employer->employer_name }}</option>
                        @endforeach
                    </select>
                    <label for="employer_id"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0">{{ __('Employer Name') }}</label>
                </div>

                <!-- Client Name -->
                <div class="relative z-0 w-full mb-5 group">
                    <select name="client_id" id="client_id"
                        class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-purple-500 focus:outline-none focus:ring-0 focus:border-purple-600 peer">
                        <option value="" selected>{{ __('Select Client') }}</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->client_name }}</option>
                        @endforeach
                    </select>
                    <label for="client_id"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0">{{ __('Client Name') }}</label>
                </div>

                <!-- Project Name -->
                <div class="relative z-0 w-full mb-5 group">
                    <select name="project_id" id="project_id"
                        class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-purple-500 focus:outline-none focus:ring-0 focus:border-purple-600 peer">
                        <option value="" selected>{{ __('Select Project') }}</option>
                        @foreach ($projects as $project)
                            <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                        @endforeach
                    </select>
                    <label for="project_id"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0">{{ __('Project Name') }}</label>
                </div>

                <!-- Invoice Number -->
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="invoice_number" id="invoice_number"
                        class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-purple-500 focus:outline-none focus:ring-0 focus:border-purple-600 peer"
                        placeholder=" " required />
                    <label for="invoice_number"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0">{{ __('Invoice Number') }}</label>
                </div>

                <!-- Total Cost -->
                <div class="relative z-0 w-full mb-5 group">
                    <input type="number" name="total_cost" id="total_cost"
                        class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-purple-500 focus:outline-none focus:ring-0 focus:border-purple-600 peer"
                        placeholder=" " required />
                    <label for="total_cost"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0">{{ __('Total Cost') }}</label>
                </div>


                <button type="submit"
                    class="text-white bg-purple-500 hover:bg-purple-600 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">{{ __('Submit') }}</button>
            </form>
        </div>
    </div>
</x-app-layout>
