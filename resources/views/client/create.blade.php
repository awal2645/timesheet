@section('title')
    {{ __('Create Client') }}
@endsection
<x-app-layout>
    <div class="flex justify-between m-8 bg-white/10 px-8 py-4 rounded-xl border border-black/10 dark:bg-black/10 backdrop-blur">
        <h2 class="text-xl font-medium">{{ __('Create Client') }}</h2>
        <a href="" class="btn bg-teal-500 dark:bg-teal-900 text-white">{{ __('Go to Client List') }}</a>
    </div>
    <div class="max-w-lg mx-auto mt-6 p-6 bg-white/10 backdrop-blur border border-gray-900/10 dark:bg-gray-800/10 dark:border-white/10 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">{{ __('Create New Client') }}</h2>
        <form method="POST" action="{{ route('client.store') }}" class="max-w-md mx-auto">
            @csrf
            <!-- Employer Name -->
            @if (auth('web')->user()->role != 'employer')
                <div class="relative z-0 w-full mb-5 group">
                    <select name="employer_id" id="employer_id" class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                        <option class="dark:bg-slate-800" value="" selected>
                            {{ __('Select Employer') }}
                        </option>
                        @foreach ($employers as $employer)
                            <option class="dark:bg-slate-800" value="{{ $employer->id }}">
                                {{ $employer->employer_name }}
                            </option>
                        @endforeach
                    </select>
                    <label for="employer_id" class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:bg-blue-50 peer-focus:dark:bg-blue-300 peer-focus:rounded peer-focus:border peer-focus:border-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                        {{ __('Employer Name') }}
                    </label>
                </div>
            @endif
            @if (auth('web')->user()->role == 'employer')
                <input type="hidden" name="employer_id" value="{{ auth('web')->user()->employer->id }}">
            @endif
            <!-- Client Name -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="client_name" id="client_name" class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required value="{{ old('client_name') }}" />
                <label for="client_name" class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:bg-blue-50 peer-focus:dark:bg-blue-300 peer-focus:rounded peer-focus:border peer-focus:border-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                    {{ __('Client Name') }}
                </label>
                @error('client_name')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- Client Email -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="email" name="client_email" id="client_email" class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required value="{{ old('client_email') }}" />
                <label for="client_email" class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:bg-blue-50 peer-focus:dark:bg-blue-300 peer-focus:rounded peer-focus:border peer-focus:border-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                    {{ __('Client Email') }}
                </label>
                @error('client_email')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- Client Phone -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="client_phone" id="client_phone" class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required value="{{ old('client_phone') }}" />
                <label for="client_phone" class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:bg-blue-50 peer-focus:dark:bg-blue-300 peer-focus:rounded peer-focus:border peer-focus:border-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                    {{ __('Client Phone') }}
                </label>
                @error('client_phone')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- Contact Name -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="contact_name" id="contact_name" class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required value="{{ old('contact_name') }}" />
                <label for="contact_name" class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:bg-blue-50 peer-focus:dark:bg-blue-300 peer-focus:rounded peer-focus:border peer-focus:border-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                    {{ __('Contact Name') }}
                </label>
                @error('contact_name')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="text-white bg-teal-500 dark:bg-teal-900 hover:bg-teal-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">{{ __('Submit') }}</button>
        </form>
    </div>
</x-app-layout>
