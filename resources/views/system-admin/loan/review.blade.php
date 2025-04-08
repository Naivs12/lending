@extends('layout.system-admin')
@section('title', 'Loan | Review')

@section('content')
    <div class="m-6 h-full">
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
                        <tr class="cursor-pointer hover:bg-gray-100 user-row" onclick="redirectToLoanDetail('{{ $loan->loan_id }}')">
                            <td class="px-4 py-2 whitespace-nowrap items-center">{{ $loan->loan_id }}</td>
                            <td class="px-4 py-2 whitespace-nowrap items-center">{{ $loan->client_id }}</td>
                            <td class="px-4 py-2 whitespace-nowrap items-center">
                                {{ $loan->client->first_name }} 
                                @if($loan->client->middle_name) {{ $loan->client->middle_name }} @endif 
                                {{ $loan->client->last_name }}
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap items-center">{{ number_format($loan->amount, 2) }}</td>
                            <td class="px-4 py-2 whitespace-nowrap items-center">{{ \Carbon\Carbon::parse($loan->created_at)->format('Y-m-d') }}</td>
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
            title: 'Approve Loan?',
            text: `Are you sure you want to continue?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                updateLoanStatus(loanId, 'release');
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


@endsection
