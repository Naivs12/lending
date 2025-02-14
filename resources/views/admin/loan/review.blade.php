@extends('layout.admin')
@section('title', 'Loan | Review')

@section('content')
    <div class="m-6 h-full" id="main_content">
        <div class="card-container relative overflow-x-auto overflow-y-auto h-full">

            <div>
                <h1 class="text-3xl font-bold mb-1">REVIEW</h1>
                <div class="w-full bg-gray-500 h-1 rounded-full"></div>
            </div>

            <div class="flex justify-start mb-3 mt-3 w-full">
                <div class="grid grid-cols-10 gap-2 ms-1 me-1 w-full">
                    <div class="flex flex-col col-span-3">
                        <input type="text" id="search" name="search"
                            class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 w-full text-xs"
                            placeholder="Search">
                    </div>
                    <div class="flex">
                        <button class="bg-white text-gray-600 border border-gray-400 py-1 px-3 rounded-full shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1111.19 3.898l3.705 3.704a1 1 0 11-1.414 1.415l-3.705-3.705A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
               
            <table class="w-full border border-gray-300 text-center text-xs">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border border-gray-300 px-2 py-3">LOAN ID</th>
                        <th class="border border-gray-300 px-2 py-3">CLIENT ID</th>
                        <th class="border border-gray-300 px-2 py-3">NAME</th>
                        <th class="border border-gray-300 px-2 py-3">AMOUNT</th>
                        <th class="border border-gray-300 px-2 py-3">DATE OF APPLICATION</th>
                    </tr>
                </thead>
                <tbody>
                <tr class="cursor-pointer border hover:bg-gray-100" onclick="rowClicked(this)">
                        <td class="px-4 py-2">L-001</td>
                        <td class="px-4 py-2">C-101</td>
                        <td class="px-4 py-2">John Doe</td>
                        <td class="px-4 py-2">$1,000</td>
                        <td class="px-4 py-2">2024-02-01</td>
                    </tr>
                    <tr class="cursor-pointer border hover:bg-gray-100" onclick="rowClicked(this)">
                        <td class="px-4 py-2">L-002</td>
                        <td class="px-4 py-2">C-102</td>
                        <td class="px-4 py-2">Jane Smith</td>
                        <td class="px-4 py-2">$2,500</td>
                        <td class="px-4 py-2">2024-02-02</td>
                    </tr>
                    <tr class="cursor-pointer border hover:bg-gray-100" onclick="rowClicked(this)">
                        <td class="px-4 py-2">L-003</td>
                        <td class="px-4 py-2">C-103</td>
                        <td class="px-4 py-2">Alice Johnson</td>
                        <td class="px-4 py-2">$3,200</td>
                        <td class="px-4 py-2">2024-02-03</td>
                    </tr>
                    <tr class="cursor-pointer border hover:bg-gray-100" onclick="rowClicked(this)">
                        <td class="px-4 py-2">L-004</td>
                        <td class="px-4 py-2">C-104</td>
                        <td class="px-4 py-2">Bob Williams</td>
                        <td class="px-4 py-2">$4,500</td>
                        <td class="px-4 py-2">2024-02-04</td>
                    </tr>
                    <tr class="cursor-pointer border hover:bg-gray-100" onclick="rowClicked(this)">
                        <td class="px-4 py-2">L-005</td>
                        <td class="px-4 py-2">C-105</td>
                        <td class="px-4 py-2">Charlie Brown</td>
                        <td class="px-4 py-2">$5,000</td>
                        <td class="px-4 py-2">2024-02-05</td>
                    </tr>
                    <tr class="cursor-pointer border hover:bg-gray-100" onclick="rowClicked(this)">
                        <td class="px-4 py-2">L-006</td>
                        <td class="px-4 py-2">C-106</td>
                        <td class="px-4 py-2">David Miller</td>
                        <td class="px-4 py-2">$6,800</td>
                        <td class="px-4 py-2">2024-02-06</td>
                    </tr>
                    <tr class="cursor-pointer border hover:bg-gray-100" onclick="rowClicked(this)">
                        <td class="px-4 py-2">L-007</td>
                        <td class="px-4 py-2">C-107</td>
                        <td class="px-4 py-2">Emma Wilson</td>
                        <td class="px-4 py-2">$7,300</td>
                        <td class="px-4 py-2">2024-02-07</td>
                    </tr>
                    <tr class="cursor-pointer border hover:bg-gray-100" onclick="rowClicked(this)">
                        <td class="px-4 py-2">L-008</td>
                        <td class="px-4 py-2">C-108</td>
                        <td class="px-4 py-2">Frank Thomas</td>
                        <td class="px-4 py-2">$8,900</td>
                        <td class="px-4 py-2">2024-02-08</td>
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
@endsection
