@section('title')
    {{ __('Application Upgrade') }}
@endsection

<x-app-layout>
    <div class="m-6 card">
        <!-- Header Section -->
        <div class="dark:bg-primary-200/10 bg-primary-50/10 p-4 rounded-md">
            <h2 class="text-lg font-semibold text-primary-300">{{ __('Upgrade Guide') }} ({{ __('Current version') }}
                {{ config('app.version') }})
            </h2>
        </div>

        <!-- Upgrade Instructions Section -->
        <div class="bg-card-light dark:bg-card-dark text-text-light dark:text-text-dark p-6 mt-4 rounded-md">
            <ul class="list-disc ml-4">
                <li>{{ __('Application current version') }} <strong>{{ config('app.version') }}</strong>
                    <a href="https://zenxservices.com/knowledge-base/upgrade-guide/"
                        class="underline text-text-light dark:text-text-dark">{{ __('Check here How to Update Your Application') }}</a>
                </li>
                <li>{{ __('Extract downloaded zip file and find app.zip file.') }}</li>
                <li>{{ __('Put that app.zip file in the server\'s application root directory.') }}</li>
                <li>{{ __('Extract app.zip (it will replace the most recent update in your application).') }}</li>
                <li>{{ __('Finally, click the below "Upgrade Now" button.') }}</li>
            </ul>
        </div>

        <!-- Form Section -->
        <div class="max-w-md mx-auto mt-6">
            <form method="POST" action="{{ route('upgrade.apply') }}" enctype="multipart/form-data">
                @csrf
                <button type="submit"
                    class="w-full text-text-light dark:text-text-dark bg-primary-50 hover:bg-primary-300 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-50 dark:hover:bg-primary-50 dark:focus:ring-primary-800">
                    {{ __('Upgrade Now') }}
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
