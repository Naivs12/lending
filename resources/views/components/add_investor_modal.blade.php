<div id="addInvestorModal" class="hidden fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-80">
    <div class="bg-white p-5 rounded-lg shadow-lg w-full max-w-5xl">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-center fw-bold w-full">INVESTOR PERSONAL INFORMATION</h2>
            <button type="button" id="closeModal" class="text-gray-600 hover:text-gray-800">
                <span class="text-2xl">&times;</span>
            </button>
        </div>
        <div class="slider-container relative">

            <div class="slide"  style="display: block;">

                <p class="fs-5 fw-bold  mb-3">Personal Details</p>

                <form id="investorForm" action="/investor/submit" method="POST" class="space-y-3">
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
                            <label for="contact_number" class="text-gray-700 font-medium">Contact Number</label>
                            <input type="number" id="contact_number" name="contact_number" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 w-full text-sm"  placeholder="+639*********">
                        </div>
                        <div class="flex flex-col ">
                            <label for="amount_invest" class="text-gray-700 font-medium">Amount Invest</label>
                            <input type="number" id="amount_invest" name="amount_invest" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 w-full text-sm" placeholder="PHP">
                        </div>
                        <div class="flex flex-col ">
                            <label for="percentage" class="text-gray-700 font-medium">Payment Percentage</label>
                            <input type="number" id="percentage" name="percentage" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 w-full text-sm"  placeholder="%">
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
        $("#investorForm").submit(function(event) {
            event.preventDefault(); // Prevent normal form submission

            // Get form data
            var formData = $(this).serialize();

           

            // AJAX request
            $.ajax({
                url: "/investor/submit", // Update this with your correct route
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
                            text: "Investor added successfully!",
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
