@section('title')
    {{ __('Edit Leave Type') }}
@endsection
<x-app-layout>
    <div class="card m-6">
        <h2 class="text-2xl font-bold mb-4">{{ __('Edit Leave Type') }}</h2>
        <form method="POST" action="{{ route('leave_types.update', $leaveType->id) }}">
            @csrf
            @method('PUT')
            <!-- Leave Type -->
            <div class="form-field">
                <input type="text" name="type" id="type" placeholder=" " required
                    value="{{ old('type') ?? $leaveType->type }}" />
                <label for="type"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-primary-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{ __('Leave Type') }}</label>
                @error('type')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- Description -->
            <div class="form-field">
                <textarea name="description" id="description" placeholder=" ">{{ old('description') ?? $leaveType->description }}</textarea>
                <label for="description"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-primary-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{ __('Description') }}</label>
                @error('description')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit"
                class="text-white bg-primary-300 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">{{ __('Submit') }}</button>
        </form>
    </div>
</x-app-layout>
