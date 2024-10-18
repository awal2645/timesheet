@section('title')
    {{ 'Send Invite' }}
@endsection
<x-app-layout>
    @if (auth('web')->user()->role == 'superadmin')
        <div class="max-w-lg mx-auto mt-6 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-4">Send Invite</h2>

            <form method="POST" action="{{ route('invite.send.employer') }}" class="max-w-md mx-auto">
                @csrf
                <div class="relative z-0 w-full mb-5 group">
                    <select name="role_name" id="role_name"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900  bg-transparent 	 border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:bg-color-gray-600 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                        <option value="" class="dark:bg-slate-800">
                            Select Role
                        </option>
                        @foreach ($roles as $role)
                            <option class="dark:bg-slate-800 capitalize" value="{{ $role->name }}">
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                    <label for="client_id"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Role Name</label>
                    @error('role_name')
                        <span class=" text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Employer Email -->
                <div class="relative z-0 w-full mb-5 group">
                    <input type="email" name="email" id="email"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " required value="{{ old('email') }}" />
                    <label for="email"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Employer
                        Email</label>
                    @error('email')
                        <span class=" text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>


            </form>
        </div>
    @else
        <div class="max-w-lg mx-auto mt-6 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-4">Send Invite to Employee</h2>
            <form method="POST" action="{{ route('invite.send.employee') }}" class="max-w-md mx-auto">
                @csrf
                <div class="relative z-0 w-full mb-5 group">
                    <select name="role_name" id="role_name"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900  bg-transparent 	 border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:bg-color-gray-600 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                        <option value="" class="dark:bg-slate-800">
                            Select Role
                        </option>
                        @foreach ($roles as $role)
                            @if ($role->name != 'superadmin')
                                <option class="dark:bg-slate-800 capitalize" value="{{ $role->name }}">
                                    {{ $role->name }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                    <label for="client_id"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Role Name</label>
                    @error('role_name')
                        <span class=" text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Employee Email -->
                <div class="relative z-0 w-full mb-5 group">
                    <input type="email" name="email" id="email"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('email') border-red-500 @enderror"
                        placeholder=" " required value="{{ old('email') }}" />
                    <label for="email"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Employee
                        Email</label>
                    @error('email')
                        <span class=" text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit"
                    class="text-white bg-[#0b4dc4] hover:bg-[#1da8f7] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
            </form>
        </div>
    @endif
</x-app-layout>
