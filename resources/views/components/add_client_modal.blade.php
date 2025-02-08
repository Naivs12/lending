<div id="addClientModal" class="hidden fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-80">
    <div class="bg-white p-5 rounded-lg shadow-lg w-full max-w-5xl">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-center fw-bold w-full">CLIENT PERSONAL INFORMATION</h2>
            <button type="button" id="closeModal" class="text-gray-600 hover:text-gray-800">
                <span class="text-2xl">&times;</span>
            </button>
        </div>
        <div class="slider-container relative">

            <div class="slide"  style="display: block;">

                <p class="fs-5 fw-bold  mb-3">Personal Details</p>

                <form action="/submit" method="POST" class="space-y-3">
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
                        <div class="flex flex-col ">
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
                            <input type="tel" id="contact_number" name="contact_number" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>
                        <div class="flex flex-col">
                            <label for="facebook" class="text-gray-700 font-medium">Facebook / Messenger</label>
                            <input type="url" id="facebook" name="facebook" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>
                    </div>
                    
                    <p class="fs-5 fw-bold mt-4 mb-3">Contact Person</p>
                    
                    <div class="grid grid-cols-2 gap-4">
                        
                        <div class="flex flex-col">
                            <label for="co-borrower" class="text-gray-700 font-medium">Co-Borrower</label>
                            <input type="text" id="co-borrower" name="co-borrower" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>
                        <div class="flex flex-col">
                            <label for="relationship_co-borrower" class="text-gray-700 font-medium">Relationship with Co-Borrower</label>
                            <input type="text" id="relationship_co-borrower" name="relationship_co-borrower" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>
                    </div>
                    
                    <div class="flex justify-end mt-4">
                        <button type="button" class="next-btn bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-700 px-5">Next</button>
                    </div>
                </form>
            </div>

            <!-- Second Slide -->
            <div class="slide" style="display: none;">

                <p class="fs-5 fw-bold mb-3">Additionals Details</p>

                <form action="/submit" method="POST" class="space-y-3">
                    @csrf
                    <div class="grid grid-cols-3 gap-4" id="payment-grid">
                        <div class="flex flex-col">
                            <label for="monthly_income" class="text-gray-700 font-medium">Monthly Income</label>
                            <input type="text" id="monthly_income" name="monthly_income" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="PHP">
                        </div>

                        <div class="flex flex-col">
                            <label for="source_payment" class="text-gray-700 font-medium">Source of Payment</label>
                            <select id="source_payment" name="source_payment" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 w-full text-sm">
                                <option value="employment">Employment</option>
                                <option value="allowance">Allowance</option>
                                <option value="remittance">Remittance</option>
                                <option value="others">Others</option>
                            </select>
                        </div>

                        <div class="flex flex-col" id="other_specify">
                            <label for="specify_others" class="text-gray-700 font-medium">Specify</label>
                            <input type="text" id="specify_others" name="specify_others" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" disabled  placeholder="If 'Others' is selected!">
                        </div>

                    </div>

                    <p class="fs-5 fw-bold mt-5 mb-3">Expenses</p>

                    <div class="grid grid-cols-3 gap-4">
                        <div class="flex flex-col">
                            <label for="household_num" class="text-gray-700 font-medium">No. of Household Member</label>
                            <input type="number" id="household_num" name="household_num" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>
                        <div class="flex flex-col">
                            <label for="food" class="text-gray-700 font-medium">Food</label>
                            <input type="number" id="food" name="food" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="PHP">
                        </div>
                        <div class="flex flex-col">
                            <label for="transpo" class="text-gray-700 font-medium">Transportation</label>
                            <input type="number" id="transpo" name="transpo" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="PHP">
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4">
                        <div class="flex flex-col">
                            <label for="school_expenses" class="text-gray-700 font-medium">School Expenses</label>
                            <input type="number" id="school_expenses" name="school_expenses" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="PHP">
                        </div>
                        <div class="flex flex-col">
                            <label for="house" class="text-gray-700 font-medium">House</label>
                            <select id="house" name="house" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 w-full text-sm">
                                <option value="owned">Owned</option>
                                <option value="rented">Rented</option>
                            </select>
                        </div>
                        <div class="flex flex-col" id="other_specify_house">
                            <label for="specify_others_house" class="text-gray-700 font-medium">Monthly Rent</label>
                            <input type="number" id="specify_others_house" name="specify_others" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" disabled  placeholder="If 'Rented' is selected!">
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4">
                        <div class="flex flex-col">
                            <label for="electricity" class="text-gray-700 font-medium">Electricity</label>
                            <input type="number" id="electricity" name="electricity" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="PHP">
                        </div>
                        <div class="flex flex-col">
                            <label for="water" class="text-gray-700 font-medium">Water</label>
                            <input type="number" id="water" name="water" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="PHP">
                        </div>
                        <div class="flex flex-col">
                            <label for="other" class="text-gray-700 font-medium">Others</label>
                            <input type="number" id="other" name="other" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="PHP">
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


<script>
    // FOR 
    // JavaScript for slider functionality
    const nextBtn = document.querySelector('.next-btn');
    const slides = document.querySelectorAll('.slide');

    nextBtn.addEventListener('click', () => {
        // Hide the first slide
        slides[0].style.display = 'none';
        // Show the second slide
        slides[1].style.display = 'block';
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const sourcePayment = document.getElementById('source_payment');
        const otherSpecify = document.getElementById('other_specify');
        const specifyInput = otherSpecify.querySelector('input');

        // Function to show or hide the 'Specify' textbox based on the selection
        function toggleOtherSpecify() {
            if (sourcePayment.value === 'others') {
                specifyInput.removeAttribute('disabled'); // Enable input
            } else {
                specifyInput.setAttribute('disabled', 'disabled'); // Disable input (make it non-clickable)
            }
        }

        // Initialize on page load in case 'Others' is already selected
        toggleOtherSpecify();

        // Add event listener to dropdown change event
        sourcePayment.addEventListener('change', toggleOtherSpecify);
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const houseID = document.getElementById('house');
        const otherSpecifyHouse = document.getElementById('other_specify_house');
        const specifyInputHouse = otherSpecifyHouse.querySelector('input');

        function toggleHouseSpecify(){
            if (houseID.value === 'rented'){
                specifyInputHouse.removeAttribute('disabled');
            } else {
                specifyInputHouse.setAttribute('disabled', 'disabled');
            }
        }

        toggleHouseSpecify();

        houseID.addEventListener('change', toggleHouseSpecify);
    })
</script>