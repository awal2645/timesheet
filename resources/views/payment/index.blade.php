@section('title')
    {{ __('Payment Settings') }}
@endsection

<x-app-layout>
    <div class="relative m-6">
        <h2 class="text-2xl font-bold mb-6 text-text-light dark:text-text-dark">{{ __('Payment Settings') }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10"> <!-- Use grid layout for forms -->
            
            <!-- PayPal Settings -->
            <form action="{{ route('payment.update') }}" method="POST" enctype="multipart/form-data"
                class="p-6 rounded-lg border border-black/10 dark:border-white/10 bg-card-light dark:bg-card-dark shadow-lg"> <!-- Added shadow -->
                @method('PUT')
                @csrf
                <input type="hidden" name="type" value="paypal">
                <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold mb-4 flex items-center text-text-light dark:text-text-dark"> <!-- Added flex for alignment -->
                    <i class="fab fa-paypal mr-2" style="color: var(--primary-50);"></i> <!-- Example icon, ensure to include FontAwesome or similar -->
                    {{ __('Paypal Settings') }} 
                    </h3>
                    <a href="https://developer.paypal.com/developer/accounts/" target="_bulk"
                        class="text-primary-50 dark:text-primary-50 " style="text-decoration: underline; color: var(--primary-50);  ">({{ __('Get Help') }})</a>
                </div>

                <!-- Live Mode Toggle -->
                <div class="mb-6"> <!-- Increased margin -->
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="paypal_live_mode" class="sr-only peer"
                            {{ config('zenxserv.paypal_mode') == 'live' ? 'checked' : '' }} value="1">
                        <div
                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary-300 dark:peer-focus:ring-primary-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-primary-50">
                        </div>
                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('Live Mode') }}</span>
                    </label>
                </div>

                <!-- Conditionally Render Client ID and Secret -->
                @if (config('zenxserv.paypal_mode') == 'sandbox')
                    <div class="mb-6"> <!-- Increased margin -->
                        <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-200">{{ __('Sandbox Client ID') }} *</label>
                        <input type="text" name="paypal_client_id"
                            class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-800 dark:text-white"
                            value="{{ config('zenxserv.paypal_sandbox_client_id') }}" required>
                    </div>

                    <div class="mb-6"> <!-- Increased margin -->
                        <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-200">{{ __('Sandbox Client Secret') }} *</label>
                        <input type="text" name="paypal_client_secret"
                            class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-800 dark:text-white"
                            value="{{ config('zenxserv.paypal_sandbox_secret') }}" required>
                    </div>
                @else
                    <div class="mb-6"> <!-- Increased margin -->
                        <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-200">{{ __('Live Client ID') }} *</label>
                        <input type="text" name="paypal_client_id"
                            class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-800 dark:text-white"
                            value="{{ config('zenxserv.paypal_live_client_id') }}" required>
                    </div>

                    <div class="mb-6"> <!-- Increased margin -->
                        <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-200">{{ __('Live Client Secret') }} *</label>
                        <input type="text" name="paypal_client_secret"
                            class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-800 dark:text-white"
                            value="{{ config('zenxserv.paypal_live_secret') }}" required>
                    </div>
                @endif

                <!-- Status Toggle -->
                <div class="mb-6"> <!-- Increased margin -->
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="paypal" class="sr-only peer"
                            {{ config('zenxserv.paypal_active') ? 'checked' : '' }}>
                        <div
                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary-300 dark:peer-focus:ring-primary-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-primary-50">
                        </div>
                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('Status') }}</span>
                    </label>
                </div>

                <button type="submit"
                    class="text-white bg-primary-50 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm w-full sm:w-auto px-6 py-3 text-center dark:bg-primary-500 dark:hover:bg-primary-700 dark:focus:ring-primary-800">{{ __('Submit') }}</button> <!-- Consistent button style -->
            </form>

            <!-- Stripe Settings -->
            <form action="{{ route('payment.update') }}" method="POST" enctype="multipart/form-data"
                class="p-6 rounded-lg border border-black/10 dark:border-white/10 bg-card-light dark:bg-card-dark shadow-lg">
                @method('PUT')
                @csrf
                <input type="hidden" name="type" value="stripe">
                <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold mb-4 flex items-center text-text-light dark:text-text-dark"> 
                    <i class="fab fa-stripe mr-2 text-primary-50" style="color: var(--primary-50);"></i>
                    {{ __('Stripe Settings') }} 
                </h3>
                <a href="https://docs.stripe.com/keys"
                    target="_bulk" class="text-primary-50 dark:text-primary-50 text-sm" style="text-decoration: underline; color: var(--primary-50);  ">({{ __('Get Help') }})</a>
                </div>

                <!-- Secret Key -->
                <div class="mb-6"> <!-- Increased margin -->
                    <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-200">{{ __('Secret Key') }} *</label>
                    <input type="text" name="stripe_secret"
                        class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-800 dark:text-white"
                        value="{{ config('zenxserv.stripe_secret') }}" required>
                </div>

                <!-- Publisher Key -->
                <div class="mb-6"> <!-- Increased margin -->
                    <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-200">{{ __('Publisher Key') }} *</label>
                    <input type="text" name="stripe_key"
                        class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-800 dark:text-white"
                        value="{{ config('zenxserv.stripe_key') }}" required>
                </div>

                <!-- Status Toggle -->
                <div class="mb-6"> <!-- Increased margin -->
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="stripe" class="sr-only peer"
                            {{ config('zenxserv.stripe_active') ? 'checked' : '' }}>
                        <div
                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary-300 dark:peer-focus:ring-primary-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-primary-50">
                        </div>
                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('Status') }}</span>
                    </label>
                </div>

                <button type="submit"
                    class="text-white bg-primary-50 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm w-full sm:w-auto px-6 py-3 text-center dark:bg-primary-500 dark:hover:bg-primary-700 dark:focus:ring-primary-800">{{ __('Submit') }}</button> <!-- Consistent button style -->
            </form>
        </div>
    </div>
</x-app-layout>