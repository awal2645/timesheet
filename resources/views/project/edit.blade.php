@section('title')
    {{ __('Edit Project') }}
@endsection
<x-app-layout>
    <div class="max-w-lg mx-auto mt-6 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">{{ __('Edit Project') }}</h2>
        <form method="POST" action="{{ route('project.update', $project->id) }}" class="max-w-md mx-auto">
            @csrf
            @method('PUT')
            <!-- {{ __('Select Employer') }}</button>  -->
            @if (auth('web')->user()->role != 'employer')
                <div class="relative z-0 w-full mb-5 group">
                    <select name="employer_id" id="employer_id"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                        <option class="dark:bg-slate-800" value="" selected>
                            {{ __('Select Employer') }}</button>
                        </option>
                        @foreach ($employers as $employer)
                            <option class="dark:bg-slate-800" value="{{ $employer->id }}"
                                {{ $project->employer_id == $employer->id ? 'selected' : '' }}>
                                {{ $employer->employer_name }}
                            </option>
                        @endforeach
                    </select>
                    <label for="employer_id"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Select
                        Employer</label>
                    @error('employer_id')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                </div>
            @endif
            @if (auth('web')->user()->role == 'employer')
                <input type="hidden" name="employer_id" value="{{ auth('web')->user()->employer->id }}">
            @endif
            <!--  Select Client -->
            <div class="relative z-0 w-full mb-5 group">
                <select name="client_id" id="client_id"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                    <option class="dark:bg-slate-800" value="" selected>
                        {{ __('Select Client') }} </option>
                    @foreach ($clients as $client)
                        <option class="dark:bg-slate-800" value="{{ $client->id }}"
                            {{ $project->client_id == $client->id ? 'selected' : '' }}>
                            {{ $client->client_name }}
                        </option>
                    @endforeach
                </select>
                <label for="client_id"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    {{ __('Select Client') }}</label>
                @error('client_id')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>
            <!--  Select Employee -->
            <div class="relative z-0 w-full mb-5 group">
                <select name="employee_id" id="employee_id"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                    <option class="dark:bg-slate-800" value="" selected>
                        {{ __('Select Client') }}
                    </option>
                    @foreach ($employees as $employee)
                        <option class="dark:bg-slate-800" value="{{ $employee->id }}"
                            {{ $project->employee_id == $employee->id ? 'selected' : '' }}>
                            {{ $employee->employee_name }}
                        </option>
                    @endforeach
                </select>
                <label for="employee_id"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    {{ __('Select Employee') }}
                </label>
                @error('employee_id')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>
            <!-- {{ __('Project Name') }} -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="project_name" id="project_name"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " required value="{{ $project->project_name }}" />

                <label for="project_name"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    {{ __('Project Name') }}</label>
                @error('project_name')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>
            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 w-full mb-5 group">
                    <select name="payment_type" id="payment_type"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                        <option class="dark:bg-slate-800" value="hourly"
                            {{ $project->payment_type == 'hourly' ? 'selected' : '' }}>
                            {{ __('Hourly Based') }}
                        </option>
                        <option class="dark:bg-slate-800" value="fixed"
                            {{ $project->payment_type == 'fixed' ? 'selected' : '' }}>
                            {{ __('Fixed Price') }}
                        </option>
                        <option class="dark:bg-slate-800" value="non"
                            {{ $project->payment_type == 'non' ? 'selected' : '' }}>
                            {{ __('Non Billable') }}
                        </option>
                    </select>
                    <label for="payment_type"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        {{ __('Billing Type') }}</label>
                </div>

                <!-- Hourly Budget -->
                <div id="hourly" class="relative z-0 w-full mb-5 group">
                    <input type="text" name="hr_budget" id="hr_budget"
                        value="{{ old('hr_budget') ?? $project->hr_budget }}"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
                    <label for="hr_budget"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        {{ __('Per-Hour ($)') }}</label>
                    @error('hr_budget')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Fixed Budget -->
                <div id="fixed" class="relative z-0 w-full mb-5 group hidden">
                    <input type="text" name="fixed_budget" id="fixed_budget"
                        value="{{ old('fixed_budget') ?? $project->fixed_budget }}"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
                    <label for="fixed_budget"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        {{ __('Total Project Budget ($)') }}</label>
                    @error('fixed_budget')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-purple-500 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>

        </form>
    </div>
    <script>
        function validateEmployeeShare(input) {
            var value = parseFloat(input.value);
            if (isNaN(value) || value < 0) {
                input.value = 0;
            } else if (value > 100) {
                input.value = 100;
            }
        }
    </script>
</x-app-layout>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let paymentTypeSelect = document.getElementById('payment_type');
        let hourlyBudgetDiv = document.getElementById('hourly');
        let fixedBudgetDiv = document.getElementById('fixed');

        paymentTypeSelect.addEventListener('change', function() {
            togglePaymentFields(this.value);
        });

        // Initial load
        togglePaymentFields(paymentTypeSelect.value);

        function togglePaymentFields(paymentType) {
            if (paymentType === 'hourly') {
                hourlyBudgetDiv.classList.remove('hidden');
                fixedBudgetDiv.classList.add('hidden');
            } else if (paymentType === 'project') {
                hourlyBudgetDiv.classList.add('hidden');
                fixedBudgetDiv.classList.remove('hidden');
            } else {
                hourlyBudgetDiv.classList.add('hidden');
                fixedBudgetDiv.classList.add('hidden');
            }
        }
    });
</script>
