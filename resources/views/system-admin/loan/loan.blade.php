@extends('layout.system-admin')
@section('title', 'Loan | Loan')

@section('content')
    <div class="m-6 h-full" id="main_content">
        <div class="card-container relative overflow-x-auto overflow-y-auto h-full">
            <div>
                <h1 class="text-3xl font-bold mb-1">LOAN</h1>
                <div class="w-full bg-gray-800 h-1 rounded-full"></div>
            </div>   
            <div class="flex justify-start mb-3 mt-3 w-full">

                <form method="GET" action="{{ route('system-admin.loan.loan') }}" class="w-full">
                    <div class="grid grid-cols-10 gap-2 ms-1 me-1 w-full items-center">
                        <div class="flex flex-col col-span-4">
                            <input type="text" name="query" id="client-search" class="form-control text-sm" placeholder="Search" />
                        </div>

                        <div class="flex flex-col col-span-2">
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

                        <div class="flex flex-col col-span-2">
                            <select name="nameSort" onchange="this.form.submit()"
                                class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 w-full text-xs">
                                <option value="">Sort</option>
                                <option value="asc" {{ request('nameSort') == 'asc' ? 'selected' : '' }}>Name - Asc</option>
                                <option value="desc" {{ request('nameSort') == 'desc' ? 'selected' : '' }}>Name - Desc</option>
                            </select>
                        </div>
                    </div>
                </form>

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

                        ADD LOAN
                    </button>
                </div>
            </div>

            <table class="w-full border border-gray-300 text-center">
                <thead class="bg-[#028051] text-xs text-white">
                    <tr>
                        <th class="border border-gray-300 px-2 py-3">LOAN ID</th>
                        <th class="border border-gray-300 px-2 py-3">CLIENT ID</th>
                        <th class="border border-gray-300 px-2 py-3">NAME</th>
                        <th class="border border-gray-300 px-2 py-3">AMOUNT</th>
                        <th class="border border-gray-300 px-2 py-3">TERMS</th>
                        <th class="border border-gray-300 px-2 py-3">INTEREST PER MONTH</th>
                    </tr>
                </thead>
                <tbody class="text-xs">
                    @if($loans->isEmpty())
                        <tr>
                            <td colspan="8" class="px-4 py-2 text-center text-gray-500">No results found.</td>
                        </tr>
                    @else
                        @foreach($loans as $loan)
                            <tr class="cursor-pointer hover:bg-yellow-200 user-row" onclick="redirectToLoanDetail('{{ $loan->loan_id }}')">
                                <td class="px-4 py-2">{{ $loan->loan_id }}</td>
                                <td class="px-4 py-2">{{ $loan->client_id }}</td>
                                <td class="px-4 py-2">
                                    {{ $loan->client->first_name }} 
                                    @if($loan->client->middle_name) {{ $loan->client->middle_name }} @endif 
                                    {{ $loan->client->last_name }}
                                </td>
                                <td class="px-4 py-2">PHP {{ number_format($loan->loan_amount, 2) }}</td>
                                <td class="px-4 py-2">{{ $loan->progress }} / {{$loan->total_progress }}</td>
                                <td class="px-4 py-2">{{ $loan->interest }}%</td>
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
       <div id="dueReminderModal" style="display:none; position:fixed; top:20%; left:50%; transform:translateX(-50%);
        background:#fff; padding:20px; border:1px solid #ccc; box-shadow:0 2px 10px rgba(0,0,0,0.3); z-index:10000; width:350px;">
            <h3 style="margin-top:0;">Payment Reminder</h3>
            <p id="dueReminderText"></p>
            <label style="display:block; margin-top:10px;">
                <input type="checkbox" id="dontShowAgain"> Do not show this again
            </label>
            <div style="margin-top:15px; text-align:right;">
                <button id="okBtn">OK</button>
                <button id="remindLaterBtn">Remind Me Later</button>
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
<script>
    function redirectToLoanDetail(loanId) {
        window.location.href = "/loan-detail/" + loanId;
    }
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    if (localStorage.getItem('hideDueReminder') === 'true') {
        return;
    }
    if (sessionStorage.getItem('shownAfterLogin') === 'true') {
        return;
    }

    fetch('{{ route("investor.dueReminder") }}')
        .then(res => res.json())
        .then(data => {
            const modal = document.getElementById('dueReminderModal');
            const text = document.getElementById('dueReminderText');

            if (data.due_today) {
                text.innerHTML = data.message + "<br><b>" + data.investors.join(", ") + "</b>";
            } else {
                text.innerHTML = data.message;
            }

            modal.style.display = 'block';

            document.getElementById('okBtn').onclick = function() {
                if (document.getElementById('dontShowAgain').checked) {
                    localStorage.setItem('hideDueReminder', 'true');
                }
                modal.style.display = 'none';
            };

            document.getElementById('remindLaterBtn').onclick = function() {
                modal.style.display = 'none';
            };

            sessionStorage.setItem('shownAfterLogin', 'true');
        });
});
</script>
@endsection
