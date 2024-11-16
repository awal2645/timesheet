<div>
    <div class="container mx-auto px-5 my-8 justify-center text-center">
        <div class="flex justify-center">
            <div class="mb-4 text-center">
                <button wire:click="loadPreviousWeek" class="btn-purple-500">Previous Week</button>
                <button wire:click="loadNextWeek" class="btn-purple-500">Next Week</button>
            </div>
        </div>
        <div class="flex justify-center">
            <form wire:submit.prevent="saveTimesheet"
                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @php
                    $startDate = now()->startOfWeek(Carbon\Carbon::SUNDAY);
                @endphp
                @foreach ($days as $day)
                    <div class="mb-4 p-4 bg-white rounded-md shadow-md">
                        <label for="{{ $day }}"
                            class="block text-sm font-medium text-gray-700">{{ $day }}</label>
                        <div class="flex mt-2">
                            <input type="number" id="{{ $day }}" wire:model="hours.{{ $day }}"
                                class="input-field" placeholder="Enter hours">
                        </div>
                        <div class="flex mt-2">
                            <input class="hidden" disabled name="dates[]" wire:model="dates.{{ $day }}"
                                value="{{ $startDate->format('m-d-y') }}">
                        </div>
                    </div>
                    @php
                        $startDate->addDay(); // Increment the date by one day
                    @endphp<div class="container mx-auto px-5 my-8 justify-cente text-center">
                        <div class="flex justify-center">
                            <div class="mb-4 text-center">
                                <button wire:click="loadPreviousWeek" class="btn-purple-500">Previous Week</button>
                                <button wire:click="loadNextWeek" class="btn-purple-500">Next Week</button>
                            </div>
                        </div>

                        <div class="flex justify-center">
                            <form wire:submit.prevent="saveTimesheet"
                                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                                @php
                                    $startDate = now()->startOfWeek(Carbon\Carbon::SUNDAY);
                                @endphp
                                @foreach ($days as $day)
                                    <div class="mb-4 p-4 bg-white rounded-md shadow-md">
                                        <label for="{{ $day }}"
                                            class="block text-sm font-medium text-gray-700">{{ $day }}</label>
                                        <div class=" d-block mt-2">
                                            <input type="number" id="{{ $day }}"
                                                wire:model="hours.{{ $day }}" class="input-field"
                                                placeholder="Enter hours">
                                            <input disabled name="dates[]" wire:model="dates.{{ $day }}"
                                                value="{{ $startDate->format('m-d-y') }}">
                                        </div>
                                    </div>
                                    @php
                                        $startDate->addDay(); // Increment the date by one day
                                    @endphp
                                @endforeach

                                <div class="mt-4 text-center col-span-full">
                                    <button type="submit" class="btn-purple-500">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach

                <div class="mt-4 text-center col-span-full">
                    <button type="submit" class="btn-purple-500">Save</button>
                </div>
            </form>
        </div>SearchCountry
    </div>


</div>
