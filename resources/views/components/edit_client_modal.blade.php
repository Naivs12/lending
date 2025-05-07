<!-- Edit Client Modal -->
<div id="editClientModal" class="hidden fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-80">
        <div class="bg-white p-5 rounded-lg shadow-lg w-full max-w-5xl">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-center fw-bold w-full">CLIENT PERSONAL INFORMATION</h2>
                <button type="button" id="closeEditModal" class="text-gray-600 hover:text-gray-800">
                    <span class="text-2xl">&times;</span>
                </button>
            </div>
            <div class="slider-container relative">
                <div class="slide" style="display: block;">
                    <p class="fs-5 fw-bold mb-3">Personal Details</p>

                    <form id="editClientForm" class="space-y-3" action="/client/update" method="POST">
                        @csrf
                        <input type="hidden" id="editClientId" name="editClientId" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                      

                        <div class="grid grid-cols-3 gap-4">
                            <div class="flex flex-col">
                                <label for="edit_first_name" class="text-gray-700 font-medium">First Name</label>
                                <input type="text" id="edit_first_name" name="edit_first_name" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                            </div>
                            <div class="flex flex-col">
                                <label for="edit_middle_name" class="text-gray-700 font-medium">Middle Name</label>
                                <input type="text" id="edit_middle_name" name="edit_middle_name" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                            </div>
                            <div class="flex flex-col">
                                <label for="edit_last_name" class="text-gray-700 font-medium">Last Name</label>
                                <input type="text" id="edit_last_name" name="edit_last_name" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                            </div>
                        </div>

                        <div class="grid grid-cols gap-4">
                            <div class="flex flex-col">
                                <label for="edit_address" class="text-gray-700 font-medium">Address</label>
                                <input type="text" id="edit_address" name="edit_address" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-4">
                            <div class="flex flex-col">
                                <label for="edit_age" class="text-gray-700 font-medium">Age</label>
                                <input type="number" id="edit_age" name="edit_age" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 w-full text-sm">
                            </div>
                            <div class="flex flex-col">
                                <label for="edit_birthday" class="text-gray-700 font-medium">Birthday</label>
                                <input type="date" id="edit_birthday" name="edit_birthday" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 w-full text-sm">
                            </div>
                            <div class="flex flex-col">
                                <label for="edit_gender" class="text-gray-700 font-medium">Gender</label>
                                <select id="edit_gender" name="edit_gender" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 w-full text-sm">
                                    <option value="Male" {{ $client->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ $client->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex flex-col">
                                <label for="edit_contact_number" class="text-gray-700 font-medium">Contact Number</label>
                                <input type="number" id="edit_contact_number" name="edit_contact_number" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                            </div>
                            <div class="flex flex-col">
                                <label for="edit_soc_med" class="text-gray-700 font-medium">Facebook / Messenger</label>
                                <input type="url" id="edit_soc_med" name="edit_soc_med" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                            </div>
                        </div>

                        <p class="fs-5 fw-bold mt-4 mb-3">Contact Person</p>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex flex-col">
                                <label for="edit_co_borrower" class="text-gray-700 font-medium">Co-Borrower</label>
                                <input type="text" id="edit_co_borrower" name="edit_co_borrower" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                            </div>
                            <div class="flex flex-col">
                                <label for="edit_relationship_co" class="text-gray-700 font-medium">Relationship with Co-Borrower</label>
                                <input type="text" id="edit_relationship_co" name="edit_relationship_co" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                            </div>
                        </div>


                        <div class="flex justify-end mt-4">
                            <button type="submit" class="bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-700 px-5">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Open modal and populate fields
            $(document).on('click', '.editClientBtn', function () {
                $('#editClientId').val($(this).data('id'));
                $('#edit_first_name').val($(this).data('first_name'));
                $('#edit_middle_name').val($(this).data('middle_name'));
                $('#edit_last_name').val($(this).data('last_name'));
                $('#edit_address').val($(this).data('address'));
                $('#edit_age').val($(this).data('age'));
                $('#edit_birthday').val($(this).data('birthday'));
                $('#edit_contact_number').val($(this).data('contact_num'));
                $('#edit_soc_med').val($(this).data('soc'));
                $('#edit_co_borrower').val($(this).data('co_borrower'));
                $('#edit_relationship_co').val($(this).data('relationship_co'));

                $('#editClientModal').removeClass('hidden');
            });

            // Close modal
            const closeEditModal = document.getElementById('closeEditModal');
            if (closeEditModal) {
                closeEditModal.addEventListener('click', function () {
                    $('#editClientModal').addClass('hidden');
                });
            }

            // Close modal when clicking outside
            $(document).on('click', function (e) {
                if (!$(e.target).closest('#editClientModal .bg-white, .editClientBtn').length) {
                    $('#editClientModal').addClass('hidden');
                }
            });

            // Handle form submission
            const editClientForm = document.getElementById('editClientForm');
            if (editClientForm) {
                editClientForm.addEventListener('submit', function (event) {
                    event.preventDefault();

                    let formData = new FormData(this);

                    Swal.fire({
                        title: "Are you sure?",
                        text: "Do you want to save these changes?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Yes",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch("/client/update", {
                                method: "POST",
                                body: formData,
                                headers: {
                                    "Accept": "application/json"
                                }
                            })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        Swal.fire({
                                            title: "Saved!",
                                            text: "User Updated Successfully.",
                                            icon: "success"
                                        }).then(() => {
                                            location.reload();
                                        });
                                    } else {
                                        Swal.fire({
                                            title: "Error!",
                                            text: data.message,
                                            icon: "error"
                                        });
                                    }
                                })
                                .catch(error => {
                                    Swal.fire({
                                        title: "Error!",
                                        text: "Something went wrong.",
                                        icon: "error"
                                    });
                                    console.error("Error:", error);
                                });
                        }
                    });
                });
            }
        });
    </script>