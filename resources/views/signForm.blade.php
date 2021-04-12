<x-guest-layout>

    <div class="lg:p-12 md:p-8 sm:p-4 bg-gray-200">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 sm:px-2 h-full">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex justify-center">
                <div class="wrapper lg:w-2/3 sm:w-full p-4 grid grid-row-1">
                    <form method="POST" action="{{ route('form.submit') }}">
                    @csrf
                        <div class="terms-and-conditions overflow-y-scroll my-8 space-y-3">

                            <img src="{{ url('./img/HEO-Medium.png') }}" alt="logo">

                            <h2 class="text-3xl font-bold text-center p-6">HEO Rowan's Law Acknowledgment Form</h2>

                            <h4 class='font-bold text-red-500'>PLEASE NOTE ALL NMHA MEMBERS MUST FILL OUT THIS FORM BEFORE THEY CAN GO ON THE ICE. FAILURE TO DO SO, WILL RESULT IN NON-PARTICIPATION.</h4>

                            <div class="w-2/3 pt-5 flex flex-wrap">
                                <div class='flex w-1/2 mb-2'>
                                    <p class="font-bold">First name:</p>
                                    <p class="px-6">asfda</p>
                                </div>
                                <div class='flex w-1/2 mb-2'>
                                    <p class="font-bold">Last name:</p>
                                    <p class="px-6">asfda</p>
                                </div>
                                <div class='flex w-1/2 mb-2'>
                                    <p class="font-bold">Date of birth:</p>
                                    <p class="px-6">asfda</p>
                                </div>
                                <div class='flex w-1/2 mb-2'>
                                    <p class="font-bold">Email:</p>
                                    <p class="px-6">asfda</p>
                                </div>
                                <div class='flex w-1/2 mb-2'>
                                    <p class="font-bold">Role:</p>
                                    <p class="px-6">player/coach/trainer/official</p>
                                </div>
                            </div>
                            

                            <p class='pt-5'>
                            The Ontario Government has enacted Rowan’s Law (Concussion Safety), 2018, S.O. 2018, c. 1
                            (“Act”). Ontario Regulation 161/19, the Act requires all sport organizations as defined in the
                            Regulation (“Sports Organization”), which includes Hockey Eastern Ontario (“HEO”), to have a
                            Concussion Code of Conduct. This Concussion Code of Conduct must require participants, as
                            set out in the Act, to review the Ontario Government’s issued Concussion Awareness Resources
                            on an annual basis. A participant is subject to a Concussion Code of Conduct for each Sports
                            Organization a participant registers with.
                            </p>

                            <p class='pt-5'>
                            The Concussion Code of Conduct and the appropriate Concussion Awareness Resources
                            must be reviewed before you can register/participate in HEO.
                            </p>

                            <ul class="list-disc list-inside">
                                <li class="text-indigo-700 underline hover:text-indigo-500">
                                    <a href="https://www.ontario.ca/page/ontario-government-concussion-awareness-resource-e-booklet-ages-10-and-under">10 and Under Concussion Awareness Resource
                                    </a>
                                </li>
                                <li class="text-indigo-700 underline hover:text-indigo-500">
                                    <a href="https://www.ontario.ca/page/ontario-government-concussion-awareness-resource-e-booklet-ages-11-14">
                                        11-14 Concussion Awareness Resource
                                    </a>
                                </li>
                                <li class="text-indigo-700 underline hover:text-indigo-500">
                                    <a href="https://www.ontario.ca/page/ontario-government-concussion-awareness-resource-e-booklet-ages-15-and-up">
                                        15 and Over Concussion Awareness Resource
                                    </a>
                                </li>
                            </ul>
    
                            <p class='pt-5 pb-5 font-bold'><span class="text-red-500">*</span>
                            I confirm that I have reviewed the Rowan's Law of Concussion Code of Conduct and the appropriate Concussion Awareness Resources and commit to operating within the parameters 
                            of the Rowan's Law of Concussion Code of Conduct under the role which I have registered with the HEO.
                            </p>

                            <div class="card-body">
                                @if ($message = Session::get('success'))
                                    <div class="alert alert-success  alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert">×</button>  
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @endif
                                
                                    <div>
                                        <label class="font-bold">Sign here:</label>
                                        <br/>
                                        <div id="sig" class="w-full h-44"></div>
                                        <br/>
                                        <button id="clear" class="text-gray-500 hover:text-gray-400">Clear Signature</button>
                                        <textarea id="signature64" name="signed" style="display: none"></textarea>
                                    </div>

                            </div>
                            @error('signed')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror

                        </div>

                        <button type="submit" class="w-full mb-6 bg-indigo-500 text-white py-2 text-2xl rounded-lg transition duration-200 hover:bg-indigo-400">Submit</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    @section('page-script')
    <script>
        var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});
        $('#clear').click(function(e) {
            e.preventDefault();
            sig.signature('clear');
            $("#signature64").val('');
        });
    </script>
    @endsection

</x-guest-layout>