@extends('layout.system-admin')
@section('title', 'Maintenance | Users')

@section('content')
    <div class="m-6 h-full">
        <div class="card-container relative overflow-x-auto overflow-y-auto h-full">

            <div>
                <h1 class="text-3xl font-bold mb-1">USERS</h1>
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
                    <!-- <button id="filterButton" class="me-1 flex items-center bg-white text-gray-600 border border-gray-400 py-1 px-4 rounded-full shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 01.8 1.6L13 10v6a1 1 0 01-1.6.8l-4-3A1 1 0 017 13v-3L3.2 5.6A1 1 0 013 5z"
                                clip-rule="evenodd" />
                        </svg>
                        Filter
                    </button> -->
                    <button id="openModal" class="flex flex-row w-[10em] gap-2 items-center bg-white text-gray-600 border border-gray-400 py-1 px-4 rounded-full shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 2a1 1 0 011 1v6h6a1 1 0 110 2h-6v6a1 1 0 11-2 0v-6H3a1 1 0 110-2h6V3a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Add User
                    </button>
                </div>
            </div>

            @if($users->count() > 0)
            <div>
                
            </div>
            <table class="w-full border border-gray-300 text-center text-xs">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border border-gray-300 px-2 py-3">NAME</th>
                        <th class="border border-gray-300 px-2 py-3">USERNAME</th>
                        <th class="border border-gray-300 px-2 py-3">ROLE</th>
                        <th class="border border-gray-300 px-2 py-3">BRANCH</th>
                    </tr>
                </thead>
                <tbody> 
                @foreach($users as $user)
                    <tr class="cursor-pointer hover:bg-gray-100 user-row"
                        data-id="{{ $user->id }}"
                        data-name="{{ $user->name }}"
                        data-username="{{ $user->username }}"
                    >
                        <td class="px-4 py-2">{{ $user->name }}</td>
                        <td class="px-4 py-2">{{ $user->username }}</td>
                        <td class="px-4 py-2">{{ $user->role }}</td>
                        <td class="px-4 py-2">
                            {{ optional($branches->firstWhere('branch_id', $user->branch_id))->branch_name }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <!-- Pagination Links -->
            <div class="mt-2 flex justify-end text-xs">
                {!! $users->links('vendor.pagination.tailwind') !!}
            </div>
            @else
                <p class="text-center text-gray-500">No users found.</p>
            @endif

        </div>
    </div>

@include('components.add_user_modal')
@include('components.edit_user_modal')
<script>
document.getElementById('openModal').addEventListener('click', function() {
    document.getElementById('addUserModal').classList.remove('hidden');
});

document.getElementById('closeModal').addEventListener('click', function() {
    document.getElementById('addUserModal').classList.add('hidden');
});


</script>

<script>
    $(document).ready(function() {
    $('.user-row').on('click', function() {
        let userId = $(this).data('id');
        let name = $(this).data('name');
        let username = $(this).data('username');

        // Fill modal inputs
        $('#editUserId').val(userId);
        $('#editName').val(name);
        $('#editUsername').val(username);

        // Open modal (assuming you have a modal with id #editUserModal)
        $('#editUserModal').modal('show');
    });
});

</script>
@endsection
