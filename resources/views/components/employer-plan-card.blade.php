@props(['plan'])

<div class="bg-white/10 dark:bg-black/10 backdrop-blur rounded-lg shadow-md p-6 text-center flex flex-col justify-between h-full">
    <h2 class="text-lg font-bold text-gray-800 dark:text-gray-100">{{ $plan->label }}</h2>

    @if ($plan->recommended)
        <div class="mt-2">

            <span
                class="bg-green-200 text-green-700 dark:bg-green-700 dark:text-green-200 p-3 rounded-full text-xs">Recommended</span>
        </div>
    @endif

    <div class="text-3xl font-bold my-4 text-gray-800 dark:text-gray-100">
        ${{ $plan->price }}
    </div>

    <p class="text-sm text-gray-500 dark:text-gray-400">
        {{ $plan->description }}
    </p>
    <br>
    <hr>
    <ul class="my-4 space-y-2 text-center">
        <li class="flex items-center space-x-2">
            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m2 0a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <span class="text-gray-800 dark:text-gray-100">Employee Limit: {{ $plan->employee_limit }}</span>
        </li>
        <li class="flex items-center space-x-2">
            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m2 0a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <span class="text-gray-800 dark:text-gray-100">Client Limit: {{ $plan->client_limit }}</span>
        </li>
        <li class="flex items-center space-x-2">
            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m2 0a2 2 0 11-4 0 2 2 0z"></path>
            </svg>
            <span class="text-gray-800 dark:text-gray-100">Project Limit: {{ $plan->project_limit }}</span>
        </li>
    </ul>

    <div class="flex justify-between items-center " style="
    margin-top: 89px;
">
        {{-- stripe payment --}}
        @if (config('zenxserv.stripe_active') && config('zenxserv.stripe_key') && config('zenxserv.stripe_secret'))
            <form action="{{ route('stripe.payment.purchase') }}" method="post">
                @csrf
                <input type="hidden" name="amount" value="{{ $plan->price }}">
                <input type="hidden" name="plan_id" value="{{ $plan->id }}">

                <div class=" shadow-gray-base-1 p-[1.5rem] rounded-xl space-y-[1.12rem]">
                    <div class="flex items-center gap-3">
                        <button type="submit" class=" text-white text-2xl bg-indigo-600 rounded-lg px-4 py-2">
                            <i class="fa-brands fa-stripe"></i> </button>
                    </div>
                </div>
            </form>
        @endif
        {{-- Paypal payment --}}
        @if (config('paypal.mode') == 'sandbox')
            @if (config('paypal.active') && config('paypal.sandbox.client_id') && config('paypal.sandbox.client_secret'))
                <button id="paypal_btn" class="text-white paypal_btn text-2xl bg-purple-500 rounded-lg px-4 py-2">
                    <i class="fa-brands fa-paypal"></i> </button>
            @endif
        @else
            @if (config('paypal.active') && config('paypal.live.client_id') && config('paypal.live.client_secret'))
                <button id="paypal_btn" class="text-white paypal_btn bg-purple-500 rounded-lg px-4 py-2">
                    {{ __('Pay with PayPal') }}
                </button>
            @endif
        @endif

    </div>

    {{-- Paypal Form --}}
    <form action="{{ route('paypal.post') }}" method="POST" class="hidden paypal-form">
        @csrf
        <input type="hidden" name="plan_id" value="{{ $plan->id }}">
        <input type="hidden" name="amount" value="{{ $plan->price }}">
    </form>
</div>

<script>
    // Paypal
    document.querySelectorAll('.paypal_btn').forEach((button, index) => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelectorAll('.paypal-form')[index].submit();
        });
    });
</script>
