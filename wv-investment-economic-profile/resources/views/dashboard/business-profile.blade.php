@extends('layouts.dashboard')

@section('title', 'Business Profile')
@section('page-title', 'Business & Employment Profile')

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
        <!-- BN Registration Trend -->
        @php $bnChart = $page->charts->where('identifier', 'bnRegistrationChart')->first(); @endphp
        @if($bnChart)
            <div class="visual-container">
                <div class="visual-header">
                    <h3><i data-lucide="line-chart"></i> {{ $bnChart->title }}</h3>
                    <span class="badge">{{ $bnChart->subtitle }}</span>
                </div>
                <div class="chart-wrapper">
                    <canvas id="bnRegistrationChart"></canvas>
                </div>
            </div>
        @endif

        <!-- Establishments by Province -->
        @php $estChart = $page->charts->where('identifier', 'establishmentsChart')->first(); @endphp
        @if($estChart)
            <div class="visual-container">
                <div class="visual-header">
                    <h3><i data-lucide="building-2"></i> {{ $estChart->title }}</h3>
                    <span class="badge">{{ $estChart->subtitle }}</span>
                </div>
                <div class="chart-wrapper">
                    <canvas id="establishmentsChart"></canvas>
                </div>
            </div>
        @endif

        <!-- MSME vs Large Table -->
        @php $msmeTable = $page->tableData->where('identifier', 'msme_vs_large')->first(); @endphp
        @if($msmeTable)
            <div class="visual-container full-width">
                <div class="visual-header">
                    <h3><i data-lucide="table"></i> {{ $msmeTable->title }}</h3>
                    <span class="badge">2023 Statistics</span>
                </div>
                <div class="table-responsive">
                    <table class="premium-table">
                        <thead>
                            <tr>
                                @foreach($msmeTable->headers as $header)
                                    <th>{{ $header }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($msmeTable->rows as $row)
                                <tr>
                                    @foreach($row as $cell)
                                        <td>{{ $cell }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if($msmeTable->footer_note)
                    <div class="table-footer">
                        <p>{{ $msmeTable->footer_note }}</p>
                    </div>
                @endif
            </div>
        @endif
        <div class="sources-section">
            <h3><i data-lucide="library"></i> Data Sources & References</h3>
            <div class="sources-list">
                <div class="source-item">
                    <span class="title">DTI Business Name Registration System (BNRS)</span>
                    <a href="https://bnrs.dti.gov.ph" target="_blank" class="link">https://bnrs.dti.gov.ph</a>
                    <p class="description">Primary source for Business Name Registration trends and regional MSME
                        statistics.</p>
                </div>
                <div class="source-item">
                    <span class="title">Philippine Statistics Authority (PSA) - ASPBI</span>
                    <a href="https://psa.gov.ph" target="_blank" class="link">https://psa.gov.ph</a>
                    <p class="description">Source for Annual Survey of Philippine Business and Industry (ASPBI) and
                        employment demographics.</p>
                </div>
            </div>
        </div>
@endsection

    @section('scripts')
        <script>
            // BN Registration Chart
            @php $bnChart = $page->charts->where('identifier', 'bnRegistrationChart')->first(); @endphp
            @if($bnChart)
                const ctxBn = document.getElementById('bnRegistrationChart').getContext('2d');
                new Chart(ctxBn, {
                    type: '{{ $bnChart->type }}',
                    data: {
                        labels: {!! json_encode($bnChart->labels) !!},
                        datasets: {!! json_encode($bnChart->datasets) !!}
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: {
                            y: { grid: { color: 'rgba(255, 255, 255, 0.05)' }, ticks: { color: '#94a3b8' } },
                            x: { grid: { display: false }, ticks: { color: '#94a3b8' } }
                        }
                    }
                });
            @endif

            // Establishments Chart
            @php $estChart = $page->charts->where('identifier', 'establishmentsChart')->first(); @endphp
            @if($estChart)
                const ctxEst = document.getElementById('establishmentsChart').getContext('2d');
                new Chart(ctxEst, {
                    type: '{{ $estChart->type }}',
                    data: {
                        labels: {!! json_encode($estChart->labels) !!},
                        datasets: {!! json_encode($estChart->datasets) !!}
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: {
                            x: { grid: { color: 'rgba(255, 255, 255, 0.05)' }, ticks: { color: '#94a3b8' } },
                            y: { grid: { display: false }, ticks: { color: '#94a3b8' } }
                        }
                    }
                });
            @endif
        </script>
    @endsection