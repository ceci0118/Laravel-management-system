<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Applicants
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

        <div class="flex justify-between">
            <div class="w-1/3">
                <x-jet-input wire:model="search" class="h-full w-full px-6" placeholder="Search applicants..."></x-jet-input>
            </div>

            <div class="flex space-x-2">
                <a href="{{ route('applicant.create') }}">
                    <button class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-500 hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Create New   
                    </button>
                </a>  

                @livewire('import-applicant')

                {{-- Bulk Delete Modal --}}
                <x-jet-confirmation-modal wire:model.defer="showDeleteModal">
                    <x-slot name="title">Delete Applicants</x-slot>
                    <x-slot name="content">Are you sure to delete the selected applicants?</x-slot>
                    <x-slot name="footer">
                        <button wire:click="$set('showDeleteModal', false)" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-gray-500 hover:text-white bg-gray-300 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            No, never mind.  
                        </button>
                        <button wire:click="deleteSelected" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Yes, I'm sure!  
                        </button>
                    </x-slot>
                </x-jet-confirmation-modal>
 
                
                
                <button class="w-32 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-500 hover:bg-green-600 focus:outline-none ">
                    {{-- <a href="#">Export CSV</a>   --}}
                    <x-jet-dropdown>
                        <x-slot name="trigger">
                            Bulk action
                            <span class="inline-grid">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                                </svg>
                            </span>
                        </x-slot>
                        <x-slot name="content">
                            <x-jet-dropdown-link wire:click="exportSelected" class="px-8 flex justify-between">
                                Export to csv
                                <span class="inline-grid">
                                    <svg class="w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </x-jet-dropdown-link>
                            <x-jet-dropdown-link wire:click="$toggle('showDeleteModal')" class="px-8 flex justify-between">
                                Delete
                                <span class="inline-grid">
                                    <svg class="w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" >
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </x-jet-dropdown-link>
                        </x-slot>
                    </x-jet-dropdown>   
                </button>
            </div>
        </div>
        
        

        {{-- table body --}}
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr class="h-14">
                        <x-table.heading class="pr-0 w-8">
                            {{-- <x-input.checkbox wire:model="selectPage" /> --}}
                        </x-table.heading>
                        <x-table.heading sortable multi-column wire:click="sortBy('first')" :direction="$sorts['first'] ?? null">Name</x-table.heading>
                        <x-table.heading sortable multi-column wire:click="sortBy('applicant_type')" :direction="$sorts['applicant_type'] ?? null">Type</x-table.heading>
                        <x-table.heading sortable multi-column wire:click="sortBy('email')" :direction="$sorts['email'] ?? null">Email</x-table.heading>
                        <x-table.heading sortable multi-column wire:click="sortBy('applicant_id')" :direction="$sorts['applicant_id'] ?? null" class="w-full">Applicant ID</x-table.heading>
                        <x-table.heading sortable multi-column wire:click="sortBy('dob')" :direction="$sorts['dob'] ?? null">DOB</x-table.heading>
                        <x-table.heading sortable multi-column wire:click="sortBy('status')" :direction="$sorts['status'] ?? null">Status</x-table.heading>

                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Delete</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($applicants as $applicant)
                    <tr wire:key="row-{{ $applicant->id }}">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input wire:model="selected" value="{{ $applicant->id }}" type="checkbox" class="border border-gray-400 rounded">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex flex-col">
                                <div class="text-sm font-medium text-gray-900">
                                {{ $applicant->full_name }}
                                </div>      
                            </div>
                        </td>

                        
                        @switch($applicant->type['type'])
                            @case('player')
                                @php($color = 'gray')
                                @break
                            @case('coach')
                                @php($color = 'purple')
                                @break
                            @case('official')
                                @php($color = 'red')
                                @break
                            @case('trainer')
                                @php($color = 'yellow')
                                @break
                        @endswitch
                        

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="capitalize px-3 inline-flex text-sm leading-5 font-semibold rounded-full bg-{{ $color }}-100 text-{{ $color }}-800">
                                {{ $applicant->type['type'] }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $applicant->email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $applicant->applicant_id }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $applicant->dob->format('F j, Y') }}</div> 
                        </td>

                        @switch($applicant->statusType['type'])
                            @case('created')
                                @php($color = 'gray')
                                @break
                            @case('notified')
                                @php($color = 'yellow')
                                @break
                            @case('in progress')
                                @php($color = 'green')
                                @break
                            @case('complete')
                                @php($color = 'indigo')
                                @break
                        @endswitch

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <span class="capitalize px-3 inline-flex text-sm leading-5 font-semibold rounded-full bg-{{ $color }}-200 text-{{ $color }}-600">
                                {{ $applicant->statusType['type'] }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('applicant.edit', $applicant) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        </td><td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <form action="{{ route('applicant.destroy', $applicant) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" onClick="return confirm('Are you sure to delete this applicant?')" class="text-red-600 hover:text-red-900">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="col-span-8 px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="text-sm text-gray-900">No applicants</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div>
            {{ $applicants->links() }}
        </div>

    </div>
</div>
