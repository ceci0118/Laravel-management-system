<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create New Applicant
        </h2>
    </x-slot>

    <div x-data 
         x-init="new Pikaday({ field: $refs.input, format: 'll' })" 
         class="py-12"
    >
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{ route('applicant.store') }}" method="POST">
                    @csrf
                    
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-4 gap-6">

                                <div class="col-span-4 sm:col-span-2">
                                    <label for="first" class="block text-sm font-medium text-gray-700">First name</label>
                                    <input type="text" name="first" id="first" value="{{ old('first') }}" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <x-jet-input-error for="first" class="mt-2" />
                                </div>

                                <div class="col-span-4 sm:col-span-2">
                                    <label for="last" class="block text-sm font-medium text-gray-700">Last name</label>
                                    <input type="text" name="last" id="last" value="{{ old('last') }}" autocomplete="family-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <x-jet-input-error for="last" class="mt-2" />
                                </div>

                                <div class="col-span-4 sm:col-span-2">
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                                    <input type="text" name="email" id="email" value="{{ old('email') }}" autocomplete="email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <x-jet-input-error for="email" class="mt-2" />
                                </div>

                                <div class="col-span-4 sm:col-span-2">
                                    <label for="applicant_type" class="block text-sm font-medium text-gray-700">Applicant type</label>
                                    <select id="applicant_type" name="applicant_type" value="{{ old('applicant_type') }}" autocomplete="applicant_type" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        <option value="-1">Select applicant type...</option>
                                        @foreach ($applicantTypes as $applicantType)
                                            <option @if (old('applicant_type') == $applicantType['id']) selected="selected" @endif value="{{ $applicantType['id'] }}">{{ $applicantType['type'] }}</option>
                                        @endforeach
                                    </select>
                                    <x-jet-input-error for="applicant_type" class="mt-2" />
                                </div>

                                <div class="col-span-4 sm:col-span-2">
                                    <label for="dob" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                                    <input 
                                        x-ref="input"
                                        wire:model.lazy="dob" 
                                        type="text" 
                                        name="dob" 
                                        value="{{ old('dob') }}" 
                                        placeholder="YYYY-MM-DD" 
                                        autocomplete="off"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    >
                                    <x-jet-input-error for="dob" class="mt-2" />
                                </div>

                                <div class="col-span-4 sm:col-span-2">
                                    <label for="applicant_id" class="block text-sm font-medium text-gray-700">Applicant ID <span class="text-gray-400">(optional)</span></label>
                                    <input type="text" name="applicant_id" id="applicant_id" value="{{ old('applicant_id') }}" autocomplete="family-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <x-jet-input-error for="applicant_id" class="mt-2" />
                                </div>

                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-500 hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Save Applicant
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
