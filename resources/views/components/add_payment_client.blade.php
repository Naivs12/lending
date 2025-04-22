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
                    <div class="grid grid-cols-1 gap-4">
                        <div class="flex flex-col relative">
                            <label for="client_input" class="text-gray-700 font-medium">Client ID</label>
                            <input type="text" id="client_input" name="client_id_display" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 w-full text-sm" placeholder="Select Client ID / Name" required>
                            <input type="hidden" id="client_id" name="client_id">
                            <div id="client_suggestions" class="text-xs absolute top-full left-0 right-0 bg-white border border-gray-300 rounded-lg mt-1 max-h-40 overflow-y-auto z-50 hidden"></div>
                        </div>
                    </div>
 
                    <div class="grid grid-cols-1 gap-4">
                        <div class="flex flex-col">
                        <label for="client_input" class="text-gray-700 font-medium">Loan</label>
                            <input type="text" id="client_input" name="client_id_display" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 w-full text-sm" placeholder="Select Loan" required>
                            <input type="hidden" id="client_id" name="client_id">
                            <div id="client_suggestions" class="text-xs absolute top-full left-0 right-0 bg-white border border-gray-300 rounded-lg mt-1 max-h-40 overflow-y-auto z-50 hidden"></div>
                        </div>
                    </div>

                    

                    <div class="grid grid-cols-1 gap-4">
                        <div class="flex flex-col">
                            <label for="date_release" class="text-gray-700 font-medium">Payment Amount</label>
                            <input type="number" id="date_release" name="date_release" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 w-full text-sm" required>
                        </div>  
                    </div>

                    <div class="flex justify-end mt-4">
                        <button type="submit" class="next-btn bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-700 px-5">Proceed</button>
                    </div>
                </form>
            </div>       
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $("#client_input").on("keyup", function() {
        let query = $(this).val();
        if (query.length >= 1) { 
            $.ajax({
                url: "{{ route('clients.search') }}",
                method: "GET",
                data: { query: query },
                success: function(data) {
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
                        suggestionBox.addClass("hidden");
                    }
                },
                error: function(xhr) {
                    console.error("Error:", xhr.responseText);
                }
            });
        } else {
            $("#client_suggestions").addClass("hidden");
        }
    });

    $(document).on("click", "#client_suggestions div", function() {
        let clientId = $(this).data("client-id"); 
        let clientName = $(this).data("client-name"); 

        $("#client_input").val(clientName); 
        $("#client_id").val(clientId); 
        $("#client_suggestions").addClass("hidden");
    });

    $(document).on("click", function(e) {
        if (!$(e.target).closest("#client_input, #client_suggestions").length) {
            $("#client_suggestions").addClass("hidden");
        }
    });
});
</script>