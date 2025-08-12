<!-- Add SweetAlert2 CDN in the head section -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Modal HTML -->
<div id="addInvestorPaymentModal" class="hidden fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-80">
    <div class="bg-white p-5 rounded-lg shadow-lg w-full max-w-[500px]">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-center fw-bold w-full">ADD PAYMENT</h2>
            <button type="button" id="closeModal" class="text-gray-600 hover:text-gray-800">
                <span class="text-2xl">&times;</span>
            </button>
        </div>
        <form id="addInvestorPaymentForm" method="POST" class="space-y-3">
            @csrf
            <div class="grid grid-cols-1 gap-4">
                <div class="flex flex-col relative">
                    <label for="investor_input" class="text-gray-700 font-medium">Investor ID</label>
                    <input type="text" id="investor_input" name="investor_id_display" class="p-2 border border-gray-300 rounded-lg w-full text-sm" placeholder="Select Investor ID / Name" required autocomplete="off">
                    <input type="hidden" id="investor_id" name="investor_id">
                    <div id="investor_suggestions" class="text-xs absolute top-full left-0 right-0 bg-white border border-gray-300 rounded-lg mt-1 max-h-40 overflow-y-auto z-50 hidden"></div>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-4">
                <div class="flex flex-col">
                    <label for="amount" class="text-gray-700 font-medium">Payment Amount</label>
                    <input type="number" id="amount" name="amount" class="p-2 border border-gray-300 rounded-lg w-full text-sm" required>
                </div>
            </div>
            <div class="flex justify-end mt-4">
                <button type="submit" class="bg-[#028051] text-white p-2 rounded-lg hover:bg-green-700 px-5">Proceed</button>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    // Submit form with SweetAlert2 confirmation
    $("#addInvestorPaymentForm").on("submit", function (e) {
        e.preventDefault();

        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to proceed with the payment?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, proceed',
            cancelButtonText: 'No, cancel',
            confirmButtonColor: '#028051',
            cancelButtonColor: '#d33'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('investor.payment.store') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        Swal.fire({
                            title: 'Success!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonColor: '#028051',
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'There was an error processing the payment.',
                            icon: 'error',
                            confirmButtonColor: '#dc3545',
                        });
                    }
                });
            }
        });
    });

    // Close modal
    $("#closeModal").on("click", function () {
        $("#addInvestorPaymentModal").addClass("hidden");
    });

    $("#investor_input").on("keyup", function () {
        let query = $(this).val();
        if (query.length >= 1) {
            $.ajax({
                url: "{{ route('investors.search') }}",
                method: "GET",
                data: { query: query },
                success: function (data) {
                    let suggestionBox = $("#investor_suggestions");
                    suggestionBox.html("");
                    if (data.length > 0) {
                        data.forEach(investor => {
                            suggestionBox.append(`
                                <div class="p-2 hover:bg-gray-200 cursor-pointer" data-investor-id="${investor.investor_id}" data-investor-name="${investor.full_name}">
                                    ${investor.investor_id} - ${investor.full_name}
                            </div>
                            `);
                        });
                        suggestionBox.removeClass("hidden");
                    } else {
                        suggestionBox.html(`<div class="p-2 text-gray-500">No investors found</div>`).removeClass("hidden");
                    }
                },
                error: function (xhr) {
                    console.error("Error:", xhr.responseText);
                }
            });
        } else {
            $("#investor_suggestions").addClass("hidden");
        }
    });

    $(document).on("click", "#investor_suggestions div", function () {
        let investorId = $(this).data("investor-id");
        let investorName = $(this).data("investor-name");

        $("#investor_input").val(investorName);
        $("#investor_id").val(investorId);
        $("#investor_suggestions").addClass("hidden");
    });

    // Hide suggestions on outside click
    $(document).on("click", function (e) {
        if (!$(e.target).closest("#investor_input, #investor_suggestions").length) {
            $("#investor_suggestions").addClass("hidden");
        }
    });
});
</script>
