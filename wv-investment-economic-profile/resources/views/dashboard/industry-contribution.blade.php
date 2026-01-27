@extends('layouts.dashboard')

@section('title', 'Industry Contribution')
@section('page-title', 'Industry Contribution & Growth')

@section('content')
    <div class="kpi-grid">
        @foreach($page->kpis as $kpi)
            <div class="kpi-card">
                <span class="label">{{ $kpi->label }}</span>
                <span class="value">{!! $kpi->value !!}</span>
                @if($kpi->trend_value)
                    <div class="trend {{ $kpi->trend_direction }}"><i data-lucide="{{ $kpi->icon ?? 'trending-up' }}"></i>
                        {{ $kpi->trend_value }}</div>
                @endif
            </div>
        @endforeach
    </div>

    <div class="visuals-grid">
        <!-- Industry Share Chart -->
        <div class="visual-container">
            <div class="visual-header">
                <h3>📊 Industry Share to GDP (2023–2024)</h3>
                <i data-lucide="pie-chart"></i>
            </div>
            <div class="chart-wrapper">
                <canvas id="industryShareChart"></canvas>
            </div>
        </div>

        <!-- Growth Rate Chart -->
        <div class="visual-container">
            <div class="visual-header">
                <h3>📈 Growth Rate by Industry (2024)</h3>
                <i data-lucide="trending-up"></i>
            </div>
            <div class="chart-wrapper">
                <canvas id="industryGrowthChart"></canvas>
            </div>
        </div>
        <div class="sources-section">
            <h3><i data-lucide="library"></i> Data Sources & References</h3>
            <div class="sources-list">
                @foreach($page->dataSources as $source)
                    <div class="source-item">
                        <span class="title">{{ $source->title }}</span>
                        @if($source->url)
                            <a href="{{ $source->url }}" target="_blank" class="link">{{ $source->url }}</a>
                        @endif
                        <p class="description">{{ $source->description }}</p>
                    </div>
                @endforeach
            </div>
        </div>
@endsection

    @section('scripts')
        <script>
            // Industry Share Chart
            @php $shareChart = $page->charts->where('identifier', 'industryShareChart')->first(); @endphp
            @if($shareChart)
                const ctxShare = document.getElementById('industryShareChart').getContext('2d');
                new Chart(ctxShare, {
                    type: '{{ $shareChart->type }}',
                    data: {
                        labels: {!! json_encode($shareChart->labels) !!},
                        datasets: {!! json_encode($shareChart->datasets) !!}
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { position: 'bottom', labels: { color: '#94a3b8' } }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                max: 100,
                                grid: { color: 'rgba(255, 255, 255, 0.05)' },
                                ticks: { color: '#94a3b8', callback: v => v + '%' }
                            },
                            x: { grid: { display: false }, ticks: { color: '#94a3b8' } }
                        }
                    }
                });
            @endif

            // Industry Growth Chart
            @php $growthChart = $page->charts->where('identifier', 'industryGrowthChart')->first(); @endphp
            @if($growthChart)
                const ctxGrowth = document.getElementById('industryGrowthChart').getContext('2d');
                new Chart(ctxGrowth, {
                    type: '{{ $growthChart->type }}',
                    data: {
                        labels: {!! json_encode($growthChart->labels) !!},
                        datasets: {!! json_encode($growthChart->datasets) !!}
                    },
                    options: {
                        indexAxis: 'y',
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: {
                            x: { grid: { color: 'rgba(255, 255, 255, 0.05)' }, ticks: { color: '#94a3b8' } },
                            y: {
                                grid: { display: false },
                                ticks: { color: '#94a3b8', callback: v => v + '%' }
                            }
                        }
                    }
                });
            @endif
        </script>
    @endsection