<div id="editUserModal" class="hidden fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-80 text-sm">
    <div class="bg-white p-5 rounded-lg shadow-lg w-full max-w-[500px] relative">
        <!-- Trashcan Delete Button (Upper Left) -->
        <button type="button" id="deleteUser" class="absolute top-5 right-5 m-2 text-red-500 hover:text-red-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6h18M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2m5 0v14a2 2 0 01-2 2H6a2 2 0 01-2-2V6h16zM10 11v6m4-6v6" />
            </svg>
        </button>

        <div class="flex justify-between items-center mb-6 mt-3">
            <h2 class="text-2xl font-semibold text-center fw-bold w-full">USER</h2>
            <!-- <button type="button" id="closeEditModal" class="text-gray-600 hover:text-gray-800">
                <span class="text-2xl">&times;</span>
            </button> -->
        </div>

        <form id="editUserForm" action="/users/update" method="POST">
            @csrf
            <input type="hidden" id="editUserId" name="user_id">

            <!-- Name Field -->
            <div class="mb-4 flex">
                <label for="edit_name" class="text-gray-700 font-medium w-1/4 mt-2">Name</label>
                <input type="text" id="edit_name" name="name" class="w-3/4 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 w-full text-sm">
            </div>

            <!-- Username Field -->
            <div class="mb-4 flex">
                <label for="edit_username" class="text-gray-700 font-medium w-1/4 mt-2">Username</label>
                <input type="text" id="edit_username" name="username" class="w-3/4 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 w-full text-sm">
            </div>

            <div class="w-full bg-gray-500 h-1 rounded-full mb-4"></div>

            <!-- Reset Password Field -->
            <div id="resetPassword" class="mb-4 flex items-center">
                <label class="text-gray-700 font-medium w-1/4">Password</label>
                <a href="#" class="text-red-500 font-medium">Reset Password?</a>
            </div>

            <div id="passwordFields" class="hidden">
                <div class="mb-4 flex items-center relative">
                    <label for="edit_password" class="text-gray-700 font-medium w-1/4">New Password</label>
                    <input type="password" id="edit_password" name="password" class="w-3/4 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm">
                    <button type="button" id="edit_togglePassword" class="absolute right-3 top-2 text-gray-500 hover:text-gray-700">
                        <svg id="edit_eyeIconNew" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path class="eye-open" d="M1 12S5 4 12 4s11 8 11 8-4 8-11 8S1 12 1 12Z" />
                            <circle class="eye-open" cx="12" cy="12" r="3" />
                            <path class="eye-slash hidden" d="M1 12S5 4 12 4s11 8 11 8-4 8-11 8S1 12 1 12Z M4.22 4.22l15.56 15.56" />
                        </svg>
                    </button>
                </div>

                <div class="mb-4 flex items-center relative">
                    <label for="edit_confirm_password" class="text-gray-700 font-medium w-1/4">Confirm Password</label>
                    <div class="w-3/4 relative">
                        <input type="password" id="edit_confirm_password" name="confirm_password" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm">
                        <button type="button" id="edit_toggleConfirmPassword" class="absolute right-3 top-2 text-gray-500 hover:text-gray-700">
                            <svg id="edit_eyeIconConfirm" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path class="eye-open" d="M1 12S5 4 12 4s11 8 11 8-4 8-11 8S1 12 1 12Z" />
                                <circle class="eye-open" cx="12" cy="12" r="3" />
                                <path class="eye-slash hidden" d="M1 12S5 4 12 4s11 8 11 8-4 8-11 8S1 12 1 12Z M4.22 4.22l15.56 15.56" />
                            </svg>
                        </button>
                        <!-- Error message directly below the input field -->
                        <p id="passwordMismatch" class="text-red-500 text-xs mt-1 hidden">Passwords do not match</p>
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="w-24 px-4 py-2 bg-green-500 text-white rounded-lg text-center me-2">Save</button>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function () {
        $(".user-row").on("click", function () {
            let userId = $(this).data("id");
            let userName = $(this).data("name");
            let userUsername = $(this).data("username");

            // Populate fields
            $("#edit_id").val(userId);
            $("#edit_name").val(userName);
            $("#edit_username").val(userUsername);
            // Show the modal
            $("#editUserModal").removeClass("hidden");
        });

        $(document).on("click", function (e) {
            let modal = $("#editUserModal");
            if (!modal.hasClass("hidden")) {
                if ($(e.target).closest("#editUserModal .bg-white").length === 0 && !$(e.target).closest(".user-row").length) {
                    modal.addClass("hidden");
                    location.reload(); // Reload the page only if modal was open
                }
            }
        });


        // Close the modal
        $("#closeEditModal").on("click", function () {
            $("#editUserModal").addClass("hidden");
        });
    });
</script>

<script>
    $(document).ready(function () {
        $("#resetPassword").on("click", function (e) {
            e.preventDefault();
            $("#passwordFields").removeClass("hidden"); // Show password fields
            $(this).hide(); // Hide Reset Password link
        });
    });
</script>

<script>
    function togglePassword(inputId, iconId, event) {
        event.stopPropagation(); // Prevent closing modal

        let passwordField = document.getElementById(inputId);
        let icon = document.getElementById(iconId);

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            icon.innerHTML = `<path d="M1 12S5 4 12 4s11 8 11 8-4 8-11 8S1 12 1 12Z" />
                                <path d="M4.22 4.22l15.56 15.56" />`; // Eye-slash SVG
        } else {
            passwordField.type = 'password';
            icon.innerHTML = `<path d="M1 12S5 4 12 4s11 8 11 8-4 8-11 8S1 12 1 12Z" />
                                <circle cx="12" cy="12" r="3" />`; // Eye SVG
        }
    }

    // Modify event listeners to pass the event
    document.getElementById('edit_togglePassword').addEventListener('click', function (event) {
        togglePassword('edit_password', 'edit_eyeIconNew', event);
    });

    document.getElementById('edit_toggleConfirmPassword').addEventListener('click', function (event) {
        togglePassword('edit_confirm_password', 'edit_eyeIconConfirm', event);
    });

</script>

<script>
    document.getElementById("editUserForm").addEventListener("submit", function (event) {
        
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
                fetch("/users/update", {
                    method: "POST",
                    body: formData
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
</script>
<script>
    $(document).on('click', '#deleteUser', function () {
    let userId = $('#editUserModal input[name="user_id"]').val(); // Get user ID from modal input

    if (!userId) {
        Swal.fire("Error", "No user selected.", "error");
        return;
    }

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
                url: '/delete-user/' + userId, // Adjust this URL based on your route
                type: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content') // CSRF token for security
                },
                success: function (response) {
                    if (response.success) {
                        Swal.fire("Deleted!", response.message, "success").then(() => {
                            location.reload(); // Reload the page after deleting
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
$(document).ready(function () {
    $("#edit_confirm_password, #password").on("input", function () {
        validatePasswordMatch();
    });

    $("#editUserForm").on("submit", function (event) {
        if (!validatePasswordMatch()) {
            event.preventDefault(); // Prevent form submission if passwords do not match
        }
    });

    function validatePasswordMatch() {
        let password = $("#password").val();
        let confirmPassword = $("#edit_confirm_password").val();
        let errorMessage = $("#passwordMismatch");

        if (password !== confirmPassword) {
            $("#edit_confirm_password").addClass("border-red-500"); // Add red border
            errorMessage.removeClass("hidden"); // Show error message
            return false;
        } else {
            $("#edit_confirm_password").removeClass("border-red-500"); // Remove red border
            errorMessage.addClass("hidden"); // Hide error message
            return true;
        }
    }
});
</script>