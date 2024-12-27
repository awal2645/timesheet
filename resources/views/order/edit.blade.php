@section('title')
{{ __('Edit Order') }}
@endsection
<x-app-layout>
    <div class="flex items-center justify-between m-6 card">
        <h2 class="text-xl text-text-light dark:text-text-dark font-medium">{{ __('Edit Order') }}</h2>
        <a href="{{ route('order.index') }}" class="btn bg-primary-50 dark:bg-primary-50 text-text-light dark:text-text-dark">{{ __('Go to
            Order List') }}</a>
    </div>
    <div class="card m-6">
        <h2 class="text-2xl text-text-light dark:text-text-dark font-bold mb-4">{{ __('Edit Order') }}</h2>

        <form method="POST" action="{{ route('order.update', $order->id) }}">
            @csrf
            @method('PUT')
            <!-- Employer Name -->
            <div class="form-field">
                <select name="employer_id" id="employer_id" class="form-select">
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="" selected>
                        {{ __('Select Employer') }}
                    </option>
                    @foreach ($employers as $employer)
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="{{ $employer->id }}" {{ $order->employer_id == $employer->id ? 'selected' : '' }}>
                        {{ $employer->employer_name }}
                    </option>
                    @endforeach
                </select>
                <label for="employer_id" class="form-label">{{ __('Employer Name') }}</label>
                @error('employer_id')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- Plan Name -->
            <div class="form-field">
                <select name="price_plans_id" id="price_plans_id" class="form-select">
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="" selected>
                        {{ __('Select Plan') }}
                    </option>
                    @foreach ($plans as $plan)
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="{{ $plan->id }}" {{ $order->price_plans_id == $plan->id ? 'selected' : '' }}>
                        {{ $plan->label }}
                    </option>
                    @endforeach
                </select>
                <label for="price_plans_id" class="form-label">{{ __('Plan Name') }}</label>
                @error('price_plans_id')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- Payment method -->
            <div class="form-field">
                <select name="payment_provider" id="payment_provider" class="form-select">
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="" selected>
                        {{ __('Select Payment Method') }}
                    </option>
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="Paypal" {{ $order->payment_provider == 'paypal' ? 'selected' : '' }}>
                        {{ __('Paypal') }}
                    </option>
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="Stripe" {{ $order->payment_provider == 'stripe' ? 'selected' : '' }}>
                        {{ __('Stripe') }}
                    </option>
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="Offline" {{ $order->payment_provider == 'offline' ? 'selected' : '' }}>
                        {{ __('Offline') }}
                    </option>
                </select>
                <label for="payment_provider" class="form-label">{{ __('Select Payment Method') }}</label>
                @error('payment_provider')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- Payment Status -->
            <div class="form-field">
                <select name="payment_status" id="payment_status" class="form-select">
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="" selected>
                        {{ __('Select Status') }}
                    </option>
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>
                       {{ __('Paid') }}
                    </option>
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="unpaid" {{ $order->payment_status == 'unpaid' ? 'selected' : '' }}>
                        {{ __('Unpaid') }}
                    </option>
                </select>
                <label class="form-label" for="payment_status">{{ __('Payment Status') }}</label>
                @error('payment_status')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit"
                class="text-text-light dark:text-text-dark bg-primary-100 dark:bg-primary-50 hover:bg-primary-50 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                {{ __('Submit') }}
            </button>
        </form>
    </div>
</x-app-layout>