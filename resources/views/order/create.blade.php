@section('title')
    {{ __('Create Order') }}
@endsection
<x-app-layout>
    <div class="max-w-lg mx-auto mt-6 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">{{ __('Create New Order') }}</h2>
        <form method="POST" action="{{ route('order.store') }}" class="max-w-md mx-auto">
            @csrf
            <!-- Employer Name -->
            <div class="relative z-0 w-full mb-5 group">
                <select name="employer_id" id="employer_id"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                    <option class="dark:bg-slate-800" value="" selected>
                        {{ __('Select Employer') }}
                    </option>
                    @foreach ($employers as $employer)
                        <option class="dark:bg-slate-800" value="{{ $employer->id }}">
                            {{ $employer->employer_name }}
                        </option>
                    @endforeach
                </select>
                <label for="employer_id"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{ __('Employer Name') }}</label>
                @error('employer_id')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- Plan Name -->
            <div class="relative z-0 w-full mb-5 group">
                <select name="plan_id" id="plan_id"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                    <option class="dark:bg-slate-800" value="" selected>
                        {{ __('Select Plan') }}
                    </option>
                    @foreach ($plans as $plan)
                        <option class="dark:bg-slate-800" value="{{ $plan->id }}">
                            {{ $plan->label }}
                        </option>
                    @endforeach
                </select>
                <label for="plan_id"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{ __('Plan Name') }}</label>
                @error('plan_id')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- Payment method -->
            <div class="relative z-0 w-full mb-5 group">
                <select name="payment_method" id="payment_method"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
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
                <label for="payment_method"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{ __('Select Payment Method') }}</label>
                @error('payment_method')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- Payment Status -->
            <div class="relative z-0 w-full mb-5 group">
                <select name="payment_status" id="payment_status"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
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
                <label for="payment_status"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{ __('Payment Status') }}</label>
                @error('payment_status')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit"
                class="text-white bg-purple-500 dark:bg-purple-900 hover:bg-[#1da8f7] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">{{ __('Submit') }}</button>
        </form>
    </div>
</x-app-layout>
