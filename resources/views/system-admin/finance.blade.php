@extends('layout.system-admin')

@section('content')
<div class="container mx-auto py-6">
    <div>
        <h1 class="text-3xl font-bold mb-1">FINANCE</h1>
        <div class="w-full bg-gray-800 h-1 rounded-full mb-4"></div>
    </div>

    <h1 class="text-2xl font-bold text-center mt-4 mb-1">PRINCIPAL, PAID & UNPAID (MONTHLY)</h1>
    
    <canvas id="financeChart" height="100"></canvas>

    <div class="flex items-center mb-4">
        <label for="year" class="mr-2 font-semibold">Year:</label>
        <select id="year" class="border rounded px-2 py-1 mr-2">
            <option value="">All</option>
            @foreach($years as $year)
                <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>{{ $year }}</option>
            @endforeach
        </select>
        <label for="month" class="mr-2 font-semibold">Month:</label>
        <select id="month" class="border rounded px-2 py-1">
            <option value="">All</option>
            @foreach($monthsList as $m)
                <option value="{{ $m }}" {{ $selectedMonth == $m ? 'selected' : '' }}>{{ $m }}</option>
            @endforeach
        </select>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Initial data from backend
    const initialData = {
        labels: @json($labels), // months
        principal: @json($principalData), // total principal per month
        paid: @json($paidData), // total paid per month
        unpaid: @json($unpaidData) // total unpaid per month
    };

    let currentFilter = 'monthly';

    const ctx = document.getElementById('financeChart').getContext('2d');
    let financeChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: initialData.labels,
            datasets: [
                {
                    label: 'Principal + Interest',
                    data: initialData.principal,
                    backgroundColor: 'rgba(59,130,246,0.7)',
                    borderColor: 'rgba(59,130,246,1)',
                    borderWidth: 1
                },
                {
                    label: 'Total Paid',
                    data: initialData.paid,
                    backgroundColor: 'rgba(34,197,94,0.7)',
                    borderColor: 'rgba(34,197,94,1)',
                    borderWidth: 1
                },
                {
                    label: 'Total Unpaid',
                    data: initialData.unpaid,
                    backgroundColor: 'rgba(239,68,68,0.7)',
                    borderColor: 'rgba(239,68,68,1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Principal, Paid, and Unpaid Amounts by Month'
                },
                legend: {
                    position: 'top'
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Month'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Amount'
                    },
                    beginAtZero: true
                }
            }
        }
    });

    document.getElementById('year').addEventListener('change', fetchChartData);
    document.getElementById('month').addEventListener('change', fetchChartData);

    function fetchChartData() {
        const year = document.getElementById('year').value;
        const month = document.getElementById('month').value;
        let url = `{{ route('system-admin.finance') }}?year=${year}&month=${month}`;
        fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(response => response.json())
            .then(data => {
                financeChart.data.labels = data.labels;
                financeChart.data.datasets[0].data = data.principal;
                financeChart.data.datasets[1].data = data.paid;
                financeChart.data.datasets[2].data = data.unpaid;
                financeChart.update();
            });
    }
</script>
@endpush