@extends('layout.system-admin')
    @section('title', 'Client')

    @section('content')

        <div class="container mx-auto p-5 bg-white relative border border-gray-300 rounded-lg shadow-md mt-3">
            <!-- Top Section: Profile Picture & Personal Details -->
            <div class="flex">
                <!-- Profile Picture Container -->
                <div class=" flex flex-col items-center justify-center w-1/4 relative z-50">
                    <img id="client_image"
                        src="{{ $client->image ?? "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='gray'%3E%3Cpath d='M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm0 4a4 4 0 1 1-4 4 4 4 0 0 1 4-4zm0 14.5a7.47 7.47 0 0 1-6-3c.05-2 4-3.1 6-3.1s5.95 1.1 6 3.1a7.47 7.47 0 0 1-6 3z'/%3E%3C/svg%3E" }}"
                        alt="Client Image"
                        class="w-48 h-48 border border-black-700 cursor-pointer"
                    >

                    <input type="file" id="upload_image" accept="image/*" style="display: none">

                    {{-- <button class="bg-cyan-500 w-full mt-2" id="upload_image_btn">UPLOAD</button> --}}
                </div>

                    <!-- Personal Details -->
                    <div class="flex-1 relative">
                        <div class="absolute top-0 right-0 flex space-x-2">
                            <!-- Edit Button -->
                            <button type="button" class="editClientBtn p-2 text-orange-500 hover:text-orange-700" 
                                data-id="{{ $client->id }}"
                                data-first_name="{{ $client->first_name }}"
                                data-middle_name="{{ $client->middle_name }}"
                                data-last_name="{{ $client->last_name }}"
                                data-address="{{ $client->address }}" 
                                data-soc="{{ $client->soc_med }}"
                                data-contact_num="{{ $client->contact_number }}"
                                data-age="{{ $client->age }}"
                                data-birthday="{{ $client->birthday }}"
                                data-gender="{{ $client->gender }}"
                                data-co_borrower="{{ $client->co_borrower }}"
                                data-relationship_co="{{ $client->relationship_co }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20h9M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4 12.5-12.5z" />
                                </svg>
                            </button>

                            <!-- Delete Button -->
                            <button type="button" id="deleteClient" class="p-2 text-red-500 hover:text-red-700" data-id="{{ $client->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6h18M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2m5 0v14a2 2 0 01-2 2H6a2 2 0 01-2-2V6h16zM10 11v6m4-6v6" />
                                </svg>
                            </button>
                        </div>
                        <p class="uppercase font-bold text-3xl text-gray-900 mb-2">{{ $client->first_name }} {{ $client->middle_name }} {{ $client->last_name }}</p>
                        <p class="flex items-center text-gray-700 text-sm mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500 mr-2" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd" d="M12 2C8.13 2 5 5.13 5 9c0 4.42 7 11 7 11s7-6.58 7-11c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5s2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" clip-rule="evenodd"/>
                            </svg>
                            {{ $client->address }}
                        </p>

                        <p class="flex items-center text-gray-700 text-sm mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500 mr-2" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd" d="M6.62 10.79a15.91 15.91 0 006.59 6.59l2.2-2.2a1.5 1.5 0 011.6-.34 10.35 10.35 0 003.79.72 1.5 1.5 0 011.5 1.5v3.25a1.5 1.5 0 01-1.5 1.5A19.26 19.26 0 013 4.5 1.5 1.5 0 014.5 3h3.25a1.5 1.5 0 011.5 1.5c0 1.33.25 2.61.72 3.79a1.5 1.5 0 01-.34 1.6l-2.2 2.2z" clip-rule="evenodd"/>
                            </svg>
                            {{ $client->contact_number }}
                        </p>

                        <p class="flex items-center text-gray-700 text-sm mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600 mr-2" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M22 12a10 10 0 1 0-11.5 9.9v-7h-2.6V12h2.6V9.4c0-2.6 1.6-4 3.9-4 1.1 0 2 .1 2.3.1v2.7H15.9c-1.3 0-1.6.6-1.6 1.5V12h3.1l-.5 2.9H14.3v7A10 10 0 0 0 22 12z"/>
                            </svg>
                            <a href="{{ $client->soc_med }}" class="hover:text-blue-700">{{ $client->soc_med }}</a>
                        </p>

                        <!-- Buttons Section -->
                        <div class="flex gap-2 mt-5">
                            <!-- Download Button -->
                            <button class="border border-green-500 text-green-500 px-3 py-1 rounded-md text-sm hover:bg-green-500 hover:text-white">
                                Download
                            </button>

                            <!-- Blocklist Button -->
                            <button class="border border-red-500 text-red-500 px-3 py-1 rounded-md text-sm hover:bg-red-500 hover:text-white">
                                Blocklist
                            </button>
                        </div>
                    </div>
                    
                </div>
                

                <!-- Bottom Section: About and Transaction Details -->
                <div class="flex gap-4 mt-5">
                    <!-- About Section -->
                    <div class="w-1/4">
                        <div class="p-3">
                            <h3 class="text-lg m-2 font-bold text-center text-gray-800">ABOUT</h3>
                            <div class="text-sm p-3">
                                <div class="grid grid-cols-2 gap-x-2 gap-y-5">
                                    <p class="font-bold text-gray-700">Age:</p> 
                                    <p class="text-gray-900">{{ $client->age }}</p>

                                    <p class="font-bold text-gray-700">Birthday:</p> 
                                    <p class="text-gray-900">{{ $client->birthday }}</p>

                                    <p class="font-bold text-gray-700">Gender:</p> 
                                    <p class="text-gray-900">{{ $client->gender }}</p>

                                    <p class="font-bold text-gray-700">Co-borrower:</p> 
                                    <p class="text-gray-900">{{ $client->co_borrower }}</p>

                                    <p class="font-bold text-gray-700">Relationship:</p> 
                                    <p class="text-gray-900">{{ $client->relationship_co }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Transaction Details Section -->
                    <div class="w-3/4">
                        <div class="p-3">
                            <h3 class="text-lg font-bold text-center mb-2 text-gray-800">LOANS</h3>
                            <!-- Loan Table -->
                            <div id="loanContent">
                                <table class="w-full border border-gray-300 text-center">
                                    <thead class="bg-[#028051] text-xs text-white">
                                        <tr>
                                            <th class="border p-2">Loan ID</th>
                                            <th class="border p-2">Amount</th>
                                            <th class="border p-2">Due Date</th>
                                            <th class="border p-2">Term</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Loan data here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @include('components.edit_client_modal')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
    $(document).ready(function() {
        $('.editClientBtn').on('click', function() {
            let client_Id = $(this).data('id');
            let firstName = $(this).data('first_name'); // Add this if needed
            let middleName = $(this).data('middle_name'); // Add this if needed
            let lastName = $(this).data('last_name'); // Add this if needed
            let address = $(this).data('address');
            let contact_num = $(this).data('contact_num');
            let age = $(this).data('age');
            let birthday = $(this).data('birthday');
            let soc = $(this).data('soc');
            let co_borrow = $(this).data('co_borrower');
            let relationship = $(this).data('relationship_co');

            // Fill modal inputs
            $('#editClientId').val(client_Id);
            $('#edit_first_name').val(firstName);
            $('#edit_middle_name').val(middleName);
            $('#edit_last_name').val(lastName);
            $('#edit_address').val(address);
            $('#edit_age').val(age);
            $('#edit_birthday').val(birthday);
            $('#edit_contact_number').val(contact_num);
            $('#edit_soc_med').val(soc);
            $('#edit_co_borrower').val(co_borrow);
            $('#edit_relationship_co').val(relationship);

            // Show modal
            $('#editClientModal').removeClass('hidden');
        });

        // Close modal
        $('#closeEditModal').on('click', function() {
            $('#editClientModal').addClass('hidden');
        });
    });


    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const editClientBtn = document.getElementById('editClientBtn');
            if (editClientBtn) {
                editClientBtn.addEventListener('click', function () {
                    document.getElementById('editClientModal').classList.remove('hidden');
                });
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

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const uploadBtn = document.getElementById('client_image');
            const fileInput = document.getElementById('upload_image');
            const imagePreview = document.getElementById('client_image');

            const clientId = window.location.pathname.split('/')[2];

            uploadBtn.addEventListener('click', function () {
                fileInput.click();
            });

            fileInput.addEventListener('change', function () {
                const file = this.files[0];

                if (file) {
                    const reader = new FileReader();

                    reader.onload = function (e) {
                        imagePreview.src = e.target.result;
                    };

                    reader.readAsDataURL(file);

                    const formData = new FormData();
                    formData.append('image', file);
                    formData.append('client_id', clientId);

                    fetch("{{ route('upload.image-client') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        // console.log("Upload success:", data);
                        location.reload()

                    })
                    .catch(error => {
                        console.error("Upload failed:", error);
                    });
                        }
                    });
        });

    </script>
    @endsection