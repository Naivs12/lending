<div id="addLoanModal" class="hidden fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-80">
    <div class="bg-white p-5 rounded-lg shadow-lg w-full max-w-[500px]">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-center fw-bold w-full">ADD LOAN</h2>
            <button type="button" id="closeModal" class="text-gray-600 hover:text-gray-800">
                <span class="text-2xl">&times;</span>
            </button>
        </div>
        <div class="slider-container relative">

            <div class="slide"  style="display: block;">

                <form action="/submit" method="POST" class="space-y-3">
                    @csrf
                    <div class="grid grid-cols-1 gap-4">
                        <div class="flex flex-col">
                            <label for="client_id" class="text-gray-700 font-medium">Client ID</label>
                            <input type="number" id="client_id" name="client_id" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 w-full text-sm" placeholder="Select Client ID / Name">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex flex-col">
                            <label for="amount" class="text-gray-700 font-medium">Amount</label>
                            <input type="number" id="amount" name="amount" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 w-full text-sm" placeholder="PHP">
                        </div>
                        <div class="flex flex-col">
                            <label for="amount" class="text-gray-700 font-medium">Interest Per Month</label>
                            <input type="number" id="amount" name="amount" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 w-full text-sm" placeholder="%">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-4">
                        <div class="flex flex-col">
                            <label for="amount" class="text-gray-700 font-medium">Terms/Month</label>
                            <input type="text" id="amount" name="amount" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 w-full text-sm" placeholder="Ex. 1 Month">
                        </div>
                        <div class="flex flex-col">
                            <label for="due_date" class="text-gray-700 font-medium">Payment</label>
                            <select id="due_date" name="due_date" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 w-full text-sm">
                                <option value="weekly">Weekly</option>
                                <option value="two_weeks">2 Weeks</option>
                                <option value="monthly">Monthly</option>
                                <option value="interest_only">Interest Only</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-4">

                        <div class="flex flex-col">
                            <label for="client_id" class="text-gray-700 font-medium">Date of Release</label>
                            <input type="date" id="age" name="age" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 w-full text-sm">
                        </div>  
                    </div>

                    <div class="flex justify-end mt-4">
                        <button type="button" class="next-btn bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-700 px-5">Submit</button>
                    </div>
                </form>
            </div>       
        </div>
    </div>
</div>