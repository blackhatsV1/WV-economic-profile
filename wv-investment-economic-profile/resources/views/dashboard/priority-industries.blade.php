@extends('layouts.dashboard')

@section('title', 'Priority Industries')
@section('page-title', 'Priority Industries & Investment Opportunities')

@section('content')
    <!-- Slicers Simulation -->
    <div class="filters-bar"
        style="margin-bottom: 2rem; display: flex; gap: 1.5rem; background: var(--glass); padding: 1rem; border-radius: 0.75rem; border: 1px solid var(--border);">
        <div class="filter-group">
            <label
                style="font-size: 0.75rem; color: var(--text-secondary); display: block; margin-bottom: 0.25rem;">Industry
                Cluster</label>
            <select id="cluster-dropdown" onchange="updateCluster(this.value)"
                style="background: var(--bg-dark); color: var(--text-primary); border: 1px solid var(--border); padding: 0.5rem; border-radius: 0.4rem; min-width: 150px;">
                @foreach($clusters as $cluster)
                    <option value="{{ $cluster->slug }}">{{ $cluster->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="filter-group">
            <label
                style="font-size: 0.75rem; color: var(--text-secondary); display: block; margin-bottom: 0.25rem;">Province</label>
            <select
                style="background: var(--bg-dark); color: var(--text-primary); border: 1px solid var(--border); padding: 0.5rem; border-radius: 0.4rem; min-width: 150px;">
                <option>All Provinces</option>
                <option>Iloilo</option>
                <option>Aklan</option>
                <option>Capiz</option>
            </select>
        </div>
    </div>

    <div class="kpi-grid">
        <div class="kpi-card">
            <span class="label" id="kpi-1-label">---</span>
            <span class="value" id="kpi-1-value">---</span>
            <div id="kpi-1-trend" class="trend">---</div>
        </div>
        <div class="kpi-card">
            <span class="label" id="kpi-2-label">---</span>
            <span class="value" id="kpi-2-value">---</span>
            <div id="kpi-2-trend" class="trend">---</div>
        </div>
        <div class="kpi-card">
            <span class="label" id="kpi-3-label">---</span>
            <span class="value" id="kpi-3-value">---</span>
            <div id="kpi-3-trend" class="trend">---</div>
        </div>
    </div>

    <div class="visuals-grid">
        <!-- Main Cluster Chart -->
        <div class="visual-container full-width">
            <div class="visual-header">
                <h3 id="chart-title">📊 Bamboo Industry Growth Trend</h3>
                <i data-lucide="bar-chart-3"></i>
            </div>
            <div class="chart-wrapper" style="height: 350px;">
                <canvas id="clusterMainChart"></canvas>
            </div>
        </div>

        <!-- Clusters Table for Selection -->
        <div class="visual-container full-width">
            <div class="visual-header">
                <h3>📋 Western Visayas Priority Clusters (Click to explore)</h3>
                <i data-lucide="mouse-pointer-2"></i>
            </div>
            <div class="clusters-selector"
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
                @foreach($clusters as $cluster)
                    <button class="cluster-btn {{ $loop->first ? 'active' : '' }}" data-cluster="{{ $cluster->slug }}"
                        onclick="updateCluster('{{ $cluster->slug }}')">{{ $cluster->name }}</button>
                @endforeach
            </div>
            <table class="premium-table" id="cluster-details-table">
                <thead>
                    <tr>
                        <th>Feature</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody id="cluster-table-body">
                    <!-- Dynamic Content -->
                </tbody>
            </table>
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
        const clusterData = {!! json_encode($clusters->keyBy('slug')->map(function ($c) {
        return [
            'title' => $c->title,
            'kpis' => $c->kpis,
            'chart' => $c->chart_data,
            'details' => $c->details
        ];
    })) !!};

        let mainChart;

        function updateCluster(key) {
            const data = clusterData[key];
            if (!data) return;

            // Update Buttons and Dropdown
            document.querySelectorAll('.cluster-btn').forEach(btn => {
                btn.classList.toggle('active', btn.getAttribute('data-cluster') === key);
            });
            document.getElementById('cluster-dropdown').value = key;

            // Update KPIs
            for (let i = 0; i < 3; i++) {
                const kpi = data.kpis[i];
                document.getElementById(`kpi-${i + 1}-label`).innerText = kpi.label;
                document.getElementById(`kpi-${i + 1}-value`).innerHTML = kpi.value;
                const trendEl = document.getElementById(`kpi-${i + 1}-trend`);
                trendEl.className = `trend ${kpi.status || ''}`;
                trendEl.innerHTML = `<i data-lucide="${kpi.icon}"></i> ${kpi.trend}`;
            }

            // Update Chart
            document.getElementById('chart-title').innerText = `📊 ${data.title} Growth Trend`;
            if (mainChart) mainChart.destroy();

            const ctx = document.getElementById('clusterMainChart').getContext('2d');
            mainChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.chart.labels,
                    datasets: [{
                        label: data.chart.label,
                        data: data.chart.data,
                        backgroundColor: 'rgba(56, 189, 248, 0.6)',
                        borderRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            labels: { color: '#94a3b8', font: { family: 'Outfit' } }
                        }
                    },
                    scales: {
                        y: {
                            grid: { color: 'rgba(255, 255, 255, 0.05)' },
                            ticks: { color: '#94a3b8' }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { color: '#94a3b8' }
                        }
                    }
                }
            });

            // Update Table
            const tableBody = document.getElementById('cluster-table-body');
            tableBody.innerHTML = '';
            data.details.forEach(row => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                                                <td style="color: var(--accent); font-weight: 600; width: 30%;">${row[0]}</td>
                                                <td>${row[1]}</td>
                                            `;
                tableBody.appendChild(tr);
            });

            // Refresh Icons
            lucide.createIcons();
        }

        // Initialize with first cluster
        document.addEventListener('DOMContentLoaded', () => {
            const firstCluster = '{{ $clusters->first()->slug }}';
            updateCluster(firstCluster);
        });
    </script>
@endsection