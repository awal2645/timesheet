@section('title')
{{ __('Create Order') }}
@endsection
<x-app-layout>
    <div class="flex items-center justify-between m-6 card">
        <h2 class="text-xl text-text-light dark:text-text-dark font-medium">{{ __('Create Order') }}</h2>
        <a href="{{ route('order.index') }}" class="btn bg-primary-50 dark:bg-primary-50 text-text-light dark:text-text-dark">{{ __('Go to
            Order List') }}</a>
    </div>

    <div class="card m-6">
        <h2 class="text-2xl text-text-light dark:text-text-dark font-bold mb-4">{{ __('Create New Order') }}</h2>

        <form method="POST" action="{{ route('order.store') }}">
            @csrf
            <!-- Employer Name -->
            <div class="form-field">
                <select name="employer_id" id="employer_id" class="select2">
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="" disabled selected>
                        {{ __('Select Employer') }}
                    </option>
                    @foreach ($employers as $employer)
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="{{ $employer->id }}">
                        {{ $employer->employer_name }}
                    </option>
                    @endforeach
                </select>
                @error('employer_id')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- Plan Name -->
            <div class="form-field">
                <select name="plan_id" id="plan_id" class="select2">
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="" disabled selected>
                        {{ __('Select Plan') }}
                    </option>
                    @foreach ($plans as $plan)
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="{{ $plan->id }}">
                        {{ $plan->label }}
                    </option>
                    @endforeach
                </select>
                @error('plan_id')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- Payment method -->
            <div class="form-field">
                <select name="payment_method" id="payment_method" class="select2">
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="" disabled selected>
                        {{ __('Select Payment Method') }}
                    </option>
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="Paypal">
                        {{ __('Paypal') }}
                    </option>
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="Stripe">
                        {{ __('Stripe') }}
                    </option>
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="Offline">
                        {{ __('Offline') }}
                    </option>
                </select>
                @error('payment_method')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- Payment Status -->
            <div class="form-field">
                <select name="payment_status" id="payment_status" class="select2">
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="" disabled selected>
                        {{ __('Select Status') }}
                    </option>
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="paid">
                        {{ __('Paid') }}
                    </option>
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="unpaid">
                        {{ __('Unpaid') }}
                    </option>
                </select>
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