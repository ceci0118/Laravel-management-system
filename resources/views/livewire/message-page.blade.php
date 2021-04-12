<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Email Messages') }}
    </h2>
</x-slot>

<div x-data="{ subject: @entangle('subject').defer, content: @entangle('content').defer }"
    class="h-screen max-w-7xl mx-auto py-8 sm:px-6 lg:px-8">

    <div class="flex space-x-4">
        <div class="w-1/4 text-center">
            <h1 class="w-32 text-lg text-indigo-800 px-2 bg-indigo-200 rounded-t-lg">Templates</h1>
        </div>
        
        <div class="w-3/4 text-center">
            <h1 class="w-32 text-lg text-white px-2 bg-indigo-500 rounded-t-lg">Message</h1>
        </div>
        
    </div>


    <div class="h-3/4 flex justify-between space-x-4">

        <div class="h-full w-1/4 px-4 bg-white rounded-b-lg shadow-md overflow-y-scroll">
            @forelse ($templates as $template)
                <button wire:click="$set('template_id', {{ $template->id }})" 
                    x-on:click="subject = '{{ $template->title }}'; content = '{{ $template->body }}'"
                    class="w-full my-4 bg-white shadow-md h-36 p-4 flex flex-col justify-between shadow-md rounded hover:bg-indigo-200 transition duration-300">
                    <h1 class="text-lg font-bold text-left">{{ $template->title }}</h1>
                    <div class="h-2/3 overflow-hidden text-left">
                        <p>{{ $template->body }}</p>
                    </div>    
                </button>
            @empty
                <div class="h-full w-full flex-col mt-12 text-center">
                    <p>No templates available.</p>
                    <a href="" class="text-indigo-500 underline">Add new template</a>
                </div>
            @endforelse
        </div>

        <div class="h-full w-3/4 m-0">     

            <div class="w-full bg-white p-8 rounded-b-lg shadow-md space-y-4 ">

                <div class="grid grid-cols-12 space-x-4">
                    <label class="text-xl text-gray-600">To:</label>
                    <div class="w-full col-span-10 relative">

                        <input wire:model="to"
                            type="text" name="to" class="w-full border-gray-300 rounded" value="{{ old('to') }}" placeholder="Enter by applicant name. Separate by comma." autocomplete="off">
                        @if (strlen($search) > 1)
                        <div class="absolute w-full">
                            <ul>
                                @forelse ($applicants as $applicant)
                                <li class="w-1/3 bg-white shadow-lg">
                                    <button wire:click="addRecipient({{ $applicant }})" class="w-full p-2 hover:bg-gray-100">
                                        {{ $applicant->full_name }}
                                    </button>      
                                </li>
                                @empty
                                <li class="w-1/3 bg-gray-100 p-2 border border-gray-300">No applicants found</li>
                                @endforelse
                            </ul>
                        </div>
                        @endif
                        
                    </div>
                </div>

                <div class="grid grid-cols-12 space-x-4">
                    <label class="text-xl text-gray-600">Cc:<br><span class="text-sm text-gray-400">(optional)</span></label>
                    <input wire:model="cc" type="text" name="cc" class="w-full border-gray-300 rounded col-span-10" placeholder="Separate by comma." autocomplete="off">
                </div>

                <div class="grid grid-cols-12 space-x-4">
                    <label class="text-xl text-gray-600">Title:</label>
                    <input x-model="subject"  autocomplete="off"
                        type="text" name="subject" class="w-full border-gray-300 rounded col-span-10">
                </div>

                <div class="grid grid-cols-12 space-x-4">

                    <label class="text-xl text-gray-600">URL:<br><span class="text-sm text-gray-400">(optional)</span></label>
                    <input wire:model="url"  autocomplete="off"
                    type="text" class="border-gray-300 rounded col-span-5">

                    <label class="text-xl text-gray-600 col-span-1">Label:<br><span class="text-sm text-gray-400">(optional)</span></label>
                    <input wire:model="btnText"  autocomplete="off"
                    type="text" name="btnText" class="w-full border-gray-300 rounded col-span-4">
                    
                </div>

                <div class="grid grid-cols-12 space-x-4">
                    <label class="text-xl text-gray-600">Content:</label>
                    <textarea x-model="content"
                        type="text" name="content" rows="10" class="w-full border-gray-300 rounded col-span-10 resize-none"></textarea>
                </div>

                <div class="w-1/4 shadow-md mx-auto">
                    <button wire:click="create" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-lg font-medium text-white bg-indigo-500 hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Send Email
                    </button>
                </div>

            </div>

        </div>
    
    </div>

</div>