<div>

    <button wire:click="$toggle('showModal')"
        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
        Import CSV  
    </button>

    <form wire:submit.prevent="import">
        <x-jet-dialog-modal wire:model="showModal">
            <x-slot name="title">Import Applicants</x-slot>

            <x-slot name="content">
                @unless ($upload)
                <div class="py-12 flex flex-col items-center justify-center ">
                    <div class="flex items-center space-x-2 text-xl">

                        <div class="flex w-full items-center justify-center bg-grey-lighter">
                            <label class="w-64 flex flex-col items-center px-4 py-6 bg-white text-indigo-500 rounded-lg shadow-lg tracking-wide uppercase border border-indigo-500 cursor-pointer hover:bg-indigo-500 hover:text-white">
                                <svg class="w-8 h-8 text-gray-200" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                                </svg>
                                <span class="mt-2 text-base leading-normal">Select a file</span>
                                <input wire:model="upload" type='file' class="hidden" />
                            </label>
                        </div>

                    </div>
                    @error('upload') <div class="mt-3 text-red-500 text-sm">{{ $message }}</div> @enderror
                </div>
                @else
                <div class="space-y-4">

                    <x-jet-validation-errors>
                        @error('fieldColumnMap.first')
                        {{ $message }}
                        @enderror
                    </x-jet-validation-errors>

                    <div>
                        <div class="text-gray-400">Applicant information</div>
                        <hr>
                    </div>
                    
                    <div class="flex items-center space-x-2">
                        <label for="first" class="w-1/4 text-sm font-medium text-gray-700">First name</label>
                        <select name="first" wire:model="fieldColumnMap.first" class="w-3/4 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Select column...</option>
                            @foreach ($columns as $column)
                                <option>{{ $column }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-center space-x-2">
                        <label for="last" class="w-1/4 text-sm font-medium text-gray-700">Last name</label>
                        <select name="last" wire:model="fieldColumnMap.last" class="w-3/4 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Select column...</option>
                            @foreach ($columns as $column)
                                <option>{{ $column }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-center space-x-2">
                        <label for="email" class="w-1/4 text-sm font-medium text-gray-700">Email</label>
                        <select name="email" wire:model="fieldColumnMap.email" class="w-3/4 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Select column...</option>
                            @foreach ($columns as $column)
                                <option>{{ $column }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-center space-x-2">
                        <label for="dob" class="w-1/4 text-sm font-medium text-gray-700">Date of birth</label>
                        <select name="dob" wire:model="fieldColumnMap.dob" class="w-3/4 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Select column...</option>
                            @foreach ($columns as $column)
                                <option>{{ $column }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-center space-x-2">
                        <label for="applicant_type" class="w-1/4 text-sm font-medium text-gray-700">Applicant type</label>
                        <select name="applicant_type" wire:model="fieldColumnMap.applicant_type" class="w-3/4 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Select column...</option>
                            @foreach ($columns as $column)
                                <option>{{ $column }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-center space-x-2">
                        <label for="applicant_id" class="w-1/4 text-sm font-medium text-gray-700">Applicant Id</label>
                        <select name="applicant_id" wire:model="fieldColumnMap.applicant_id" class="w-3/4 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Select column...</option>
                            @foreach ($columns as $column)
                                <option>{{ $column }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-2">
                        <div class="text-gray-400">Guardian 1 information</div>
                        <hr>
                    </div>

                    <div class="flex items-center space-x-2">
                        <label for="guardian1_first" class="w-1/4 text-sm font-medium text-gray-700">First name</label>
                        <select name="guardian1_first" wire:model="fieldColumnMap.guardian1_first" class="w-3/4 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Select column...</option>
                            @foreach ($columns as $column)
                                <option>{{ $column }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-center space-x-2">
                        <label for="guardian1_last" class="w-1/4 text-sm font-medium text-gray-700">Last name</label>
                        <select name="guardian1_last" wire:model="fieldColumnMap.guardian1_last" class="w-3/4 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Select column...</option>
                            @foreach ($columns as $column)
                                <option>{{ $column }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-center space-x-2">
                        <label for="guardian1_email" class="w-1/4 text-sm font-medium text-gray-700">Email</label>
                        <select name="guardian1_email" wire:model="fieldColumnMap.guardian1_email" class="w-3/4 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Select column...</option>
                            @foreach ($columns as $column)
                                <option>{{ $column }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-2">
                        <div class="text-gray-400">Guardian 2 information</div>
                        <hr>
                    </div>

                    <div class="flex items-center space-x-2">
                        <label for="guardian2_first" class="w-1/4 text-sm font-medium text-gray-700">First name</label>
                        <select name="guardian2_first" wire:model="fieldColumnMap.guardian2_first" class="w-3/4 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Select column...</option>
                            @foreach ($columns as $column)
                                <option>{{ $column }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-center space-x-2">
                        <label for="guardian2_last" class="w-1/4 text-sm font-medium text-gray-700">Last name</label>
                        <select name="guardian2_last" wire:model="fieldColumnMap.guardian2_last" class="w-3/4 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Select column...</option>
                            @foreach ($columns as $column)
                                <option>{{ $column }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-center space-x-2">
                        <label for="guardian2_email" class="w-1/4 text-sm font-medium text-gray-700">Email</label>
                        <select name="guardian2_email" wire:model="fieldColumnMap.guardian2_email" class="w-3/4 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Select column...</option>
                            @foreach ($columns as $column)
                                <option>{{ $column }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                </div>
                @endif
            </x-slot>

            <x-slot name="footer">
                <button wire:click="$set('showModal', false)" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-gray-600 bg-gray-300 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    Cancel
                </button>

                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-500 hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Import
                </button>
            </x-slot>
        </x-jet-dialog-modal>
    </form>

</div>
