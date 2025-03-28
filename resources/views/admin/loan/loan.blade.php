@extends('layout.admin')
@section('title', 'Loan | Loan')

@section('content')
    <div class="m-6 h-full" id="main_content">  
        <div class="card-container relative overflow-x-auto overflow-y-auto h-full">
            <div>
                <h1 class="text-3xl font-bold mb-1">LOAN</h1>
                <div class="w-full bg-gray-500 h-1 rounded-full"></div>
            </div>  

            <div class="flex items-center gap-x-2 mb-3 mt-3 w-full">
                <!-- Add Loan Button -->
                <button id="openModal"
                    class="flex items-center gap-2 bg-white text-gray-600 border border-gray-400 py-2 px-4 rounded-full shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 2a1 1 0 011 1v6h6a1 1 0 110 2h-6v6a1 1 0 11-2 0v-6H3a1 1 0 110-2h6V3a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Add Loan
                </button>

                <!-- Search Input -->
                <div class="flex items-center flex-grow">
                    <input type="text" id="search" name="search"
                        class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 w-full text-xs"
                        placeholder="Search">
                </div>

                <!-- Search Button -->
                <button class="bg-white text-gray-600 border border-gray-400 py-2 px-3 rounded-full shadow-sm flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1111.19 3.898l3.705 3.704a1 1 0 11-1.414 1.415l-3.705-3.705A6 6 0 012 8z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            <table class="w-full border border-gray-300 text-center">
                <thead class="bg-gray-200 text-xs">
                    <tr>
                        <th class="border border-gray-300 px-2 py-3">LOAN ID</th>
                        <th class="border border-gray-300 px-2 py-3">CLIENT ID</th>
                        <th class="border border-gray-300 px-2 py-3">NAME</th>
                        <th class="border border-gray-300 px-2 py-3">AMOUNT</th>
                        <th class="border border-gray-300 px-2 py-3">PAYMENT</th>
                        <th class="border border-gray-300 px-2 py-3">TERMS/MONTH</th>
                        <th class="border border-gray-300 px-2 py-3">INTEREST PER MONTH</th>
                        <th class="border border-gray-300 px-2 py-3">DATE OF RELEASE</th>
                    </tr>
                </thead>
                <tbody id="loanTableBody" class="text-xs">
                    <tr class="cursor-pointer border hover:bg-gray-100" onclick="rowClicked(this)">
                        <td class="px-4 py-2">LN-1001</td>
                        <td class="px-4 py-2">CL-5001</td>
                        <td class="px-4 py-2">John Doe</td>
                        <td class="px-4 py-2">₱10,000</td>
                        <td class="px-4 py-2">Weekly</td>
                        <td class="px-4 py-2">6 Months</td>
                        <td class="px-4 py-2">10%</td>
                        <td class="px-4 py-2">2025-03-15</td>
                    </tr>
                   
                    <tr class="cursor-pointer border hover:bg-gray-100" onclick="rowClicked(this)">
                        <td class="px-4 py-2">LN-1004</td>
                        <td class="px-4 py-2">CL-5004</td>
                        <td class="px-4 py-2">Emily Davis</td>
                        <td class="px-4 py-2">₱20,000</td>
                        <td class="px-4 py-2">Weekly</td>
                        <td class="px-4 py-2">6 Months</td>
                        <td class="px-4 py-2">10%</td>
                        <td class="px-4 py-2">2025-06-20</td>
                    </tr>
                    <tr class="cursor-pointer border hover:bg-gray-100" onclick="rowClicked(this)">
                        <td class="px-4 py-2">LN-1005</td>
                        <td class="px-4 py-2">CL-5005</td>
                        <td class="px-4 py-2">Chris Brown</td>
                        <td class="px-4 py-2">₱12,500</td>
                        <td class="px-4 py-2">Weekly</td>
                        <td class="px-4 py-2">6 Months</td>
                        <td class="px-4 py-2">10%</td>
                        <td class="px-4 py-2">2025-07-08</td>
                    </tr>
                    <tr class="cursor-pointer border hover:bg-gray-100" onclick="rowClicked(this)">
                        <td class="px-4 py-2">LN-1006</td>
                        <td class="px-4 py-2">CL-5006</td>
                        <td class="px-4 py-2">Sarah Wilson</td>
                        <td class="px-4 py-2">₱5,500</td>
                        <td class="px-4 py-2">Weekly</td>
                        <td class="px-4 py-2">6 Months</td>
                        <td class="px-4 py-2">10%</td>
                        <td class="px-4 py-2">2025-08-12</td>
                    </tr>
                    <tr class="cursor-pointer border hover:bg-gray-100" onclick="rowClicked(this)">
                        <td class="px-4 py-2">LN-1007</td>
                        <td class="px-4 py-2">CL-5007</td>
                        <td class="px-4 py-2">David Martinez</td>
                        <td class="px-4 py-2">₱18,000</td>
                        <td class="px-4 py-2">Weekly</td>
                        <td class="px-4 py-2">6 Months</td>
                        <td class="px-4 py-2">10%</td>
                        <td class="px-4 py-2">2025-09-30</td>
                    </tr>
                    <tr class="cursor-pointer border hover:bg-gray-100" onclick="rowClicked(this)">
                        <td class="px-4 py-2">LN-1008</td>
                        <td class="px-4 py-2">CL-5008</td>
                        <td class="px-4 py-2">Laura Thompson</td>
                        <td class="px-4 py-2">₱25,000</td>
                        <td class="px-4 py-2">Weekly</td>
                        <td class="px-4 py-2">6 Months</td>
                        <td class="px-4 py-2">10%</td>
                        <td class="px-4 py-2">2025-10-18</td>
                    </tr>
                    <tr class="cursor-pointer border hover:bg-gray-100" onclick="rowClicked(this)">
                        <td class="px-4 py-2">LN-1008</td>
                        <td class="px-4 py-2">CL-5008</td>
                        <td class="px-4 py-2">Laura Thompson</td>
                        <td class="px-4 py-2">₱25,000</td>
                        <td class="px-4 py-2">Weekly</td>
                        <td class="px-4 py-2">6 Months</td>
                        <td class="px-4 py-2">10%</td>
                        <td class="px-4 py-2">2025-10-18</td>
                    </tr>
                    <tr class="cursor-pointer border hover:bg-gray-100" onclick="rowClicked(this)">
                        <td class="px-4 py-2">LN-1008</td>
                        <td class="px-4 py-2">CL-5008</td>
                        <td class="px-4 py-2">Laura Thompson</td>
                        <td class="px-4 py-2">₱25,000</td>
                        <td class="px-4 py-2">Weekly</td>
                        <td class="px-4 py-2">6 Months</td>
                        <td class="px-4 py-2">10%</td>
                        <td class="px-4 py-2">2025-10-18</td>
                    </tr>

                </tbody>
            </table>
            
            <div class="flex justify-end items-center mt-3">
                <button id="prevPage" class="bg-gray-300 text-gray-700 px-1 rounded-l-lg hover:bg-gray-400"><</button>
                        <span id="pageNumber" class="px-4 text-xs">1 / 1</span>
                    <button id="nextPage"class="bg-gray-300 text-gray-700 px-1 rounded-r-lg hover:bg-gray-400">></button>
            </div>

        </div>
    </div>


@include('components.add_loan_modal')

<script>
    document.getElementById('openModal').addEventListener('click', function () {
        document.getElementById('addLoanModal').classList.remove('hidden');
    });

    document.getElementById('closeModal').addEventListener('click', function () {
        document.getElementById('addLoanModal').classList.add('hidden');
    });
</script>
@endsection