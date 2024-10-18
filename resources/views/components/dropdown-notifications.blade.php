@props([
    'align' => 'right',
])
<div class="relative inline-flex" x-data="{ open: false }">
    <button
        class="w-8 h-8 flex items-center justify-center bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-600/80 rounded-full"
        :class="{ 'bg-slate-200': open }" aria-haspopup="true" @click.prevent="open = !open" :aria-expanded="open">
        <span class="sr-only">Notifications</span>
        <svg class="w-4 h-4" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
            <path class="fill-current text-slate-500 dark:text-slate-400"
                d="M6.5 0C2.91 0 0 2.462 0 5.5c0 1.075.37 2.074 1 2.922V12l2.699-1.542A7.454 7.454 0 006.5 11c3.59 0 6.5-2.462 6.5-5.5S10.09 0 6.5 0z" />
            <path class="fill-current text-slate-400 dark:text-slate-500"
                d="M16 9.5c0-.987-.429-1.897-1.147-2.639C14.124 10.348 10.66 13 6.5 13c-.103 0-.202-.018-.305-.021C7.231 13.617 8.556 14 10 14c.449 0 .886-.04 1.307-.11L15 16v-4h-.012C15.627 11.285 16 10.425 16 9.5z" />
        </svg>
        <div
            class="absolute top-0 right-0 w-2.5 h-2.5 bg-rose-500 border-2 border-white dark:border-[#182235] rounded-full">
        </div>
    </button>
    <div class="origin-top-right z-10 absolute top-full -mr-48 sm:mr-0 min-w-80 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 py-1.5 rounded shadow-lg overflow-hidden mt-1 {{ $align === 'right' ? 'right-0' : 'left-0' }}"
        @click.outside="open = false" @keydown.escape.window="open = false" x-show="open"
        x-transition:enter="transition ease-out duration-200 transform"
        x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-out duration-200" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" x-cloak>
        <div class="text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase pt-1.5 pb-2 px-4">Notifications
        </div>
        <ul>
            @foreach (notification() as $notification)
                <li class="border-b border-slate-200 dark:border-slate-700 last:border-0">
                    <a class="block py-2 px-4 hover:bg-slate-50 dark:hover:bg-slate-700/20" href="#0"
                        @click="open = false" @focus="open = true" @focusout="open = false">
                        <span class="block text-sm mb-2">📣
                            <span class="font-medium text-slate-800 dark:text-slate-100">
                                {{ $notification->message }}
                            </span>
                        </span>
                        <span class="block text-xs font-medium text-slate-400 dark:text-slate-500">{{$notification->created_at->format('Y-m-d')}}</span>
                    </a>
                </li>
            @endforeach
        </ul>
        <div class="flex justify-center">
            <a href="{{ route('notification.del') }}"
                class="text-slate-600 cursor-pointer hover:text-slate-800 dark:text-slate-300 dark:hover:text-slate-100">Mark
                as Read</a>
        </div>
    </div>
</div>

{{-- <!-- Include jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    // Function to fetch notifications from the server
    function fetchNotifications() {
        $.ajax({
            url: '/notifications',
            method: 'GET',
            dataType: 'json', // Specify the expected data type as JSON
            success: function(response) {
                if (Array.isArray(response.notifications)) { // Check if response.notifications is an array
                    response.notifications.forEach(function(notification) {
                        // Add notification to the interface
                        addNotification(notification.message);
                        // Play notification sound
                        playNotificationSound();
                    });
                } else {
                    console.error('Invalid response format:', response);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching notifications:', error);
            }
        });
    }


    // Function to add a notification to the interface
    function addNotification(message) {
        // Add notification to the interface here (e.g., append to a list)
        // Example:
        $('#notificationList').append('<li>' + message + '</li>');
    }


    function playNotificationSound() {
        var audio = new Audio('notification_sound.mp3'); // Replace with the URL of your online sound file

        // Mute the audio
        audio.muted = true;

        // Attempt to play the audio
        var playPromise = audio.play();

        // If the browser allows autoplay and successfully begins playback, unmute the audio
        if (playPromise !== undefined) {
            playPromise.then(function() {
                // Audio started playing
                // Unmute the audio
                audio.muted = false;
            }).catch(function(error) {
                // Autoplay was prevented
                console.error('Autoplay was prevented:', error);
            });
        }
    }

    // Periodically fetch notifications
    setInterval(fetchNotifications, 5000); // Fetch every 5 seconds
</script> --}}
