@extends('layout.system-admin')
@section('title', 'Maintenance | Branch')
@section('content')
<div class="m-6 h-full" id="main_content">
    <div class="card-container relative overflow-x-auto overflow-y-auto h-full">
        <div>
            <h1 class="text-3xl font-bold mb-1">ARCHIVE</h1>
            <div class="w-full bg-gray-800 h-1 rounded-full"></div>
        </div>   
        <div class="flex justify-start mb-3 mt-3 w-full border-b border-gray-300">
            <!-- Tabs -->
            <div class="flex border-b border-gray-300">
                <button class="py-2 text-gray-600 hover:text-gray-800 focus:outline-none focus:border-b-2 focus:border-yellow-600" id="complete-loan-tab">
                    Complete Loan
                </button>
                <button class="px-4 py-2 text-gray-600 hover:text-gray-800 focus:outline-none focus:border-b-2 focus:border-yellow-600" id="blocklisted-tab">
                    Blocklisted
                </button>
            </div>
        </div>
        <!-- Tab Content -->
        <div id="tab-content" class="mt-4">
            <div id="complete-loan-content" class="hidden">
                <table class="w-full border border-gray-300 text-center">
                    <thead class="bg-[#028051] text-xs text-white">
                        <tr>
                            <th class="border border-gray-300 px-2 py-3">LOAN ID</th>
                            <th class="border border-gray-300 px-2 py-3">CLIENT ID</th>
                            <th class="border border-gray-300 px-2 py-3">NAME</th>
                            <th class="border border-gray-300 px-2 py-3">AMOUNT</th>
                            <th class="border border-gray-300 px-2 py-3">INTEREST PER MONTH</th>
                        </tr>
                    </thead>
                    <tbody class="text-xs">
                        @forelse ($completedLoans as $loan)
                            <tr>
                                <td class="px-4 py-2">{{ $loan->loan_id }}</td>
                                <td class="px-4 py-2">{{ $loan->client_id }}</td>
                                <td class="px-4 py-2">
                                    {{ $loan->client->first_name }} 
                                    @if($loan->client->middle_name) {{ $loan->client->middle_name }} @endif 
                                    {{ $loan->client->last_name }}
                                </td>
                                <td class="px-4 py-2">PHP {{ number_format($loan->loan_amount,2) }}</td>
                                <td class="px-4 py-2">{{ $loan->interest }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-2">No completed loans found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <!-- Pagination Links -->
                <div class="mt-2 flex justify-end text-xs">
                    {!! $completedLoans->links('vendor.pagination.tailwind') !!}
                </div>
            </div>
            <div id="blocklisted-content" class="hidden">
                <table class="w-full border border-gray-300 text-center">
                    <thead class="bg-[#028051] text-xs text-white">
                        <tr>
                            <th class="border border-gray-300 px-2 py-3">CLIENT ID</th>
                            <th class="border border-gray-300 px-2 py-3">NAME</th>
                            <th class="border border-gray-300 px-2 py-3">ADDRESS</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript for tab functionality
    document.addEventListener('DOMContentLoaded', function () {
        const completeLoanTab = document.getElementById('complete-loan-tab');
        const blocklistedTab = document.getElementById('blocklisted-tab');
        const completeLoanContent = document.getElementById('complete-loan-content');
        const blocklistedContent = document.getElementById('blocklisted-content');

        // Function to activate a tab
        function activateTab(activeTab, inactiveTab, activeContent, inactiveContent) {
            activeTab.classList.add('text-yellow-600', 'border-b-2', 'border-yellow-600');
            inactiveTab.classList.remove('text-yellow-600', 'border-b-2', 'border-yellow-600');
            activeContent.classList.remove('hidden');
            inactiveContent.classList.add('hidden');
        }

        // Default to showing the "Complete Loan" tab
        activateTab(completeLoanTab, blocklistedTab, completeLoanContent, blocklistedContent);

        // Event listeners for tab switching
        completeLoanTab.addEventListener('click', () => {
            activateTab(completeLoanTab, blocklistedTab, completeLoanContent, blocklistedContent);
        });

        blocklistedTab.addEventListener('click', () => {
            activateTab(blocklistedTab, completeLoanTab, blocklistedContent, completeLoanContent);
        });
    });
</script>
@endsection