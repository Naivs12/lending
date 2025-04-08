@extends('layout.system-admin')
@section('title', 'Loan | Loan')

@section('content')
    <div class="m-6 h-full" id="main_content">
        <div class="card-container relative overflow-x-auto overflow-y-auto h-full">
            <div>
                <h1 class="text-3xl font-bold mb-1">LOAN</h1>
                <div class="w-full bg-gray-500 h-1 rounded-full"></div>
            </div>   
            <div class="flex justify-start mb-3 mt-3 w-full">

                <div class="grid grid-cols-10 gap-2 ms-1 me-1 w-full items-center">
                    <div class="flex flex-col col-span-4">
                        <input type="text" id="search" name="search"
                            class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 w-full text-xs"
                            placeholder="Search">
                    </div>

                    <div class="flex flex-col col-span-2">
                        <select id="branchFilter" name="branch"
                            class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 w-full text-xs">
                            <option value="">All Branches</option>
                            <!-- Populate options here -->
                        </select>
                    </div>

                    <!-- Name Sort -->
                    <div class="flex flex-col col-span-2">
                        <select id="nameSort"
                            class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 w-full text-xs">
                            <option value="">Sort</option>
                            <option value="asc">Name - Asc</option>
                            <option value="desc">Name - Desc</option>
                        </select>
                    </div>

                </div>

                <div class="flex justify-end w-full">
                    <button id="openModal" class="flex flex-row w-[10em] text-sm gap-2 items-center bg-white text-gray-600 border border-gray-400 py-1 px-4 rounded-full shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 2a1 1 0 011 1v6h6a1 1 0 110 2h-6v6a1 1 0 11-2 0v-6H3a1 1 0 110-2h6V3a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Add Loan
                    </button>
                </div>
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
                <tbody class="text-xs">
                    @if($loans->isEmpty())
                        <tr>
                            <td colspan="8" class="px-4 py-2 text-gray-500 text-sm">No loan found.</td>
                        </tr>
                    @else
                        @foreach($loans as $loan)
                            <tr class="cursor-pointer hover:bg-gray-100 user-row" onclick="redirectToLoanDetail('{{ $loan->loan_id }}')">
                                <td class="px-4 py-2">{{ $loan->loan_id }}</td>
                                <td class="px-4 py-2">{{ $loan->client_id }}</td>
                                <td class="px-4 py-2">
                                    {{ $loan->client->first_name }} 
                                    @if($loan->client->middle_name) {{ $loan->client->middle_name }} @endif 
                                    {{ $loan->client->last_name }}
                                </td>
                                <td class="px-4 py-2">{{ $loan->amount }}</td>
                                <td class="px-4 py-2">{{ $loan->payment }}</td>
                                <td class="px-4 py-2">{{ $loan->term }}</td>
                                <td class="px-4 py-2">{{ $loan->interest }}</td>
                                <td class="px-4 py-2">{{ $loan->date_release }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

            <!-- Pagination Links -->
             <div class="mt-2 flex justify-end text-xs">
                {!! $loans->links('vendor.pagination.tailwind') !!}
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