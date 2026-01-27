@extends('layouts.dashboard')

@section('title', 'Workforce & Education')
@section('page-title', 'Workforce & Education')

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
        <!-- Graduates by Discipline -->
        <div class="visual-container full-width">
            <div class="visual-header">
                <h3>📊 HEI Graduates by Discipline</h3>
                <i data-lucide="users"></i>
            </div>
            <div class="chart-wrapper">
                <canvas id="graduatesChart"></canvas>
            </div>
        </div>

        <!-- Key Insights -->
        <div class="visual-container">
            <div class="visual-header">
                <h3>💡 Talent Supply Insight</h3>
                <i data-lucide="lightbulb"></i>
            </div>
            <div style="line-height: 1.8; color: var(--text-secondary);">
                <p>Region VI continues to produce a significant number of graduates in high-demand fields:</p>
                <ul style="margin-top: 1rem; padding-left: 1.5rem;">
                    <li><strong style="color: var(--text-primary);">IT & Computing:</strong> Strong foundation for the
                        growing IT-BPM sector.</li>
                    <li><strong style="color: var(--text-primary);">Engineering:</strong> Supporting infrastructure and
                        manufacturing growth.</li>
                    <li><strong style="color: var(--text-primary);">Business Admin:</strong> Versatile workforce for diverse
                        corporate roles.</li>
                    <li><strong style="color: var(--text-primary);">Medical Fields:</strong> High-quality healthcare talent
                        for local and global needs.</li>
                </ul>
            </div>
        </div>

        <!-- Institutional Mix Chart -->
        <div class="visual-container">
            <div class="visual-header">
                <h3>🏫 Institutional Mix</h3>
                <i data-lucide="pie-chart"></i>
            </div>
            <div class="chart-wrapper">
                <canvas id="institutionMixChart"></canvas>
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
    </div>
@endsection

@section('scripts')
    <script>
        // Graduates Chart
        @php $gradChart = $page->charts->where('identifier', 'graduatesChart')->first(); @endphp
        @if($gradChart)
            const ctxGrads = document.getElementById('graduatesChart').getContext('2d');
            new Chart(ctxGrads, {
                type: '{{ $gradChart->type }}',
                data: {
                    labels: {!! json_encode($gradChart->labels) !!},
                    datasets: {!! json_encode($gradChart->datasets) !!}
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                            labels: { color: '#64748b' }
                        }
                    },
                    scales: {
                        y: { grid: { color: 'rgba(255, 255, 255, 0.05)' }, ticks: { color: '#94a3b8' } },
                        x: { grid: { display: false }, ticks: { color: '#94a3b8' } }
                    }
                }
            });
        @endif

        // Institutional Mix Chart
        @php $mixChart = $page->charts->where('identifier', 'institutionMixChart')->first(); @endphp
        @if($mixChart)
            const ctxMix = document.getElementById('institutionMixChart').getContext('2d');
            new Chart(ctxMix, {
                type: '{{ $mixChart->type }}',
                data: {
                    labels: {!! json_encode($mixChart->labels) !!},
                    datasets: {!! json_encode($mixChart->datasets) !!}
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: { color: '#94a3b8', padding: 20 }
                        }
                    },
                    cutout: '60%'
                }
            });
        @endif
    </script>
@endsection