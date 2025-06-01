@section('title', 'Module Management')

<x-app-layout>
    <div class="flex justify-between items-center m-6 card">
        <h2 class="text-xl font-medium text-text-light dark:text-text-dark">{{ __('Module Management') }}</h2>
        <button onclick="window.location.reload()" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                <path fill-rule="evenodd" d="M4.755 10.059a7.5 7.5 0 0 1 12.548-3.364l1.903 1.903h-3.183a.75.75 0 1 0 0 1.5h4.992a.75.75 0 0 0 .75-.75V4.356a.75.75 0 0 0-1.5 0v3.18l-1.9-1.9A9 9 0 0 0 3.306 9.67a.75.75 0 1 0 1.45.388Zm15.408 3.352a.75.75 0 0 0-.919.53 7.5 7.5 0 0 1-12.548 3.364l-1.902-1.903h3.183a.75.75 0 0 0 0-1.5H2.984a.75.75 0 0 0-.75.75v4.992a.75.75 0 0 0 1.5 0v-3.18l1.9 1.9a9 9 0 0 0 15.059-4.035.75.75 0 0 0-.53-.918Z" clip-rule="evenodd" />
              </svg>
              
            {{ __('Refresh') }}
        </button>
    </div>

    <div class="m-6 card">
        @if(session('success'))
            <div class="mb-4">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            </div>
        @endif
        @if($errors->any())
            <div class="mb-4">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ $errors->first() }}</span>
                </div>
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            {{ __('Module Name') }}
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            {{ __('Status') }}
                        </th>
                        <th class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($modules as $module)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-lg text-gray-900 dark:text-gray-100">
                                {{ $module->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="checkbox"
                                           class="sr-only peer"
                                           data-id="{{ $module->id }}"
                                           {{ $module->status ? 'checked' : '' }}>
                                    <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700
                                        peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full
                                        peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px]
                                        after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all
                                        dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600"></div>
                                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                                        {{ $module->status ? __('Enabled') : __('Disabled') }}
                                    </span>
                                </label>
                            </td>
                            <td class="px-6 py-4">
                                <span id="status-message-{{ $module->id }}" class="text-green-600 text-xs hidden"></span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.querySelectorAll('input[type="checkbox"][data-id]').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                const moduleId = this.getAttribute('data-id');
                const status = this.checked ? 1 : 0;
                fetch(`/admin/settings/modules/${moduleId}`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ status })
                })
                .then(response => response.json())
                .then(data => {
                    const msg = document.getElementById('status-message-' + moduleId);
                    if(data.success) {
                        msg.textContent = data.status ? 'Enabled' : 'Disabled';
                        msg.classList.remove('hidden');
                        msg.classList.remove('text-red-600');
                        msg.classList.add('text-green-600');
                        setTimeout(() => msg.classList.add('hidden'), 2000);
                    } else {
                        msg.textContent = 'Failed to update';
                        msg.classList.remove('hidden');
                        msg.classList.remove('text-green-600');
                        msg.classList.add('text-red-600');
                        setTimeout(() => msg.classList.add('hidden'), 2000);
                    }
                })
                .catch(() => {
                    const msg = document.getElementById('status-message-' + moduleId);
                    msg.textContent = 'Failed to update';
                    msg.classList.remove('hidden');
                    msg.classList.remove('text-green-600');
                    msg.classList.add('text-red-600');
                    setTimeout(() => msg.classList.add('hidden'), 2000);
                });
            });
        });
    </script>
</x-app-layout>