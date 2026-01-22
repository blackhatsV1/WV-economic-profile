@extends('layouts.dashboard')

@section('title', 'Industry Contribution')
@section('page-title', 'Industry Contribution & Growth')

@section('content')
    <div class="kpi-grid">
        <div class="kpi-card">
            <span class="label">Fastest Growing Industry</span>
            <span class="value" style="font-size: 1.1rem;">Professional & Business Services</span>
            <div class="trend up"><i data-lucide="trending-up"></i> 13.7%</div>
        </div>
        <div class="kpi-card">
            <span class="label">Second Fastest</span>
            <span class="value">Utilities</span>
            <div class="trend up"><i data-lucide="trending-up"></i> 13.5%</div>
        </div>
        <div class="kpi-card">
            <span class="label">Social Work & Health</span>
            <span class="value">13.5% Growth</span>
            <div class="trend up"><i data-lucide="trending-up"></i> Top 3</div>
        </div>
        <div class="kpi-card" style="border-left: 4px solid #f87171;">
            <span class="label">AFF Sector</span>
            <span class="value">-7.3% Decline</span>
            <div class="trend down"><i data-lucide="trending-down"></i> Area for concern</div>
        </div>
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
                <div class="source-item">
                    <span class="title">Philippine Statistics Authority (PSA)</span>
                    <a href="https://psa.gov.ph" target="_blank" class="link">https://psa.gov.ph</a>
                    <p class="description">Core source for Industry Share to GDP and Sectoral Growth rates (2023-2024).</p>
                </div>
                <div class="source-item">
                    <span class="title">DTI Bureau of Industrial Strategy</span>
                    <a href="https://www.dti.gov.ph" target="_blank" class="link">https://www.dti.gov.ph</a>
                    <p class="description">Source for industrial performance reports and sector-specific growth analysis.
                    </p>
                </div>
            </div>
        </div>
@endsection

    @section('scripts')
        <script>
            // Industry Share Chart (Stacked Bar)
            const ctxShare = document.getElementById('industryShareChart').getContext('2d');
            new Chart(ctxShare, {
                type: 'bar',
                data: {
                    labels: ['Services', 'Industry', 'Agriculture (AFF)'],
                    datasets: [
                        {
                            label: '2023',
                            data: [61.2, 23.5, 15.3],
                            backgroundColor: 'rgba(94, 163, 184, 0.4)',
                        },
                        {
                            label: '2024',
                            data: [63.5, 24.1, 12.4],
                            backgroundColor: 'rgba(56, 189, 248, 0.8)',
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { labels: { color: '#94a3b8' } } },
                    scales: {
                        y: {
                            grid: { color: 'rgba(255, 255, 255, 0.05)' },
                            ticks: { color: '#94a3b8' },
                            title: { display: true, text: 'Share (%)', color: '#94a3b8' }
                        },
                        x: { grid: { display: false }, ticks: { color: '#94a3b8' } }
                    }
                }
            });

            // Industry Growth Chart (Horizontal Bar)
            const ctxGrowth = document.getElementById('industryGrowthChart').getContext('2d');
            new Chart(ctxGrowth, {
                type: 'bar',
                data: {
                    labels: ['Professional Services', 'Utilities', 'Health/Social Work', 'Tourism', 'Construction', 'AFF'],
                    datasets: [{
                        label: 'Growth Rate (%)',
                        data: [13.7, 13.5, 13.5, 10.4, 6.8, -7.3],
                        backgroundColor: (context) => {
                            const value = context.dataset.data[context.dataIndex];
                            return value < 0 ? 'rgba(248, 113, 113, 0.6)' : 'rgba(56, 189, 248, 0.6)';
                        },
                        borderRadius: 4
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        x: { grid: { color: 'rgba(255, 255, 255, 0.05)' }, ticks: { color: '#94a3b8' } },
                        y: { grid: { display: false }, ticks: { color: '#94a3b8' } }
                    }
                }
            });
        </script>
    @endsection