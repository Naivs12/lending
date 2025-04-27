@extends('layout.admin')
@section('title', 'Payment | Client Info')

@section('content')
    <div class="m-6 h-full" id="main_content">
        <div class="card-container relative overflow-x-auto overflow-y-auto h-full">
            <div>
                <h1 class="text-3xl font-bold mb-1">CLIENT PAYMENT INFO</h1>
                <div class="w-full bg-gray-500 h-1 rounded-full"></div>
            </div> 

            <div class="flex justify-start mb-3 mt-3 w-full">
                <form method="GET" action="{{ route('admin.client') }}" class="w-full">
                    <div class="grid grid-cols-10 gap-2 ms-1 me-1 w-full items-center">
                        <div class="flex flex-col col-span-4">
                            <input type="text" name="query" id="client-search" class="form-control text-sm" placeholder="Search" />
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

                        ADD PAYMENT
                    </button>
                </div>
            </div>
            
            <table class="w-full border border-gray-300 text-center text-xs">
                 <thead class="bg-[#028051] text-xs text-white">
                    <tr>
                        <th class="border border-gray-300 px-2 py-3">LOAN ID</th>
                        <th class="border border-gray-300 px-2 py-3">CLIENT ID</th>
                        <th class="border border-gray-300 px-2 py-3">NAME</th>
                        <th class="border border-gray-300 px-2 py-3">TERM</th>
                        <th class="border border-gray-300 px-2 py-3">AMOUNT DUE</th>
                        <th class="border border-gray-300 px-2 py-3">PAYMENT</th>
                        <th class="border border-gray-300 px-2 py-3">BALANCE</th>
                        <th class="border border-gray-300 px-2 py-3">DUE DATE</th>
                        <th class="border border-gray-300 px-2 py-3">PAYMENT DATE</th>
                    </tr>
                </thead>
                <tbody>
                    @if($payments->isEmpty())
                    <tr>
                        <td colspan="3" class="px-4 py-2 text-gray-500  text-sm">No Transactions Found.</td>
                    </tr>
                    @else
                        @foreach($payments as $payment)
                        <tr class="cursor-pointer hover:bg-yellow-200 user-row" onclick="redirectToClientDetail('{{ $payment->loan_id }}')">
                                <td class="px-4 py-2">{{ $payment->loan_id }}</td>
                                <td class="px-4 py-2">{{ $payment->client_id }}</td>
                                <td class="px-4 py-2">
                                    {{ $payment->client->first_name }} 
                                    @if($payment->client->middle_name) {{ $payment->client->middle_name }} @endif 
                                    {{ $payment->client->last_name }}
                                </td>
                                <td class="px-4 py-2">{{ $payment->term }}</td>
                                <td class="px-4 py-2">{{ number_format($payment->amount_due,2 ) }}</td>
                                <td class="px-4 py-2">{{ number_format($payment->amount_pd,2 ) }}</td>
                                <td class="px-4 py-2">{{ number_format( abs($payment->amount_due - $payment->amount_pd),2)  }}</td>
                                <td class="px-4 py-2">{{ $payment->due_date }}</td>
                                <td class="px-4 py-2">{{ $payment->payment_date }}</td>
                            </tr>
                        @endforeach
                    @endif
                        
                </tbody>
            </table>

        </div>
    </div>

    @include('components.add_payment_client')

    <script>
        document.getElementById('openModal').addEventListener('click', function() {
            document.getElementById('addClientPaymentModal').classList.remove('hidden');
        });

        document.getElementById('closeModal').addEventListener('click', function() {
            document.getElementById('addClientPaymentModal').classList.add('hidden');
        });
    </script>

@endsection