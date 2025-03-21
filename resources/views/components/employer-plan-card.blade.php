@props(['plan'])

<div class="card flex flex-col">
    <div class="grow">
        <h2 class="text-lg font-bold text-gray-800 dark:text-gray-100 flex items-center space-x-2">
            <span>{{ $plan->label }}</span>
            @if ($plan->recommended)
                <span class=" text-text-light px-2 py-1 text-sm rounded-lg bg-green-300 dark:bg-green-200 dark:text-green-800">
                     {{ __('Recommended') }} 
                </span>
            @endif
        </h2>
        

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
                <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m2 0a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <span class="text-gray-800 dark:text-gray-100">Employee Limit: {{ $plan->employee_limit }}</span>
            </li>
            <li class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m2 0a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <span class="text-gray-800 dark:text-gray-100">Client Limit: {{ $plan->client_limit }}</span>
            </li>
            <li class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m2 0a2 2 0 11-4 0 2 2 0z"></path>
                </svg>
                <span class="text-gray-800 dark:text-gray-100">Project Limit: {{ $plan->project_limit }}</span>
            </li>
        </ul>
    </div>

    <div class="flex justify-between items-center">
        {{-- stripe payment --}}
        @if (config('zenxserv.stripe_active') && config('zenxserv.stripe_key') && config('zenxserv.stripe_secret'))
            <form action="{{ route('stripe.payment.purchase') }}" method="post">
                @csrf
                <input type="hidden" name="amount" value="{{ $plan->price }}">
                <input type="hidden" name="plan_id" value="{{ $plan->id }}">

                <div class=" shadow-gray-base-1 p-[1.5rem] rounded-xl space-y-[1.12rem]">
                    <div class="flex items-center gap-3">
                        <button type="submit" class=" text-text-light dark:text-text-dark text-2xl bg-primary-50 rounded-lg px-4 py-2">
                            <i class="fa-brands fa-stripe"></i> </button>
                    </div>
                </div>
            </form>
        @endif
        {{-- Paypal payment --}}
        @if (config('paypal.mode') == 'sandbox')
            @if (config('paypal.active') && config('paypal.sandbox.client_id') && config('paypal.sandbox.client_secret'))
                <button id="paypal_btn" class="text-text-light dark:text-text-dark paypal_btn text-2xl bg-primary-50 rounded-lg px-4 py-2">
                    <i class="fa-brands fa-paypal"></i> </button>
            @endif
        @else
            @if (config('paypal.active') && config('paypal.live.client_id') && config('paypal.live.client_secret'))
                <button id="paypal_btn" class="text-text-light dark:text-text-dark paypal_btn text-2xl bg-primary-50 rounded-lg px-4 py-2">
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
