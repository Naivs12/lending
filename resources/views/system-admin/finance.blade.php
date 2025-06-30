@extends('layout.system-admin')

@section('content')
<div class="container mx-auto py-6">
    <div>
                <h1 class="text-3xl font-bold mb-1">FINANCE</h1>
                <div class="w-full bg-gray-800 h-1 rounded-full mb-4"></div>
            </div>
    <div class="flex items-center mb-4">
        <label for="filter" class="mr-2 font-semibold">Filter:</label>
        <select id="filter" class="border rounded px-2 py-1">
            <option value="daily">Daily</option>
            <option value="monthly">Monthly</option>
            <option value="quarterly">Quarterly</option>
            <option value="annually">Annually</option>
        </select>
    </div>
    <canvas id="financeChart" height="100"></canvas>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Initial data from backend
    const initialData = {
        labels: @json($labels),
        profit: @json($profitData),
        principal: @json($principalData)
    };

    let currentFilter = '{{ $filter }}';

    const ctx = document.getElementById('financeChart').getContext('2d');
    let financeChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: initialData.labels,
            datasets: [
                {
                    label: 'Profit',    
                    data: initialData.profit,
                    borderColor: 'rgba(34,197,94,1)',
                    backgroundColor: 'rgba(34,197,94,0.2)',
                    yAxisID: 'y',
                }
            ]
        },
        options: {
            responsive: true,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            stacked: false,
            plugins: {
                title: {
                    display: true,
                    text: 'PROFIT CHART',
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Date'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Amount'
                    }
                }
            }
        }
    });

    document.getElementById('filter').addEventListener('change', function() {
        currentFilter = this.value;
        fetch(`{{ route('system-admin.finance') }}?filter=${currentFilter}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            financeChart.data.labels = data.labels;
            financeChart.data.datasets[0].data = data.profit;
            financeChart.update();
        });
    });
</script>
@endpush