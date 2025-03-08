<div id="addUserModal" class="hidden fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-80">
    <div class="bg-white p-5 rounded-lg shadow-lg w-full max-w-[500px]">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-center fw-bold w-full">ADD USER</h2>
            <button type="button" id="closeModal" class="text-gray-600 hover:text-gray-800">
                <span class="text-2xl">&times;</span>
            </button>
        </div>
        <div class="slider-container relative">

            <div class="slide"  style="display: block;">

                <form id="addUserForm" action="/users/submit" method="POST" class="space-y-3">
                    @csrf
                    <div class="grid grid-cols-1 gap-4">
                        <div class="flex flex-col">
                            <label for="name" class="text-gray-700 font-medium">Name</label>
                            <input type="text" id="name" name="name" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 w-full text-sm" placeholder="">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-4">
                        <div class="flex flex-col">
                            <label for="username" class="text-gray-700 font-medium">Username</label>
                            <input type="text" id="username" name="username" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 w-full text-sm" placeholder="">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-4">
                        <div class="flex flex-col relative">
                            <label for="password" class="text-gray-700 font-medium">Password</label>
                            <input type="password" id="password" name="password" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 w-full text-sm pr-10">
                            <button type="button" id="togglePassword" class="absolute right-3 top-9 text-gray-500">
                                <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12S5 4 12 4s11 8 11 8-4 8-11 8S1 12 1 12Z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4">
                        <div class="flex flex-col relative">
                            <label for="confirm_password" class="text-gray-700 font-medium">Confirm Password</label>
                            <input type="password" id="confirm_password" name="password_confirmation" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 w-full text-sm pr-10">
                            <button type="button" id="toggleConfirmPassword" class="absolute right-3 top-9 text-gray-500">
                                <svg id="eyeIconConfirm" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12S5 4 12 4s11 8 11 8-4 8-11 8S1 12 1 12Z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4">
                        <div class="flex flex-col">
                            <label for="role" class="text-gray-700 font-medium">Role</label>
                            <select id="role" name="role" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 w-full text-sm">
                                <option value="system-admin">System Admin</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-4">
                        <div class="flex flex-col">
                            <label for="branch_id" class="text-gray-700 font-medium">Branch</label>
                            <select id="branch_id" name="branch_id" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 w-full text-sm">
                            <option value="">-- Select Branch --</option>    
                            @foreach($branches as $branch)
                                    <option value="{{ $branch->branch_id }}">{{ $branch->branch_name }}</option>
                                @endforeach
                            </select>
                        </div>  
                    </div>

                    <div class="flex justify-end mt-4">
                        <button type="submit" class="next-btn bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-700 px-5">Submit</button>
                    </div>
                </form>
            </div>       
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        $("#confirm_password").on("input", function () {
            let password = $("#password").val();
            let confirmPassword = $(this).val();

            if (password !== confirmPassword) {
                $(this).addClass("border-red-500"); // Add red border
                if (!$("#passwordMismatch").length) {
                    $(this).after('<p id="passwordMismatch" class="text-red-500 text-xs mt-1">Passwords do not match</p>');
                }
            } else {
                $(this).removeClass("border-red-500"); // Remove red border
                $("#passwordMismatch").remove(); // Remove error message
            }
        });

        $(".next-btn").on("click", function (event) {
            event.preventDefault(); // Prevent form submission

            let password = $("#password").val();
            let confirmPassword = $("#confirm_password").val();

            if (password !== confirmPassword) {
                Swal.fire({
                    title: "Error!",
                    text: "Passwords do not match.",
                    icon: "error",
                    confirmButtonText: "OK"
                });
                return;
            }

            Swal.fire({
                title: "Are you sure?",
                text: "Do you want to add this user?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, add user"
            }).then((result) => {
                if (result.isConfirmed) {
                    let formData = new FormData($("#addUserForm")[0]);

                    $.ajax({
                        url: "/users/submit", 
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        },
                        success: function (response) {
                            Swal.fire({
                                title: "Success!",
                                text: response.message,
                                icon: "success",
                                confirmButtonText: "OK"
                            }).then(() => {
                                location.reload(); 
                            });
                        },
                        error: function (xhr) {
                            let errors = xhr.responseJSON.errors;
                            let errorMessage = "";
                            $.each(errors, function (key, value) {
                                errorMessage += value[0] + "\n"; 
                            });

                            Swal.fire({
                                title: "Error!",
                                text: errorMessage,
                                icon: "error",
                                confirmButtonText: "OK"
                            });
                        },
                    });
                }
            });
        });
    });
</script>


<script>
    function togglePasswordVisibility(inputId, iconId) {
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

    document.getElementById('togglePassword').addEventListener('click', function () {
        togglePasswordVisibility('password', 'eyeIcon');
    });

    document.getElementById('toggleConfirmPassword').addEventListener('click', function () {
        togglePasswordVisibility('confirm_password', 'eyeIconConfirm');
    });

</script>