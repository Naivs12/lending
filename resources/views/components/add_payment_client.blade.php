<!-- Add SweetAlert2 CDN in the head section -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Modal HTML -->
<div id="addClientPaymentModal" class="hidden fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-80">
    <div class="bg-white p-5 rounded-lg shadow-lg w-full max-w-[500px]">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-center fw-bold w-full">ADD PAYMENT</h2>
            <button type="button" id="closeModal" class="text-gray-600 hover:text-gray-800">
                <span class="text-2xl">&times;</span>
            </button>
        </div>
        <div class="slider-container relative">
            <div class="slide" style="display: block;">
                <form id="addClientPaymentForm" method="POST" class="space-y-3">
                    @csrf
                    @php
                        $user = auth()->user();
                    @endphp

                    @if ($user && $user->role === 'system-admin')
                        <div class="grid grid-cols-1 gap-4 mt-4">
                            <div class="flex flex-col">
                                <label for="branch_id" class="text-gray-700 font-medium">Branch</label>
                                <select id="branch_id" name="branch_id" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 w-full text-sm" required>
                                    <option value="">-- Select Branch --</option>    
                                    @foreach($branches as $branch)
                                        <option value="{{ $branch->branch_id }}">{{ $branch->branch_name }}</option>
                                    @endforeach
                                </select>
                            </div>  
                        </div>
                    @endif

                    <div class="grid grid-cols-1 gap-4">
                        <div class="flex flex-col relative">
                            <label for="client_input" class="text-gray-700 font-medium">Client ID</label>
                            <input type="text" id="client_input" name="client_id_display" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 w-full text-sm" placeholder="Select Client ID / Name" required readonly>
                            <input type="hidden" id="client_id" name="client_id">
                            <div id="client_suggestions" class="text-xs absolute top-full left-0 right-0 bg-white border border-gray-300 rounded-lg mt-1 max-h-40 overflow-y-auto z-50 hidden"></div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4">
                        <div class="flex flex-col relative">
                            <label for="loan_input" class="text-gray-700 font-medium">Loan</label>
                            <input type="text" id="loan_input" name="loan_id_display" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 w-full text-sm" placeholder="Select Loan" required>
                            <input type="hidden" id="loan_id" name="loan_id">
                            <div id="loan_suggestions" class="text-xs absolute top-full left-0 right-0 bg-white border border-gray-300 rounded-lg mt-1 max-h-40 overflow-y-auto z-50 hidden"></div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4">
                        <div class="flex flex-col">
                            <label for="amount" class="text-gray-700 font-medium">Payment Amount</label>
                            <input type="number" id="amount" name="amount" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 w-full text-sm" required>
                        </div>
                    </div>

                    <div class="flex justify-end mt-4">
                        <button type="submit" class="next-btn bg-[#028051] text-white p-2 rounded-lg hover:bg-green-700 px-5">Proceed</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Script -->
<script>
$(document).ready(function () {
    // Enable client input when branch is selected
    $("#branch_id").on("change", function () {
        if ($(this).val() !== "") {
            $("#client_input").prop("readonly", false).val("").focus();
            $("#client_id").val("");
            $("#loan_input").val("");
            $("#loan_id").val("");
            $("#client_suggestions, #loan_suggestions").addClass("hidden");
        } else {
            $("#client_input").prop("readonly", true).val("");
            $("#client_id").val("");
            $("#loan_input").val("");
            $("#loan_id").val("");
        }
    });

    // Client search with branch_id
    $("#client_input").on("keyup", function () {
        let query = $(this).val();
        let branchId = $("#branch_id").val();

        if (query.length >= 1 && branchId !== "") {
            $.ajax({
                url: "{{ route('clients.search') }}",
                method: "GET",
                data: { query: query, branch_id: branchId },
                success: function (data) {
                    let suggestionBox = $("#client_suggestions");
                    suggestionBox.html("");
                    if (data.length > 0) {
                        data.forEach(client => {
                            suggestionBox.append(`
                                <div class="p-2 hover:bg-gray-200 cursor-pointer" data-client-id="${client.client_id}" data-client-name="${client.full_name}">
                                    ${client.client_id} - ${client.full_name}
                                </div>
                            `);
                        });
                        suggestionBox.removeClass("hidden");
                    } else {
                        suggestionBox.html(`<div class="p-2 text-gray-500">No clients found</div>`).removeClass("hidden");
                    }
                },
                error: function (xhr) {
                    console.error("Error:", xhr.responseText);
                }
            });
        } else {
            $("#client_suggestions").addClass("hidden");
        }
    });

    // Select client
    $(document).on("click", "#client_suggestions div", function () {
        let clientId = $(this).data("client-id");
        let clientName = $(this).data("client-name");

        $("#client_input").val(clientName);
        $("#client_id").val(clientId);
        $("#client_suggestions").addClass("hidden");

        $("#loan_input").val("").focus();
        $("#loan_id").val("");
        $("#loan_suggestions").addClass("hidden");
    });

    // Loan search based on client
    $("#loan_input").on("keyup", function () {
        let query = $(this).val();
        let clientId = $("#client_id").val();

        if (query.length >= 1 && clientId !== "") {
            $.ajax({
                url: "{{ route('loans.search') }}",
                method: "GET",
                data: { query: query, client_id: clientId },
                success: function (data) {
                    let suggestionBox = $("#loan_suggestions");
                    suggestionBox.html("");

                    if (data.length > 0) {
                        data.forEach(loan => {
                            suggestionBox.append(`
                                <div class="p-2 hover:bg-gray-200 cursor-pointer" data-loan-id="${loan.loan_id}" data-loan-info="${loan.formatted}">
                                    ${loan.formatted}
                                </div>
                            `);
                        });
                        suggestionBox.removeClass("hidden");
                    } else {
                        suggestionBox.html(`<div class="p-2 text-gray-500">No loans found for this client</div>`).removeClass("hidden");
                    }
                },
                error: function (xhr) {
                    console.error("Error:", xhr.responseText);
                }
            });
        } else {
            $("#loan_suggestions").addClass("hidden");
        }
    });

    // Select loan
    $(document).on("click", "#loan_suggestions div", function () {
        let loanId = $(this).data("loan-id");
        let loanInfo = $(this).data("loan-info");

        $("#loan_input").val(loanInfo);
        $("#loan_id").val(loanId);
        $("#loan_suggestions").addClass("hidden");
    });

    // Hide suggestions on outside click
    $(document).on("click", function (e) {
        if (!$(e.target).closest("#client_input, #client_suggestions").length) {
            $("#client_suggestions").addClass("hidden");
        }
        if (!$(e.target).closest("#loan_input, #loan_suggestions").length) {
            $("#loan_suggestions").addClass("hidden");
        }
    });

    // Submit form with SweetAlert2 confirmation
    $("#addClientPaymentForm").on("submit", function (e) {
        e.preventDefault();

        // Show confirmation dialog
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
                    url: "{{ route('client.payment.create') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        Swal.fire({
                            title: 'Success!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonColor: '#028051', // Green button
                        });
                        $("#addClientPaymentModal").addClass("hidden");
                        // Optionally reload page or clear form fields
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'There was an error processing the payment.',
                            icon: 'error',
                            confirmButtonColor: '#dc3545', // Red button
                        });
                    }
                });
            }
        });
    });

    // Close modal
    $("#closeModal").on("click", function () {
        $("#addClientPaymentModal").addClass("hidden");
    });
});
</script>
