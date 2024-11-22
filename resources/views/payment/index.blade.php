@section('title')
    {{ __('Payment Settings') }}
@endsection

<x-app-layout>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 m-6 p-6 bg-white/10 dark:bg-black/10 border border-black/10 dark:border-white/10 rounded-lg shadow-md">
        <!-- PayPal Settings -->
        <form action="{{ route('payment.update') }}" method="POST" enctype="multipart/form-data" class="p-6 rounded-lg border boredr-black/10 dark:border-white/10 bg-white/30 dark:bg-black/30 ">
            @method('PUT')
            @csrf
            <input type="hidden" name="type" value="paypal">
            <div class="p-6 rounded-lg shadow">
                <h3 class="text-xl font-bold mb-4">{{ __('Paypal Settings') }} <a
                        href="https://developer.paypal.com/developer/accounts/" target="_bulk"
                        class="text-blue-500 text-sm">({{ __('Get Help') }})</a></h3>

                <!-- Live Mode Toggle -->
                <div class="mb-4">
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="paypal_live_mode" class="sr-only peer"
                            {{ config('zenxserv.paypal_mode') == 'live' ? 'checked' : '' }} value="1">
                        <div
                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-purple-500">
                        </div>
                        <span
                            class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('Live Mode') }}</span>
                    </label>
                </div>

                <!-- Conditionally Render Client ID and Secret -->
                @if (config('zenxserv.paypal_mode') == 'sandbox')
                    <!-- Sandbox Client ID -->
                    <div class="mb-4">
                        <label
                            class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-200">{{ __('Sandbox Client ID') }}
                            *</label>
                        <input type="text" name="paypal_client_id"
                            class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-800 dark:text-white"
                            value="{{ config('zenxserv.paypal_sandbox_client_id') }}" required>
                    </div>

                    <!-- Sandbox Client Secret -->
                    <div class="mb-4">
                        <label
                            class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-200">{{ __('Sandbox Client Secret') }}
                            *</label>
                        <input type="text" name="paypal_client_secret"
                            class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-800 dark:text-white"
                            value="{{ config('zenxserv.paypal_sandbox_secret') }}" required>
                    </div>
                @else
                    <!-- Live Client ID -->
                    <div class="mb-4">
                        <label
                            class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-200">{{ __('Live Client ID') }}
                            *</label>
                        <input type="text" name="paypal_client_id"
                            class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-800 dark:text-white"
                            value="{{ config('zenxserv.paypal_live_client_id') }}" required>
                    </div>

                    <!-- Live Client Secret -->
                    <div class="mb-4">
                        <label
                            class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-200">{{ __('Live Client Secret') }}
                            *</label>
                        <input type="text" name="paypal_client_secret"
                            class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-800 dark:text-white"
                            value="{{ config('zenxserv.paypal_live_secret') }}" required>
                    </div>
                @endif

                <!-- Status Toggle -->
                <div class="mb-4">
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="paypal" class="sr-only peer"
                            {{ config('zenxserv.paypal_active') ? 'checked' : '' }}>
                        <div
                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-purple-500">
                        </div>
                        <span
                            class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('Status') }}</span>
                    </label>
                </div>

                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-purple-500 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __('Submit') }}</button>
            </div>
        </form>

        <!-- Stripe Settings -->
        <form action="{{ route('payment.update') }}" method="POST" enctype="multipart/form-data" class="p-6 rounded-lg border boredr-black/10 dark:border-white/10 bg-white/30 dark:bg-black/30 ">
            @method('PUT')
            @csrf
            <input type="hidden" name="type" value="stripe">
            <div class="p-6 rounded-lg shadow">
                <h3 class="text-xl font-bold mb-4">{{ __('Stripe Settings') }} <a href="https://docs.stripe.com/keys"
                        target="_bulk" class="text-blue-500 text-sm">({{ __('Get Help') }})</a></h3>

                <!-- Secret Key -->
                <div class="mb-4">
                    <label
                        class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-200">{{ __('Secret Key') }}
                        *</label>
                    <input type="text" name="stripe_secret"
                        class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-800 dark:text-white"
                        value="{{ config('zenxserv.stripe_secret') }}" required>
                </div>

                <!-- Publisher Key -->
                <div class="mb-4">
                    <label
                        class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-200">{{ __('Publisher Key') }}
                        *</label>
                    <input type="text" name="stripe_key"
                        class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-800 dark:text-white"
                        value="{{ config('zenxserv.stripe_key') }}" required>
                </div>

                <!-- Status Toggle -->
                <div class="mb-4">
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="stripe" class="sr-only peer"
                            {{ config('zenxserv.stripe_active') ? 'checked' : '' }}>
                        <div
                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-purple-500">
                        </div>
                        <span
                            class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('Status') }}</span>
                    </label>
                </div>

                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-purple-500 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __('Submit') }}</button>
            </div>
        </form>
    </div>
</x-app-layout>
