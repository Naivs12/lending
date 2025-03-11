<div id="addClientModal" class="hidden fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-80">
    <div class="bg-white p-5 rounded-lg shadow-lg w-full max-w-5xl">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-center fw-bold w-full">CLIENT PERSONAL INFORMATION</h2>
            <button type="button" id="closeModal" class="text-gray-600 hover:text-gray-800">
                <span class="text-2xl">&times;</span>
            </button>
        </div>
        <div class="slider-container relative">
            <div class="slide" style="display: block;">
                <p class="fs-5 fw-bold  mb-3">Personal Details</p>

                <form id="clientForm" action="/client/submit" class="space-y-3">
                    @csrf
                    <div class="grid grid-cols-3 gap-4">
                        <div class="flex flex-col">
                            <label for="first_name" class="text-gray-700 font-medium">First Name</label>
                            <input type="text" id="first_name" name="first_name" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>
                        <div class="flex flex-col">
                            <label for="middle_name" class="text-gray-700 font-medium">Middle Name</label>
                            <input type="text" id="middle_name" name="middle_name" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>
                        <div class="flex flex-col">
                            <label for="last_name" class="text-gray-700 font-medium">Last Name</label>
                            <input type="text" id="last_name" name="last_name" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>
                    </div>

                    <div class="grid grid-cols gap-4">
                        <div class="flex flex-col">
                            <label for="address" class="text-gray-700 font-medium">Address</label>
                            <input type="text" id="address" name="address" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4">
                        <div class="flex flex-col">
                            <label for="age" class="text-gray-700 font-medium">Age</label>
                            <input type="number" id="age" name="age" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 w-full text-sm">
                        </div>
                        <div class="flex flex-col">
                            <label for="birthday" class="text-gray-700 font-medium">Birthday</label>
                            <input type="date" id="birthday" name="birthday" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 w-full text-sm">
                        </div>
                        <div class="flex flex-col">
                            <label for="gender" class="text-gray-700 font-medium">Gender</label>
                            <select id="gender" name="gender" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 w-full text-sm">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex flex-col">
                            <label for="contact_number" class="text-gray-700 font-medium">Contact Number</label>
                            <input type="number" id="contact_number" name="contact_number" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>
                        <div class="flex flex-col">
                            <label for="facebook" class="text-gray-700 font-medium">Facebook / Messenger</label>
                            <input type="url" id="facebook" name="facebook" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>
                    </div>

                    <p class="fs-5 fw-bold mt-4 mb-3">Contact Person</p>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex flex-col">
                            <label for="co_borrower" class="text-gray-700 font-medium">Co-Borrower</label>
                            <input type="text" id="co_borrower" name="co_borrower" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>
                        <div class="flex flex-col">
                            <label for="relationship_co_borrower" class="text-gray-700 font-medium">Relationship with Co-Borrower</label>
                            <input type="text" id="relationship_co_borrower" name="relationship_co_borrower" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
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
    $(document).ready(function() {
        $("#clientForm").submit(function(event) {
            event.preventDefault(); // Prevent normal form submission

            // Get form data
            var formData = $(this).serialize();

            // Check if any required field is empty
            var isValid = true;
            $("#clientForm input, #clientForm select").each(function() {
                if ($(this).prop("required") && $(this).val().trim() === "") {
                    isValid = false;
                }
            });

            if (!isValid) {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Please check your inputs and fill out all required fields!"
                });
                return;
            }

            // AJAX request
            $.ajax({
                url: "/client/submit", // Update this with your correct route
                type: "POST",
                data: formData,
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Ensure CSRF token is included
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: "success",
                            title: "Success!",
                            text: "Client added successfully!",
                        }).then(() => {
                            location.reload(); // Reload page after success
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: response.message || "Something went wrong!"
                        });
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Failed to submit data. Please try again!"
                    });
                }
            });
        });
    });
</script>

