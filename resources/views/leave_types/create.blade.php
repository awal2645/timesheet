@section('title')
    {{ __('Create Leave Type') }}
@endsection
<x-app-layout>
    <div class="flex justify-between items-center m-6 card">
        <h2 class="text-xl font-medium text-text-light dark:text-text-dark">{{ __('Create Leave Type') }}</h2>
        <a href="{{ route('leave_types.index') }}"
            class="btn bg-primary-50 dark:bg-primary-50 text-text-light dark:text-text-dark">{{ __('Go to Leave Type List') }}</a>
    </div> 
    <div class="card m-6">
        <h2 class="text-2xl font-bold mb-4 text-text-light dark:text-text-dark">{{ __('Create New Leave Type') }}</h2>
        <form method="POST" action="{{ route('leave_types.store') }}">
            @csrf
            <!-- Leave Type -->
            <div class="form-field">
                <input type="text" name="type" id="type" placeholder=" " required
                    value="{{ old('type') }}" />
                <label for="type" class="">{{ __('Leave Type') }}</label>
                @error('type')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- Description -->
            <div class="form-field">
                <textarea name="description" id="description" placeholder=" ">{{ old('description') }}</textarea>
                <label for="description" class="">{{ __('Description') }}</label>
                @error('description')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit"
                class="text-white bg-primary-50 dark:bg-primary-50 hover:bg-primary-50 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">{{ __('Submit') }}</button>
        </form>
    </div>
</x-app-layout>
