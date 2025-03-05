<div id="addBranchModal" class="hidden fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-80">
    <div class="bg-white p-5 rounded-lg shadow-lg w-full max-w-[500px]">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-center fw-bold w-full">ADD BRANCH</h2>
            <button type="button" id="closeModal" class="text-gray-600 hover:text-gray-800">
                <span class="text-2xl">&times;</span>
            </button>
        </div>
        <div class="slider-container relative">

            <div class="slide"  style="display: block;">

                <form id="addBranchForm" action="/branch/submit" method="POST" class="space-y-3">
                    @csrf
                    <div class="grid grid-cols-1 gap-4">
                        <div class="flex flex-col">
                            <label for="branch_name" class="text-gray-700 font-medium">Branch Name</label>
                            <input type="text" id="branch_name" name="branch_name" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 w-full text-sm" placeholder="" required>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-4">
                        <div class="flex flex-col">
                            <label for="address" class="text-gray-700 font-medium">Address</label>
                            <input type="text" id="address" name="address" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 w-full text-sm" placeholder="" required>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    $('#addBranchForm').submit(function(e) {
        e.preventDefault();

        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to add this branch?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/branch/submit',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        Swal.fire({
                            title: "Success!",
                            text: response.message,
                            icon: "success",
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload(); // Refresh the page after success
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: "Error!",
                            text: xhr.responseJSON.message || "Something went wrong!",
                            icon: "error"
                        });
                    }
                });
            }
        });
    });

    $('#closeModal').click(function() {
        $('#addBranchModal').addClass('hidden');
    });
});
</script>
<script>
    function editBranch(id) {
        Swal.fire({
            title: "Edit Branch",
            text: "Editing branch ID: " + id,
            icon: "info",
        });
    }

    function deleteBranch(branchId) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to undo this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/branch/${branchId}`, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        Swal.fire("Deleted!", data.message, "success").then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire("Error!", data.error, "error");
                    }
                })
                .catch(error => {
                    Swal.fire("Error!", "Something went wrong.", "error");
                });
            }
        });
    }
</script>