@extends('layout.system-admin')
@section('title', 'Maintenance | Branch')

@section('content')
    <div class="m-6 h-full">
        <div class="card-container relative overflow-x-auto overflow-y-auto h-full">

            <div>
                <h1 class="text-3xl font-bold mb-1">BRANCH</h1>
                <div class="w-full bg-gray-500 h-1 rounded-full"></div>
            </div> 

            <div class="flex justify-start mb-3 mt-3 w-full">
                <!-- <div class="grid grid-cols-5 gap-2 ms-1 me-1 w-full">
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
                </div> -->
                <div class="flex justify-end w-full">
                     <button id="openModal"
                        class="flex items-center gap-2 px-4 py-2 text-sm font-medium 
                            text-white bg-[#028051] border border-green-600 rounded-full 
                            hover:bg-[#e7bb34] hover:border-[#e7bb34] transition duration-200">
                        
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-white transition duration-200"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 2a1 1 0 011 1v6h6a1 1 0 110 2h-6v6a1 1 0 11-2 0v-6H3a1 1 0 110-2h6V3a1 1 0 011-1z"
                               clip-rule="evenodd" />
                        </svg>

                        ADD BRANCH
                    </button>
                </div>
            </div>

            @if($branches->count() > 0)
            <table class="w-full border border-gray-300 text-center text-xs">
                <thead class="bg-[#028051] text-xs text-white">
                    <tr>
                        <th class="border border-gray-300 px-2 py-3">BRANCH ID</th>
                        <th class="border border-gray-300 px-2 py-3">BRANCH NAME</th>
                        <th class="border border-gray-300 px-2 py-3">ADDRESS</th>
                        <th class="border border-gray-300 px-2 py-3">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($branches as $branch)
                        <tr>
                            <td class="px-4 py-2">{{ $branch->branch_id }}</td>
                            <td class="px-4 py-2">{{ $branch->branch_name }}</td>
                            <td class="px-4 py-2">{{ $branch->address }}</td>
                            <td class="px-4 py-2 flex justify-center space-x-2">
                                <button onclick="editBranch('{{ $branch->id }}')" class="bg-yellow-500 text-white px-3 py-1 rounded-full shadow-sm hover:bg-yellow-600">
                                    Edit
                                </button>
                                <button onclick="deleteBranch('{{ $branch->id }}')" class="bg-red-600 text-white px-3 py-1 rounded-full shadow-sm hover:bg-red-700">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination Links -->
            <div class="mt-2 flex justify-end text-xs">
                {!! $branches->links('vendor.pagination.tailwind') !!}
            </div>
            @else
                <p class="text-center text-gray-500">No branches found.</p>
            @endif


            

        </div>
    </div>

@include('components.add_branch_modal')

<script>
document.getElementById('openModal').addEventListener('click', function() {
    document.getElementById('addBranchModal').classList.remove('hidden');
});

document.getElementById('closeModal').addEventListener('click', function() {
    document.getElementById('addBranchModal').classList.add('hidden');
});
</script>
@endsection
