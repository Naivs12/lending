@extends('layout.system-admin')
@section('title', 'Client')

@section('content')

    <div class="container mx-auto p-2">
        <!-- Top Section: Profile Picture & Personal Details -->
        <div class="flex">
            <!-- Profile Picture Container -->
            <div class="p-5 flex flex-col items-center justify-center w-1/4">
                <label for="upload_image" class="cursor-pointer">
                    <img id="client_image" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='gray'%3E%3Cpath d='M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm0 4a4 4 0 1 1-4 4 4 4 0 0 1 4-4zm0 14.5a7.47 7.47 0 0 1-6-3c.05-2 4-3.1 6-3.1s5.95 1.1 6 3.1a7.47 7.47 0 0 1-6 3z'/%3E%3C/svg%3E" 
                        alt="Default Profile" class="w-48 h-48 border border-black-700">
                </label>
                <input type="file" id="upload_image" class="hidden" accept="image/*">
            </div>


            <!-- Personal Details Container -->
            <div class="p-5">
                <div class="absolute top-5 right-5 flex space-x-1 p-5">
                    <!-- Edit Button -->
                    <button type="button" id="editClientBtn" class="p-3 text-orange-500 hover:text-orange-700" data-id="{{ $client->id }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M12 20h9M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4 12.5-12.5z" />
                        </svg>
                    </button>
                    <!-- Delete Button -->
                    <button type="button" id="deleteClient" class="p-2 text-red-500 hover:text-red-700" data-id="{{ $client->id }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6h18M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2m5 0v14a2 2 0 01-2 2H6a2 2 0 01-2-2V6h16zM10 11v6m4-6v6" />
                        </svg>
                    </button>
                </div>

                <p class="font-bold text-2xl mb-2" data-name="{{ $client->name }}">{{ $client->name }}</p>

                <p class="flex items-center text-gray-700 text-sm mb-2" data-soc="{{ $client->soc_med }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600 mr-2" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M22 12a10 10 0 1 0-11.5 9.9v-7h-2.6V12h2.6V9.4c0-2.6 1.6-4 3.9-4 1.1 0 2 .1 2.3.1v2.7H15.9c-1.3 0-1.6.6-1.6 1.5V12h3.1l-.5 2.9H14.3v7A10 10 0 0 0 22 12z"/>
                    </svg>
                    {{ $client->soc_med }}
                </p>

                <p class="flex items-center text-gray-700 text-sm mb-2" data-address=" {{ $client->address }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500 mr-2" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M12 2C8.13 2 5 5.13 5 9c0 4.42 7 11 7 11s7-6.58 7-11c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5s2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" clip-rule="evenodd"/>
                    </svg>  
                    {{ $client->address }}
                </p>

                <p class="flex items-center text-gray-700 text-sm mb-2" data-contact_num=" {{ $client->contact_number }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500 mr-2" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M6.62 10.79a15.91 15.91 0 006.59 6.59l2.2-2.2a1.5 1.5 0 011.6-.34 10.35 10.35 0 003.79.72 1.5 1.5 0 011.5 1.5v3.25a1.5 1.5 0 01-1.5 1.5A19.26 19.26 0 013 4.5 1.5 1.5 0 014.5 3h3.25a1.5 1.5 0 011.5 1.5c0 1.33.25 2.61.72 3.79a1.5 1.5 0 01-.34 1.6l-2.2 2.2z" clip-rule="evenodd"/>
                    </svg>
                    {{ $client->contact_number }}
                </p>

                <!-- Buttons at the Bottom -->
                <div class="flex mt-5">
                    <!-- <button class="border border-blue-500 text-blue-500 px-3 py-1 rounded-md text-sm hover:bg-blue-500 hover:text-white mr-2">
                        Add Loan
                    </button> -->
                    <button class="border border-green-500 text-green-500 px-3 py-1 rounded-md text-sm hover:bg-green-500 hover:text-white mr-2">
                        Download
                    </button>
                    <button class="border border-red-500 text-red-500 px-3 py-1 rounded-md text-sm hover:bg-red-500 hover:text-white">
                        Blocklist
                    </button>
                </div>

            </div>
        </div>

        <!-- Loan Details Section Side by Side -->
        <div class="flex gap-4 items-stretch min-h-[350px]">
            <div class="w-1/2 ps-5">
                <div class="bg-white p-5 rounded-lg shadow-lg border border-gray-900 h-[370px]">
                    <h3 class="text-lg mb-3 font-bold text-center text-gray-800">ABOUT</h3>
                    <div class="text-sm ms-5">
                        <div class="grid grid-cols-2 gap-1 ms-5">
                            <p class="font-bold text-gray-700">Age:</p> 
                            <p class="text-gray-900"  data-age="{{ $client->age }}">{{ $client->age }}</p>

                            <p class="font-bold text-gray-700">Birthday:</p> 
                            <p class="text-gray-900"  data-birthday="{{ $client->birthday }}">{{ $client->birthday }}</p>

                            <p class="font-bold text-gray-700">Gender:</p> 
                            <p class="text-gray-900"  data-gender="{{ $client->gender }}">{{ $client->gender }}</p>
                        </div>
                    </div>
                    
                    <h3 class="mt-5 mb-2 text-lg font-bold text-center text-gray-800">CONTACT PERSON</h3>
                    <div class="text-sm ms-5">
                        <div class="grid grid-cols-2 gap-1 ms-5">
                            <p class="font-bold text-gray-700">Co-borrower:</p> 
                            <p class="text-gray-900"  data-co_borrower="{{ $client->co_borrower }}">{{ $client->co_borrower }}</p>

                            <p class="font-bold text-gray-700">Relationship:</p> 
                            <p class="text-gray-900"  data-realtionship_co="{{ $client->relationship_co }}">{{ $client->relationship_co }}  </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- L  oan Details Section -->
            <div class="w-1/2 pe-5">
                <div class="bg-white-100 p-5 rounded-lg shadow-lg border border-gray-900 h-[370px]">
                <h3 class="text-lg mb-4 font-bold text-center text-gray-800">LOAN</h3>
                <table class="table-auto border-collapse border border-gray-300 text-sm w-full">
                    <thead>
                        <tr>
                            <th class="border p-2">Loan ID</th>
                            <th class="border p-2">Amount</th>
                            <th class="border p-2">Due Date</th>
                            <th class="border p-2">Term</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
                </div>
            </div>  
        </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    document.getElementById("client_image").addEventListener("click", function() {
        document.getElementById("upload_image").click();
    });

    document.getElementById("upload_image").addEventListener("change", function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById("client_image").src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

</script>
<script>
    $(document).on('click', '#deleteClient', function () {
    let clientId = $(this).data('id');


    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/delete-client/' + clientId, // Adjust this URL based on your route
                type: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content') // CSRF token for security
                },
                success: function (response) {
                    if (response.success) {
                        Swal.fire("Deleted!", response.message, "success").then(() => {
                            window.location.href = '/system-admin/client'; // Reload the page after deleting
                        });
                    } else {
                        Swal.fire("Error", response.message, "error");
                    }
                },
                error: function (xhr) {
                    Swal.fire("Error", xhr.responseJSON.message, "error");
                }
            });
        }
    });
});

</script>
@endsection