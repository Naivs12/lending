@extends('layout.system-admin')
@section('title', 'Loan | Release')

@section('content')
    <div class="m-6 h-full">
        <div class="card-container relative overflow-x-auto overflow-y-auto h-full">
            <div>
                <h1 class="text-3xl font-bold mb-1">RELEASE</h1>
                <div class="w-full bg-gray-800 h-1 rounded-full"></div>
            </div>
            <div class="flex justify-start mb-3 mt-3 w-full">
                <form method="GET" action="{{ route('system-admin.loan.release') }}" class="w-full">
                    <div class="grid grid-cols-10 gap-2 ms-1 me-1 w-full items-center">
                        <div class="flex flex-col col-span-2">
                            <input type="text" name="query" id="client-search" class="form-control text-sm" placeholder="Search" />
                        </div>

                        <div class="flex flex-col col-span-1">
                            <select name="branch" onchange="this.form.submit()"
                                class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 w-full text-xs">
                                <option value="">All Branches</option>
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->branch_id }}" {{ request('branch') == $branch->branch_id ? 'selected' : '' }}>
                                        {{ $branch->branch_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex flex-col col-span-1">
                            <select name="nameSort" onchange="this.form.submit()"
                                class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 w-full text-xs">
                                <option value="">Sort</option>
                                <option value="asc" {{ request('nameSort') == 'asc' ? 'selected' : '' }}>Name - Asc</option>
                                <option value="desc" {{ request('nameSort') == 'desc' ? 'selected' : '' }}>Name - Desc</option>
                           </select>
                        </div>
                    </div>
                </form>
            </div>
               
            <table class="w-full border border-gray-300 text-center text-xs">
                <thead class="bg-[#028051] text-xs text-white">
                    <tr>
                        <th class="border border-gray-300 px-2 py-3">LOAN ID</th>
                        <th class="border border-gray-300 px-2 py-3">CLIENT ID</th>
                        <th class="border border-gray-300 px-2 py-3">NAME</th>
                        <th class="border border-gray-300 px-2 py-3">AMOUNT</th>
                        <th class="border border-gray-300 px-2 py-3">DATE OF RELEASE</th>
                        <th class="border border-gray-300 px-2 py-3">DOWNLOAD</th>
                        <th class="border border-gray-300 px-2 py-3">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                @if($loans->isEmpty())
                        <tr>
                            <td colspan="8" class="px-4 py-2 text-gray-500 text-sm">No loan found.</td>
                        </tr>
                    @else
                        @foreach($loans as $loan)
                            <tr>
                                <td class="px-4 py-2">{{ $loan->loan_id }}</td>
                                <td class="px-4 py-2">{{ $loan->client_id }}</td>
                                <td class="px-4 py-2">
                                    {{ $loan->client->first_name }} 
                                    @if($loan->client->middle_name) {{ $loan->client->middle_name }} @endif 
                                    {{ $loan->client->last_name }}
                                </td>
                                <td class="px-4 py-2">PHP {{ number_format($loan->loan_amount, 2) }}</td>
                                <td class="px-4 py-2">{{ $loan->date_release }}</td>
                                <td class="px-4 py-2">
                                    <a href="#" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-700 transition-all duration-300 ease-in-out">
                                        Download PDF
                                    </a>
                                </td>
                                <td class="px-4 py-2 whitespace-nowrap">
                                    <div class="flex items-center justify-center space-x-2 h-full">
                                        <button class="group bg-green-500 text-white px-2 py-1 rounded hover:bg-green-700 flex items-center transition-all duration-300 ease-in-out" onclick="approveLoan(event, this)">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ms-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="20 6 9 17 4 12"></polyline>
                                            </svg>
                                            <span class="ml-2 max-w-0 overflow-hidden group-hover:max-w-xs transition-all duration-300 ease-in-out whitespace-nowrap">Accept</span>
                                        </button>
                                        <button class="group bg-red-500 text-white px-2 py-1 rounded hover:bg-red-700 flex items-center transition-all duration-300 ease-in-out" onclick="denyLoan(event, this)">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ms-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                            </svg>
                                            <span class="ml-2 max-w-0 overflow-hidden group-hover:max-w-xs transition-all duration-300 ease-in-out whitespace-nowrap">Deny</span>
                                        </button>
                                    </div>
                                </td>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function approveLoan(event, button) {
        event.stopPropagation(); // Prevent row click

        const row = button.closest('tr');
        const loanId = row.querySelector('td').textContent.trim();

        Swal.fire({
            title: 'Release Loan?',
            text: `Are you sure you want to continue?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                updateLoanStatus(loanId, 'loan');
            }
        });
    }
    function denyLoan(event, button) {
        event.stopPropagation(); // Prevent row click

        const row = button.closest('tr');
        const loanId = row.querySelector('td').textContent.trim();

        Swal.fire({
            title: 'Deny Loan?',
            text: `Are you sure you want to continue?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e3342f',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                updateLoanStatus(loanId, 'decline');
            }
        });
    }


    function updateLoanStatus(loanId, status) {
        fetch('/update-loan-status', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ loan_id: loanId, status: status })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire(
                    'Success!',
                    `Loan has been marked as ${status}.`,
                    'success'
                ).then(() => {
                    location.reload();
                });
            } else {
                Swal.fire('Error', 'Failed to update loan status.', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire('Error', 'An unexpected error occurred.', 'error');
        });
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        const $searchInput = $('#client-search');
        const $suggestions = $('#suggestions');
        const $tableRows = $('table tbody tr');
        const $noResultsMessage = $('.no-results-message');

        // Hide suggestions and filter table on input
        $searchInput.on('input', function () {
            let query = $(this).val().toLowerCase(); // Convert to lowercase for case-insensitive search
            let resultsFound = false;

            if (query.length < 2) {
                $suggestions.hide(); // Hide suggestions when typing less than 2 characters
            } else {
                $suggestions.hide(); // Hide suggestions
            }

            // Filter table rows based on the search query
            $tableRows.each(function () {
                let rowText = $(this).text().toLowerCase(); // Get row text in lowercase
                if (rowText.includes(query)) {
                    $(this).show(); // Show matching rows
                    resultsFound = true;
                } else {
                    $(this).hide(); // Hide non-matching rows
                }
            });

            // If no results, display the "No results found" row
            if (!resultsFound) {
                $('table tbody').append('<tr><td colspan="8" class="px-4 py-2 text-center text-gray-500">No results found.</td></tr>');
            } else {
                $('table tbody tr:has(td:contains("No results found"))').remove(); // Remove "No results" row if results are found
            }
        });

        // Hide suggestion if clicked outside
        $(document).click(function (e) {
            if (!$(e.target).closest('#suggestions, #client-search').length) {
                $suggestions.hide();
            }
        });
    });
</script>
@endsection
