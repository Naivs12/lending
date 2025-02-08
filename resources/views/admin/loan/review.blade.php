@extends('layout.admin')
@section('title', 'Loan | Review')

@section('content')
<div class="bg-gray-100 flex items-center justify-center p-4" id="main_content">
    <div class="bg-white p-5 rounded-lg shadow-lg w-full max-w-[1000px] h-[600px] overflow-hidden mt-3">
        <div class="card-container relative overflow-x-auto overflow-y-auto h-full">
            <div>
                <h1 class="text-3xl font-semibold mb-1">REVIEW</h1>
                <div class="w-full bg-blue-800 h-1 rounded-full"></div>
               </div>
               
            <table class="w-full border border-gray-300 text-center">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">CLIENT ID</th>
                        <th class="border border-gray-300 px-4 py-2">NAME</th>
                        <th class="border border-gray-300 px-4 py-2">AMOUNT</th>
                        <th class="border border-gray-300 px-4 py-2">DATE OF APPLICATION</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="cursor-pointer hover:bg-gray-100" onclick="rowClicked(this)">
                        <td class="px-4 py-2">Data 1</td>
                        <td class="px-4 py-2">Data 2</td>
                        <td class="px-4 py-2">Data 3</td>
                        <td class="px-4 py-2">Data 3</td>
                    </tr>
                    <tr class="cursor-pointer hover:bg-gray-100" onclick="rowClicked(this)">
                        <td class="px-4 py-2">Data 4</td>
                        <td class="px-4 py-2">Data 5</td>
                        <td class="px-4 py-2">Data 6</td>
                        <td class="px-4 py-2">Data 3</td>
                    </tr>
                    <tr class="cursor-pointer hover:bg-gray-100" onclick="rowClicked(this)">
                        <td class="px-4 py-2">Data 7</td>
                        <td class="px-4 py-2">Data 8</td>
                        <td class="px-4 py-2">Data 9</td>
                        <td class="px-4 py-2">Data 3</td>
                    </tr>
                    <tr class="cursor-pointer hover:bg-gray-100" onclick="rowClicked(this)">
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
