@extends('layout.admin')
@section('title', 'Client')

@section('content')
<div class="bg-gray-100 flex items-center justify-center p-4" id="main_content">
    <div class="bg-white p-5 rounded-lg shadow-lg w-full max-w-[1000px] h-[600px] overflow-hidden mt-3">
        <div class="card-container relative overflow-x-auto overflow-y-auto h-full">

            <div>
                <h1 class="text-3xl font-semibold mb-1">CLIENT INFORMATION</h1>
                <div class="w-full bg-gray-500 h-1 rounded-full"></div>
            </div> 

            <div class="flex justify-start mb-3 mt-3 w-full">
                <div class="grid grid-cols-5 gap-2 ms-1 me-1 w-full">
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
                <div class="flex justify-end w-full">
                    <button id="openModal"class="flex flex-row w-[10em] gap-2 items-center bg-white text-gray-600 border border-gray-400 py-1 px-4 rounded-full shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 2a1 1 0 011 1v6h6a1 1 0 110 2h-6v6a1 1 0 11-2 0v-6H3a1 1 0 110-2h6V3a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Add Client
                    </button>
                </div>
            </div>

            <table class="w-full border border-gray-300 text-center text-xs">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border border-gray-300 px-2 py-3">CLIENT ID</th>
                        <th class="border border-gray-300 px-2 py-3">NAME</th>
                        <th class="border border-gray-300 px-2 py-3">ADDRESS</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="cursor-pointer hover:bg-gray-100" onclick="rowClicked(this)">
                        <td class="px-4 py-2">C-001</td>
                        <td class="px-4 py-2">John Doe</td>
                        <td class="px-4 py-2">123 Main St, Cityville</td>
                    </tr>
                    <tr class="cursor-pointer hover:bg-gray-100" onclick="rowClicked(this)">
                        <td class="px-4 py-2">C-002</td>
                        <td class="px-4 py-2">Jane Smith</td>
                        <td class="px-4 py-2">456 Oak Ave, Townsville</td>
                    </tr>
                    <tr class="cursor-pointer hover:bg-gray-100" onclick="rowClicked(this)">
                        <td class="px-4 py-2">C-003</td>
                        <td class="px-4 py-2">Alice Johnson</td>
                        <td class="px-4 py-2">789 Pine Rd, Villagetown</td>
                    </tr>
                    <tr class="cursor-pointer hover:bg-gray-100" onclick="rowClicked(this)">
                        <td class="px-4 py-2">C-004</td>
                        <td class="px-4 py-2">Bob Brown</td>
                        <td class="px-4 py-2">321 Cedar St, Metro City</td>
                    </tr>
                    <tr class="cursor-pointer hover:bg-gray-100" onclick="rowClicked(this)">
                        <td class="px-4 py-2">C-005</td>
                        <td class="px-4 py-2">Emma White</td>
                        <td class="px-4 py-2">555 Birch Ln, Suburbia</td>
                    </tr>
                    <tr class="cursor-pointer hover:bg-gray-100" onclick="rowClicked(this)">
                        <td class="px-4 py-2">C-006</td>
                        <td class="px-4 py-2">Liam Green</td>
                        <td class="px-4 py-2">777 Maple Blvd, Uptown</td>
                    </tr>
                    <tr class="cursor-pointer hover:bg-gray-100" onclick="rowClicked(this)">
                        <td class="px-4 py-2">C-007</td>
                        <td class="px-4 py-2">Sophia Black</td>
                        <td class="px-4 py-2">999 Elm Ct, Downtown</td>
                    </tr>
                    <tr class="cursor-pointer hover:bg-gray-100" onclick="rowClicked(this)">
                        <td class="px-4 py-2">C-008</td>
                        <td class="px-4 py-2">Oliver Gray</td>
                        <td class="px-4 py-2">222 Spruce Way, Riverside</td>
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
</div>

@include('components.add_client_modal')

<script>
document.getElementById('openModal').addEventListener('click', function() {
    document.getElementById('addClientModal').classList.remove('hidden');
});

document.getElementById('closeModal').addEventListener('click', function() {
    document.getElementById('addClientModal').classList.add('hidden');
});
</script>

@endsection
