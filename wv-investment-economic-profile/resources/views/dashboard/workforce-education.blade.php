@extends('layouts.dashboard')

@section('title', 'Workforce & Education')
@section('page-title', 'Workforce & Education')

@section('content')
    <div class="kpi-grid">
        <div class="kpi-card">
            <span class="label">Total HEIs</span>
            <span class="value">102</span>
            <div class="trend"><i data-lucide="info"></i> Higher Education Institutions</div>
        </div>
        <div class="kpi-card">
            <span class="label">Total Graduates (AY 24-25)</span>
            <span class="value">20,391</span>
            <div class="trend up"><i data-lucide="graduation-cap"></i> Strong Talent Pool</div>
        </div>
        <div class="kpi-card">
            <span class="label">Public vs Private HEIs</span>
            <span class="value">46 SUCs | 49 Private</span>
            <div class="trend"><i data-lucide="landmark"></i> Balanced Ecosystem</div>
        </div>
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
                <div class="source-item">
                    <span class="title">Commission on Higher Education (CHED) - RO VI</span>
                    <a href="https://ched.gov.ph" target="_blank" class="link">https://ched.gov.ph</a>
                    <p class="description">Primary source for Higher Education Institutional data and graduate statistics
                        across disciplines.</p>
                </div>
                <div class="source-item">
                    <span class="title">Philippine Statistics Authority (PSA) - LFS</span>
                    <a href="https://psa.gov.ph" target="_blank" class="link">https://psa.gov.ph</a>
                    <p class="description">Source for Labor Force Survey (LFS) data, employment rates, and regional
                        workforce
                        demographics.</p>
                </div>
                <div class="source-item">
                    <span class="title">TESDA Region VI</span>
                    <a href="https://www.tesda.gov.ph" target="_blank" class="link">https://www.tesda.gov.ph</a>
                    <p class="description">Technical-Vocational Education and Training (TVET) statistics and certification
                        data for the region.</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Graduates by Discipline (Bar)
        const ctxGrads = document.getElementById('graduatesChart').getContext('2d');
        new Chart(ctxGrads, {
            type: 'bar',
            data: {
                labels: ['IT & Computing', 'Engineering/Tech', 'Business Admin', 'Medical/Allied', 'Education', 'Others'],
                datasets: [{
                    label: 'Graduates',
                    data: [4200, 3850, 5100, 4800, 2441, 0],
                    backgroundColor: 'rgba(56, 189, 248, 0.6)',
                    borderRadius: 8
                }]
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

        // Institutional Mix (Doughnut)
        const ctxMix = document.getElementById('institutionMixChart').getContext('2d');
        new Chart(ctxMix, {
            type: 'doughnut',
            data: {
                labels: ['SUCs (Public)', 'Private HEIs', 'Others'],
                datasets: [{
                    data: [46, 49, 7],
                    backgroundColor: [
                        'rgba(56, 189, 248, 0.8)',
                        'rgba(94, 163, 184, 0.6)',
                        'rgba(255, 255, 255, 0.1)'
                    ],
                    borderColor: 'var(--bg-dark)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { color: '#94a3b8', padding: 20 }
                    }
                },
                cutout: '70%'
            }
        });
    </script>
@endsection