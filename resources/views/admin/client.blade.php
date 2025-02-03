@extends('layout.admin')
@section('title', 'Client')

@section('content')
<div class="bg-gray-100 flex items-center justify-center p-4">
    <div class="bg-white p-5 rounded-lg shadow-lg w-full max-w-[1000px] h-[600px] overflow-hidden mt-3">
        <div class="card-container relative overflow-x-auto overflow-y-auto h-full">
            <p class="fs-2 fw-bold text-center">CLIENT</p>
            <div class="flex justify-end mt-4 mb-3">
                <button type="button" class="next-btn bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-700 px-5">Add Client</button>
            </div>
            <table class="w-full border border-gray-300 text-center">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">Header 1</th>
                        <th class="border border-gray-300 px-4 py-2">Header 2</th>
                        <th class="border border-gray-300 px-4 py-2">Header 3</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="cursor-pointer hover:bg-gray-100" onclick="rowClicked(this)">
                        <td class="px-4 py-2">Data 1</td>
                        <td class="px-4 py-2">Data 2</td>
                        <td class="px-4 py-2">Data 3</td>
                    </tr>
                    <tr class="cursor-pointer hover:bg-gray-100" onclick="rowClicked(this)">
                        <td class="px-4 py-2">Data 4</td>
                        <td class="px-4 py-2">Data 5</td>
                        <td class="px-4 py-2">Data 6</td>
                    </tr>
                    <tr class="cursor-pointer hover:bg-gray-100" onclick="rowClicked(this)">
                        <td class="px-4 py-2">Data 7</td>
                        <td class="px-4 py-2">Data 8</td>
                        <td class="px-4 py-2">Data 9</td>
                    </tr>
                    <tr class="cursor-pointer hover:bg-gray-100" onclick="rowClicked(this)">
                        <td class="px-4 py-2">Data 10</td>
                        <td class="px-4 py-2">Data 11</td>
                        <td class="px-4 py-2">Data 12</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function rowClicked(row) {
    alert("Row clicked: " + row.innerText);
}
</script>



@endsection
