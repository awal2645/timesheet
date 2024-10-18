@section('title')
{{ 'Application Upgrade' }}
@endsection

<x-app-layout>
    <div class="max-w-4xl mx-auto mt-6 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        <!-- Header Section -->
        <div class="bg-purple-200 p-4 rounded-md">
            <h2 class="text-lg font-semibold text-purple-700">Upgrade Guide (Current version {{ config('app.version')
                }})</h2>
        </div>

        <!-- Upgrade Instructions Section -->
        <div class="bg-teal-500 text-white p-6 mt-4 rounded-md">
            <ul class="list-disc ml-4">
                <li>Application current version <strong>{{ config('app.version') }}</strong>
                    <a href="https://engagingdot.com/knowledge-base/upgrade-guide/" class="underline text-white">Check here How to Update Your Application</a>
                </li>
                <li>Extract downloaded zip file and find <strong>app.zip</strong> file.</li>
                <li>Put that <strong>app.zip</strong> file in the server's application root directory.</li>
                <li>Extract <strong>app.zip</strong> (it will replace the most recent update in your application).</li>
                <li>Finally, click the below "Upgrade Now" button.</li>
            </ul>
        </div>

        <!-- Form Section -->
        <div class="max-w-md mx-auto mt-6">
            <form method="POST" action="{{ route('upgrade.apply') }}" enctype="multipart/form-data">
                @csrf
                <button type="submit"
                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Upgrade Now
                </button>
            </form>
        </div>
    </div>
</x-app-layout>