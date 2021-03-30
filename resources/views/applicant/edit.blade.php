<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Applicant
        </h2>
    </x-slot>

    <div x-data="{ show : false, counts : {{ $applicant->guardians->count() }} > 0 ? {{ $applicant->guardians->count() }} : 0 }" 
        x-init="new Pikaday({ field: $refs.input, format: 'll' })" 
        class="py-12"
    >

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">

            {{-- Applicant Info Block --}}
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{ route('applicant.update', $applicant) }}" method="POST">
                    @method('PUT')
                    @csrf
                    
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">

                            <h2 class="mb-5 text-lg font-medium">Applicant Information</h2>

                            <div class="grid grid-cols-4 gap-6">

                                <div class="col-span-4 sm:col-span-2">
                                    <label for="first" class="block text-sm font-medium text-gray-700">First name</label>
                                    <input type="text" name="first" value="{{ $applicant->first }}" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <x-jet-input-error for="first" class="mt-2" />
                                </div>

                                <div class="col-span-4 sm:col-span-2">
                                    <label for="last" class="block text-sm font-medium text-gray-700">Last name</label>
                                    <input type="text" name="last" value="{{ $applicant->last }}" autocomplete="family-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <x-jet-input-error for="last" class="mt-2" />
                                </div>

                                <div class="col-span-4 sm:col-span-2">
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                                    <input type="text" name="email" value="{{ $applicant->email }}" autocomplete="email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <x-jet-input-error for="email" class="mt-2" />
                                </div>

                                <div class="col-span-4 sm:col-span-2">
                                    <label for="applicant_type" class="block text-sm font-medium text-gray-700">Applicant type</label>
                                    <select name="applicant_type" value="{{ $applicant->type['id'] }}" autocomplete="applicant_type" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        <option value="-1">Select applicant type...</option>
                                        @foreach ($applicantTypes as $applicantType)
                                            <option @if ($applicant->type['id'] == $applicantType['id']) selected="selected" @endif value="{{ $applicantType['id'] }}">{{ $applicantType['type'] }}</option>
                                        @endforeach
                                    </select>
                                    <x-jet-input-error for="applicant_type" class="mt-2" />
                                </div>

                                <div class="col-span-4 sm:col-span-2">
                                    <label for="dob" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                                    <input x-ref="input" type="text" name="dob" value="{{ $applicant->dob->format('F j, Y') }}" placeholder="YYYY-MM-DD" autocomplete="family-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <x-jet-input-error for="dob" class="mt-2" />
                                </div>

                                <div class="col-span-4 sm:col-span-2">
                                    <label for="applicant_id" class="block text-sm font-medium text-gray-700">Applicant ID <span class="text-gray-400">(optional)</span></label>
                                    <input type="text" name="applicant_id" value="{{ $applicant->applicant_id }}" autocomplete="family-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <x-jet-input-error for="applicant_id" class="mt-2" />
                                </div>

                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-500 hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Update Applicant
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            {{-- End Applicant Info Block --}}

            {{-- Guardian Info Block from database --}}
            @forelse($applicant->guardians as $guardian)
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{ route('applicant.guardian.store', $guardian) }}" method="POST">
                @csrf
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">

                            <h2 class="mb-5 text-lg font-medium">Guardian Information {{ $loop->index + 1 }}</h2>

                            <div class="grid grid-cols-4 gap-6">

                                <div class="col-span-4 sm:col-span-2">
                                    <label for="first" class="block text-sm font-medium text-gray-700">First name</label>
                                    <input type="text" name="first" value="{{ $guardian->first }}" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <x-jet-input-error for="first" class="mt-2" />
                                </div>

                                <div class="col-span-4 sm:col-span-2">
                                    <label for="last" class="block text-sm font-medium text-gray-700">Last name</label>
                                    <input type="text" name="last" value="{{ $guardian->last }}" autocomplete="family-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <x-jet-input-error for="last" class="mt-2" />
                                </div>

                                <div class="col-span-4 sm:col-span-2">
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                                    <input type="text" name="email" value="{{ $guardian->email }}" autocomplete="email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <x-jet-input-error for="email" class="mt-2" />
                                </div>

                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-500 hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Update Guardian
                            </button>
                        </div>
                    </div>
                </form>
                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 bg-red-100">
                    <form action="{{ route('applicant.guardian.destroy', [$applicant, $guardian]) }}" method="POST">
                    @method('DELETE')
                    @csrf
                        <button type="submit" onClick="return confirm('Are you sure to delete this applicant?')" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Delete Guardian
                        </button>
                    </form>
                </div>
                
            </div>
            @empty
            @php($message = "This applicant currently has no guardians.")
            @endforelse
            {{-- End Guardian Info Block from database --}}

            {{-- New Guardian Info Block --}}
            <div x-show="show" class="space-y-12">
                <template x-if="counts != {{ $applicant->guardians->count() }}" 
                    x-for="i in (counts - {{ $applicant->guardians->count() }})"
                    class="bg-white overflow-hidden shadow-xl sm:rounded-lg"
                >
                    <form action="{{ route('applicant.guardian.store', $applicant) }}" method="POST">
                    @csrf
                
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">

                                <h2 class="mb-5 text-lg font-medium">Guardian Information <span x-text="i + {{ $applicant->guardians->count() }}"></span></h2> 

                                <div class="grid grid-cols-4 gap-6">

                                    <div class="col-span-4 sm:col-span-2">
                                        <label for="first" class="block text-sm font-medium text-gray-700">First name</label>
                                        <input type="text" name="first" value="{{ old('first') }}" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        <x-jet-input-error for="first" class="mt-2" />
                                    </div>

                                    <div class="col-span-4 sm:col-span-2">
                                        <label for="last" class="block text-sm font-medium text-gray-700">Last name</label>
                                        <input type="text" name="last" value="{{ old('last') }}" autocomplete="family-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        <x-jet-input-error for="last" class="mt-2" />
                                    </div>

                                    <div class="col-span-4 sm:col-span-2">
                                        <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                                        <input type="text" name="email" value="{{ old('email') }}" autocomplete="email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        <x-jet-input-error for="email" class="mt-2" />
                                    </div>

                                </div>
                            </div>
                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 space-x-3">
                                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-500 hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Update Guardian
                                </button>
                            </div>
                        </div>
                    </form>
                </template>
            </div>
            {{-- End New Guardian Info Block --}}

            
            {{-- Add Guardian Button --}}
            <div x-show="!(counts > 1)" 
                class="text-center space-y-3">
                    <p x-show="counts == 0" class="text-gray-500">
                        {{ $message ?? '' }}
                    </p>  
                <button x-on:click="show = true, counts > 1 ? 'counts = 1' : counts++" 
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-500 hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Add New Guardian
                </button>
            </div>
            {{-- End Add Guardian Button --}}
            

        </div>
    </div>
</x-app-layout>
