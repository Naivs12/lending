@extends('layout.admin')
@section('title', 'Loan | Release')

@section('content')
<div class="bg-gray-100 flex items-center justify-center p-4" id="main_content">
    <div class="bg-white p-5 rounded-lg shadow-lg w-full max-w-[1000px] h-[600px] overflow-hidden mt-3">
        <div class="card-container relative overflow-x-auto overflow-y-auto h-full">
            <div>
                <h1 class="text-3xl font-semibold mb-1">RELEASE</h1>
                <div class="w-full bg-gray-600 h-1 rounded-full"></div>
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
                        <th class="border border-gray-300 px-4 py-2">LOAN ID</th>
                        <th class="border border-gray-300 px-4 py-2">CLIENT ID</th>
                        <th class="border border-gray-300 px-4 py-2">NAME</th>
                        <th class="border border-gray-300 px-4 py-2">AMOUNT</th>
                        <th class="border border-gray-300 px-4 py-2">DATE OF RELEASE</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="cursor-pointer border hover:bg-gray-100" onclick="rowClicked(this)">
                        <td class="px-4 py-2">Data 1</td>
                        <td class="px-4 py-2">Data 2</td>
                        <td class="px-4 py-2">Data 3</td>
                        <td class="px-4 py-2">Data 3</td>
                    </tr>
                    <tr class="cursor-pointer border hover:bg-gray-100" onclick="rowClicked(this)">
                        <td class="px-4 py-2">Data 4</td>
                        <td class="px-4 py-2">Data 5</td>
                        <td class="px-4 py-2">Data 6</td>
                        <td class="px-4 py-2">Data 3</td>
                    </tr>
                    <tr class="cursor-pointer border hover:bg-gray-100" onclick="rowClicked(this)">
                        <td class="px-4 py-2">Data 7</td>
                        <td class="px-4 py-2">Data 8</td>
                        <td class="px-4 py-2">Data 9</td>
                        <td class="px-4 py-2">Data 3</td>
                    </tr>
                    <tr class="cursor-pointer border hover:bg-gray-100" onclick="rowClicked(this)">
                        <td class="px-4 py-2">Data 10</td>
                        <td class="px-4 py-2">Data 11</td>
                        <td class="px-4 py-2">Data 12</td>
                        <td class="px-4 py-2">Data 3</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
