@extends('layout.system-admin')
@section('title', 'Loan | Details')

@section('content')
<div class="bg-[#028051] py-4">
    <div class="flex justify-between items-center text-white px-5 uppercase text-lg">
        <div class="fw-bold">
            {{ $loan->client->first_name }} 
            @if($loan->client->middle_name) {{ $loan->client->middle_name }} @endif 
            {{ $loan->client->last_name }}
        </div>
        <div>
            <span class="fw-bold">LOAN ID :</span> {{ $loan->loan_id }}
        </div>
    </div>
</div>

<div class="mt-3 pb-32">
    <div class="max-h-[400px] overflow-y-auto border border-gray-300">
        <table class="w-full text-center text-xs">
            <thead class="sticky top-0 bg-yellow-200">
                <tr>
                    <th class="px-2 py-3">TERM</th>
                    <th class="px-2 py-3">AMOUNT DUE</th>
                    <th class="px-2 py-3">AMOUNT PAID</th>
                    <th class="px-2 py-3">BALANCE</th>
                    <th class="px-2 py-3">DUE DATE</th>
                    <th class="px-2 py-3">PAYMENT DATE</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $payment)
                <tr>
                    <td class="px-4 py-2">{{ $payment->term}}</td>
                    <td class="px-4 py-2">PHP {{ number_format($payment->amount_due,2) }}</td>
                    <td class="px-4 py-2">PHP {{ number_format($payment->amount_pd,2 )}}</td>
                    <td class="px-4 py-2">PHP {{ number_format( abs($payment->amount_due - $payment->amount_pd),2)  }}</td>
                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($payment->due_date)->format('M-d-Y') }}</td>
                    <td class="px-4 py-2">{{ $payment->created_at->format('M-d-Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="fixed bottom-0 left-72 right-5 bg-[#028051] py-4 z-50 mb-3">
    <div class="flex justify-between items-center text-white text-sm px-5 uppercase text-lg">
        <div>
            Loan Amount : PHP {{ number_format($loan->loan_amount, 2) }}
        </div>
        <div>
            Total Amount w/ Interest : PHP {{ number_format($loan->tot_amnt_w_int, 2) }}
        </div>
        <div>
            Total Amount Paid : PHP {{ number_format($loan->tot_amnt_pd, 2) }}
        </div>
        <div class="text-yellow-300 fw-bold">
            Balance : PHP {{ number_format($loan->rem_balance, 2) }}
        </div>
    </div>
</div>




@endsection
