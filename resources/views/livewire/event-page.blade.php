<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Applicants
    </h2>
</x-slot>

<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

        <div class="flex justify-between">
            <div class="lg:w-1/3 h-10 md:w-1/2 sm:w-full">
                <x-jet-input wire:model="search" class="h-full w-full px-6" placeholder="Search events by applicant name..."></x-jet-input>
            </div>
        </div>
        
    
        {{-- table body --}}
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr class="h-14 text-center">
                        <x-table.heading multi-column >Name</x-table.heading>
                        <x-table.heading multi-column>Status</x-table.heading>
                        <x-table.heading multi-column>Time</x-table.heading>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 text-center">
                    @forelse ($events as $event)
                    <tr wire:key="row-{{ $event->id }}">

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex flex-col">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $event->first }} {{ $event->last }}
                                </div>      
                            </div>
                        </td>

                        
                        @switch($event->type['type'])
                            @case('created')
                                @php($color = 'indigo')
                                @break
                            @case('notified')
                                @php($color = 'yellow')
                                @break
                            @case('in progress')
                                @php($color = 'green')
                                @break
                            @case('complete')
                                @php($color = 'gray')
                                @break
                        @endswitch
                        

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="capitalize px-3 inline-flex text-sm leading-5 font-semibold rounded-full bg-{{ $color }}-100 text-{{ $color }}-800">
                                {{ $event->type['type'] }}
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex flex-col">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $event->created_at }}
                                </div>      
                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <div class="text-sm text-gray-900">No events</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div>
            {{ $events->links() }}
        </div>

    </div>
</div>

