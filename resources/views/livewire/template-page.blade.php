    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Email Templates') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex justify-center p-4">

                <div class="grid lg:grid-cols-5 lg:gap-5 md:grid-cols-3 sm:grid-cols-2">

                    {{-- create new modal --}}
                    <x-jet-dialog-modal wire:model="showModal">
                        <x-slot name="title">Create new template</x-slot>
                        <x-slot name="content">
   
                            <div class="flex space-x-4 mb-4">
                                <label for="title" class="w-1/6">Title</label>
                                <div class="w-full">
                                    <input wire:model="title" type="text" class="w-full border-gray-300 rounded">
                                    @error('title') <span class="error text-red-500 m-0 p-0">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            
                            
                            <div class="flex space-x-4">
                                <label for="content" class="w-1/6">Content</label>
                                <div class="w-full">
                                    <textarea wire:model="content" type="text" rows="10" class="w-full border-gray-300 rounded resize-none"></textarea>
                                    @error('content') <span class="error text-red-500 m-0 p-0">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            
                        </x-slot>
                        
                        <x-slot name="footer">
                            @if ($template_id)
                            <button wire:click="delete({{ $template_id }})"
                            class="ml-4 px-6 py-2 bg-red-500 text-white rounded-lg shadow-md hover:bg-red-400 transition duration-300">Delete</button>
                            @endif

                            <button wire:click="store"
                            class="ml-4 px-6 py-2 bg-indigo-500 text-white rounded-lg shadow-md hover:bg-indigo-400 transition duration-300">Save</button>
                        </x-slot>
                    </x-jet-dialog-modal>
                    {{-- end modal --}}

                    <div class="col-span-5 flex justify-center m-10">
                        <button wire:click="create" 
                        class="px-8 py-4 bg-indigo-500 text-white text-lg rounded-lg shadow-md hover:bg-indigo-400 transition duration-300">Create New</button>
                    </div>

                    @forelse ($templates as $template)
                    <button wire:click="edit({{ $template->id }})" >
                        <div class="h-72 w-56 bg-gray-100 rounded-sm shadow-md p-6 text-center flex flex-col justify-center align-center hover:bg-indigo-100 transition duration-300">
                            <div class="h-4/5 overflow-hidden">
                                <h2 class="text-lg font-extrabold mb-4 text-gray-600">{{ $template->title }}</h2>
                                <p class="text-gray-500">{{ $template->body }}</p>
                            </div>
                        </div>
                    </button>   
                    @empty
                        <p class="col-span-5 text-center text-gray-400">No templates available.</p>
                    @endforelse

    
                </div>
                



            </div>
        </div>
    </div>
