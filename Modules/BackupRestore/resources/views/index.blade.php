@section('title')
{{ 'Tasks' }}
@endsection
<x-app-layout>
    <div class="p-6 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Backup & Restore</h1>
            <p class="text-gray-600 dark:text-gray-400">Manage your application backups and restore data when needed</p>
        </div>

        <!-- Alert Messages -->
        <div id="alert-container" class="mb-6 hidden">
            <div id="alert-message" class="p-4 rounded-lg"></div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900">
                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 7v10c0 2.21 1.79 4 4 4h8c0 2.21 1.79 4 4 4h8c2.21 0 4-1.79 4-4V7c0-2.21-1.79-4-4-4H8c-2.21 0-4 1.79-4 4z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Backups</p>
                        <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ count($backups) }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 dark:bg-green-900">
                        <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Latest Backup</p>
                        <p class="text-2xl font-semibold text-gray-900 dark:text-white">
                            {{ count($backups) > 0 ? $backups[0]['date'] : 'None' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 dark:bg-yellow-900">
                        <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Used Space</p>
                        <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $diskSpace['used'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 dark:bg-purple-900">
                        <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Free Space</p>
                        <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $diskSpace['free'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Backup Actions -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow mb-8">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Create Backup</h2>
                <p class="text-gray-600 dark:text-gray-400">Choose the type of backup you want to create</p>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- <button onclick="createBackup('full')"
                        class="backup-btn flex flex-col items-center p-6 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900 mb-4">
                            <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Full Backup</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 text-center">Complete backup including
                            database and files</p>
                    </button> --}}

                    <button onclick="createBackup('database')"
                        class="backup-btn flex flex-col items-center p-6 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <div class="p-3 rounded-full bg-green-100 dark:bg-green-900 mb-4">
                            <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path d="M21 6.375c0 2.692-4.03 4.875-9 4.875S3 9.067 3 6.375 7.03 1.5 12 1.5s9 2.183 9 4.875Z" />
                                <path d="M12 12.75c2.685 0 5.19-.586 7.078-1.609a8.283 8.283 0 0 0 1.897-1.384c.016.121.025.244.025.368C21 12.817 16.97 15 12 15s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.285 8.285 0 0 0 1.897 1.384C6.809 12.164 9.315 12.75 12 12.75Z" />
                                <path d="M12 16.5c2.685 0 5.19-.586 7.078-1.609a8.282 8.282 0 0 0 1.897-1.384c.016.121.025.244.025.368 0 2.692-4.03 4.875-9 4.875s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.284 8.284 0 0 0 1.897 1.384C6.809 15.914 9.315 16.5 12 16.5Z" />
                                <path d="M12 20.25c2.685 0 5.19-.586 7.078-1.609a8.282 8.282 0 0 0 1.897-1.384c.016.121.025.244.025.368 0 2.692-4.03 4.875-9 4.875s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.284 8.284 0 0 0 1.897 1.384C6.809 19.664 9.315 20.25 12 20.25Z" />
                            </svg>
                           
                              
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Database Only</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 text-center">Backup database tables and data
                            only</p>
                    </button>

                    <button onclick="createBackup('files')"
                        class="backup-btn flex flex-col items-center p-6 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <div class="p-3 rounded-full bg-purple-100 dark:bg-purple-900 mb-4">
                            <svg class="w-8 h-8 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-5L12 5H5a2 2 0 00-2 2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Files Only</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 text-center">Backup uploaded .env files and assets
                            only</p>
                    </button>
                </div>
            </div>
        </div>

        <!-- Progress Bar -->
        <div id="progress-container" class="bg-white dark:bg-gray-800 rounded-lg shadow mb-8 hidden">
            <div class="p-6">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300" id="progress-text">Creating
                        backup...</span>
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300"
                        id="progress-percentage">0%</span>
                </div>
                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                    <div class="bg-blue-600 h-2 rounded-full transition-all duration-300" id="progress-bar"
                        style="width: 0%"></div>
                </div>
            </div>
        </div>

        <!-- Backup List -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Backup History</h2>
                <p class="text-gray-600 dark:text-gray-400">Manage your existing backups</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Backup Name</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Type</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Size</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Date</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700"
                        id="backups-table">
                        @forelse($backups as $backup)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $backup['name'] }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                @if($backup['type'] === 'full') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                                @elseif($backup['type'] === 'database') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                @elseif($backup['type'] === 'files') bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200
                                @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200 @endif">
                                    {{ ucfirst($backup['type']) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{
                                $backup['size'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{
                                $backup['date'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <button onclick="downloadBackup('{{ $backup['name'] }}')"
                                        class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300"
                                        title="Download">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 10v6m0 0l-4-4m4 4l4-4m-4-4V4"></path>
                                        </svg>
                                    </button>

                                    <button onclick="showRestoreModal('{{ $backup['name'] }}', '{{ $backup['type'] }}')"
                                        class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300"
                                        title="Restore">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                            </path>
                                        </svg>
                                    </button>

                                    <button onclick="deleteBackup('{{ $backup['name'] }}')"
                                        class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                        title="Delete">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                <div class="flex flex-col items-center">
                                    <svg class="w-12 h-12 mb-4 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                        </path>
                                    </svg>
                                    <p>No backups found</p>
                                    <p class="text-sm">Create your first backup using the buttons above</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
    <!-- Restore Modal -->
    <div id="restore-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
            <div class="mt-3 text-center">
                <div
                    class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-yellow-100 dark:bg-yellow-900">
                    <svg class="h-6 w-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.856-.833-2.546 0L3.268 16.5C2.498 18.333 3.46 20 5 20z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">Restore Backup</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Are you sure you want to restore this backup? This action will overwrite current data and cannot
                        be undone.
                    </p>
                    <div class="mt-4">
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Backup: <span
                                id="restore-backup-name"></span></p>
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Type: <span
                                id="restore-backup-type"></span></p>
                    </div>
                </div>
                <div class="items-center px-4 py-3">
                    <button id="confirm-restore"
                        class="px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-300">
                        Restore Backup
                    </button>
                    <button onclick="closeRestoreModal()"
                        class="mt-3 px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-gray-200 text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-400 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-300">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        let currentBackupFile = '';
let currentBackupType = '';

function showAlert(message, type = 'success') {
    const alertContainer = document.getElementById('alert-container');
    const alertMessage = document.getElementById('alert-message');
    
    alertContainer.className = 'mb-6';
    alertMessage.className = `p-4 rounded-lg ${type === 'success' ? 'bg-green-100 text-green-700 border border-green-300' : 'bg-red-100 text-red-700 border border-red-300'}`;
    alertMessage.textContent = message;
    
    setTimeout(() => {
        alertContainer.classList.add('hidden');
    }, 5000);
}

function showProgress(text) {
    const progressContainer = document.getElementById('progress-container');
    const progressText = document.getElementById('progress-text');
    const progressBar = document.getElementById('progress-bar');
    const progressPercentage = document.getElementById('progress-percentage');
    
    progressContainer.classList.remove('hidden');
    progressText.textContent = text;
    
    let progress = 0;
    const interval = setInterval(() => {
        progress += Math.random() * 15;
        if (progress > 90) progress = 90;
        
        progressBar.style.width = progress + '%';
        progressPercentage.textContent = Math.round(progress) + '%';
    }, 200);
    
    return interval;
}

function hideProgress(interval) {
    clearInterval(interval);
    document.getElementById('progress-container').classList.add('hidden');
}

function createBackup(type) {
    const buttons = document.querySelectorAll('.backup-btn');
    buttons.forEach(btn => btn.disabled = true);
    
    const progressInterval = showProgress(`Creating ${type} backup...`);
    
    fetch(`{{ route('backuprestore.backup.full') }}`.replace('full', type), {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        hideProgress(progressInterval);
        buttons.forEach(btn => btn.disabled = false);
        
        if (data.success) {
            showAlert(data.message, 'success');
            setTimeout(() => location.reload(), 2000);
        } else {
            showAlert(data.message, 'error');
        }
    })
    .catch(error => {
        hideProgress(progressInterval);
        buttons.forEach(btn => btn.disabled = false);
        showAlert('An error occurred while creating backup', 'error');
        console.error('Error:', error);
    });
}

function downloadBackup(filename) {
    window.location.href = `{{ route('backuprestore.backup.download') }}?file=${encodeURIComponent(filename)}`;
}

function showRestoreModal(filename, type) {
    currentBackupFile = filename;
    currentBackupType = type;
    
    document.getElementById('restore-backup-name').textContent = filename;
    document.getElementById('restore-backup-type').textContent = type;
    document.getElementById('restore-modal').classList.remove('hidden');
}

function closeRestoreModal() {
    document.getElementById('restore-modal').classList.add('hidden');
}

function deleteBackup(filename) {
    if (!confirm('Are you sure you want to delete this backup? This action cannot be undone.')) {
        return;
    }
    
    fetch('{{ route("backuprestore.backup.delete") }}', {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ backup_file: filename })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showAlert(data.message, 'success');
            setTimeout(() => location.reload(), 1000);
        } else {
            showAlert(data.message, 'error');
        }
    })
    .catch(error => {
        showAlert('An error occurred while deleting backup', 'error');
        console.error('Error:', error);
    });
}

document.getElementById('confirm-restore').addEventListener('click', function() {
    closeRestoreModal();
    
    const progressInterval = showProgress(`Restoring ${currentBackupType} backup...`);
    
    fetch('{{ route("backuprestore.restore") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            backup_file: currentBackupFile,
            restore_type: currentBackupType
        })
    })
    .then(response => response.json())
    .then(data => {
        hideProgress(progressInterval);
        
        if (data.success) {
            showAlert(data.message, 'success');
        } else {
            showAlert(data.message, 'error');
        }
    })
    .catch(error => {
        hideProgress(progressInterval);
        showAlert('An error occurred during restore', 'error');
        console.error('Error:', error);
    });
});
    </script>
