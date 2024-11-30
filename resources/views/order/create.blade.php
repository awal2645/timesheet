@section('title')
    {{ __('Create Order') }}
@endsection
<x-app-layout>
    <div class="flex items-center justify-between m-6 card">
        <h2 class="text-xl font-medium">{{ __('Create Order') }}</h2>
        <a href="{{ route('order.index') }}"
            class="btn bg-primary-300 dark:bg-primary-900 text-white">{{ __('Go to Order List') }}</a>
    </div>

    <div class="card m-6">
        <h2 class="text-2xl font-bold mb-4">{{ __('Create New Order') }}</h2>

        <form method="POST" action="{{ route('order.store') }}">
            @csrf
            <!-- Employer Name -->
            <div class="form-field">
                <select electname="employer_id" id="employer_id" class="form-select">
                    <option class="dark:bg-slate-800" value="" selected>
                        {{ __('Select Employer') }}
                    </option>
                    @foreach ($employers as $employer)
                        <option class="dark:bg-slate-800" value="{{ $employer->id }}">
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
                <select name="plan_id" id="plan_id" class="form-select">
                    <option class="dark:bg-slate-800" value="" selected>
                        {{ __('Select Plan') }}
                    </option>
                    @foreach ($plans as $plan)
                        <option class="dark:bg-slate-800" value="{{ $plan->id }}">
                            {{ $plan->label }}
                        </option>
                    @endforeach
                </select>
                <label for="plan_id" class="form-label">{{ __('Plan Name') }}</label>
                @error('plan_id')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- Payment method -->
            <div class="form-field">
                <select name="payment_method" id="payment_method" class="form-select">
                    <option class="dark:bg-slate-800" value="" selected>
                        {{ __('Select Payment Method') }}
                    </option>
                    <option class="dark:bg-slate-800" value="Paypal">
                        {{ __('Paypal') }}
                    </option>
                    <option class="dark:bg-slate-800" value="Stripe">
                        {{ __('Stripe') }}
                    </option>
                    <option class="dark:bg-slate-800" value="Offline">
                        {{ __('Offline') }}
                    </option>
                </select>
                <label for="payment_method" class="form-label">{{ __('Select Payment Method') }}</label>
                @error('payment_method')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- Payment Status -->
            <div class="form-field">
                <select name="payment_status" id="payment_status" class="form-select">
                    <option class="dark:bg-slate-800" value="" selected>
                        {{ __('Select Status') }}
                    </option>
                    <option class="dark:bg-slate-800" value="paid">
                        {{ __('Paid') }}
                    </option>
                    <option class="dark:bg-slate-800" value="unpaid">
                        {{ __('Unpaid') }}
                    </option>
                </select>
                <label class="form-label" for="payment_status">{{ __('Payment Status') }}</label>
                @error('payment_status')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit"
                class="text-white bg-primary-500 hover:bg-primary-600 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                {{ __('Submit') }}
            </button>
        </form>
    </div>
</x-app-layout>
