@extends('layouts.dashboard')

@section('title', 'Business Profile')
@section('page-title', 'Business & Employment Profile')

@section('content')
    <div class="kpi-grid">
        <div class="kpi-card">
            <span class="label">Total Establishments (2023)</span>
            <span class="value">85,644</span>
            <div class="trend up"><i data-lucide="trending-up"></i> 16.1% increase</div>
        </div>
        <div class="kpi-card">
            <span class="label">Total Employment (2023)</span>
            <span class="value">530,194</span>
            <div class="trend up"><i data-lucide="trending-up"></i> 19.3% increase</div>
        </div>
        <div class="kpi-card">
            <span class="label">MSME Dominance</span>
            <span class="value">99% +</span>
            <div class="trend"><i data-lucide="info"></i> Service sector leads (86.9%)</div>
        </div>
    </div>

    <div class="visuals-grid">
        <!-- BN Registration Trend -->
        <div class="visual-container">
            <div class="visual-header">
                <h3>📈 DTI Business Name Registration (2022–2025)</h3>
                <i data-lucide="line-chart"></i>
            </div>
            <div class="chart-wrapper">
                <canvas id="bnRegistrationChart"></canvas>
            </div>
        </div>

        <!-- Establishments by Province -->
        <div class="visual-container">
            <div class="visual-header">
                <h3>📊 Establishments by Province</h3>
                <i data-lucide="building-2"></i>
            </div>
            <div class="chart-wrapper">
                <canvas id="establishmentsChart"></canvas>
            </div>
        </div>

        <!-- MSME vs Large Table -->
        <div class="visual-container full-width">
            <div class="visual-header">
                <h3>📋 MSMEs vs Large Enterprises</h3>
                <i data-lucide="table"></i>
            </div>
            <table class="premium-table">
                <thead>
                    <tr>
                        <th>Province / Category</th>
                        <th>Micro</th>
                        <th>Small</th>
                        <th>Medium</th>
                        <th>Large</th>
                        <th>Total Count</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Iloilo</td>
                        <td>12,450</td>
                        <td>1,200</td>
                        <td>150</td>
                        <td>45</td>
                        <td>13,845</td>
                    </tr>
                    <tr>
                        <td>Negros Occidental*</td>
                        <td>15,600</td>
                        <td>1,450</td>
                        <td>180</td>
                        <td>70</td>
                        <td>17,300</td>
                    </tr>
                    <tr>
                        <td>Aklan</td>
                        <td>6,200</td>
                        <td>450</td>
                        <td>60</td>
                        <td>20</td>
                        <td>6,730</td>
                    </tr>
                    <tr>
                        <td>Capiz</td>
                        <td>5,800</td>
                        <td>380</td>
                        <td>50</td>
                        <td>15</td>
                        <td>6,245</td>
                    </tr>
                    <tr>
                        <td>Antique</td>
                        <td>4,500</td>
                        <td>210</td>
                        <td>35</td>
                        <td>8</td>
                        <td>4,753</td>
                    </tr>
                    <tr>
                        <td>Guimaras</td>
                        <td>1,800</td>
                        <td>95</td>
                        <td>12</td>
                        <td>2</td>
                        <td>1,909</td>
                    </tr>
                </tbody>
            </table>
            <p style="font-size: 0.75rem; color: var(--text-secondary); margin-top: 1rem;">*Data reflects historical
                inclusion in Region VI reporting structure.</p>
        </div>
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
            // BN Registration Trend (Line)
            const ctxBN = document.getElementById('bnRegistrationChart').getContext('2d');
            new Chart(ctxBN, {
                type: 'line',
                data: {
                    labels: ['2022', '2023', '2024', '2025(P)'],
                    datasets: [{
                        label: 'Registrations',
                        data: [65400, 71289, 68500, 72000],
                        borderColor: 'rgba(56, 189, 248, 1)',
                        backgroundColor: 'rgba(56, 189, 248, 0.1)',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { labels: { color: '#94a3b8' } }
                    },
                    scales: {
                        y: { grid: { color: 'rgba(255, 255, 255, 0.05)' }, ticks: { color: '#94a3b8' } },
                        x: { grid: { display: false }, ticks: { color: '#94a3b8' } }
                    }
                }
            });

            // Establishments by Province (Bar)
            const ctxEst = document.getElementById('establishmentsChart').getContext('2d');
            new Chart(ctxEst, {
                type: 'bar',
                data: {
                    labels: ['Iloilo', 'Neg Occ', 'Aklan', 'Capiz', 'Antique', 'Guimaras'],
                    datasets: [{
                        label: 'Total Establishments',
                        data: [13845, 17300, 6730, 6245, 4753, 1909],
                        backgroundColor: 'rgba(56, 189, 248, 0.6)',
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