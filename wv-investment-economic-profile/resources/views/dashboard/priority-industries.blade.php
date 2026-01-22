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
                <option value="bamboo">Bamboo</option>
                <option value="coffee">Coffee</option>
                <option value="cacao">Cacao</option>
                <option value="fruits_nuts">Processed Fruits & Nuts</option>
                <option value="coconut">Coconut</option>
                <option value="wearables">Wearables & Homestyle</option>
                <option value="it_bpm">IT-BPM</option>
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
                <button class="cluster-btn active" data-cluster="bamboo" onclick="updateCluster('bamboo')">Bamboo</button>
                <button class="cluster-btn" data-cluster="coffee" onclick="updateCluster('coffee')">Coffee</button>
                <button class="cluster-btn" data-cluster="cacao" onclick="updateCluster('cacao')">Cacao</button>
                <button class="cluster-btn" data-cluster="fruits_nuts" onclick="updateCluster('fruits_nuts')">Processed
                    Fruits & Nuts</button>
                <button class="cluster-btn" data-cluster="coconut" onclick="updateCluster('coconut')">Coconut</button>
                <button class="cluster-btn" data-cluster="wearables" onclick="updateCluster('wearables')">Wearables &
                    Homestyle</button>
                <button class="cluster-btn" data-cluster="it_bpm" onclick="updateCluster('it_bpm')">IT-BPM</button>
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
    </div>
@endsection

@section('scripts')
    <script>
        const clusterData = {
            bamboo: {
                title: "Bamboo Industry",
                kpis: [
                    { label: "Bamboo Area (2022)", value: "8,450 ha", trend: "Growth Area", icon: "trending-up", status: "up" },
                    { label: "MSMEs Assisted", value: "156", trend: "Active Support", icon: "award", status: "up" },
                    { label: "Key Product", value: "Engineered", trend: "Export Ready", icon: "package", status: "" }
                ],
                chart: {
                    labels: ['2020', '2021', '2022', '2023', '2024'],
                    data: [6400, 7500, 8450, 9100, 9800],
                    label: "Hectares Planted"
                },
                details: [
                    ["Key Commodities", "Engineered Bamboo, Bamboo Shoots, Furniture"],
                    ["Investment Focus", "Processing Plants, Plantation Development"],
                    ["Target Market", "Local Construction, Export (Europe/US)"],
                    ["Regional Status", "Strategic priority for sustainable development"]
                ]
            },
            coffee: {
                title: "Coffee Industry",
                kpis: [
                    { label: "Production (2024)", value: "1,200 MT", trend: "8% Growth", icon: "trending-up", status: "up" },
                    { label: "Coffee Farmers", value: "1,850", trend: "Technical Support", icon: "users", status: "" },
                    { label: "Variety", value: "Robusta", trend: "Main Crop", icon: "coffee", status: "" }
                ],
                chart: {
                    labels: ['2020', '2021', '2022', '2023', '2024'],
                    data: [950, 1020, 1080, 1150, 1200],
                    label: "Production (Metric Tons)"
                },
                details: [
                    ["Key Commodities", "Robusta, Liberica Beans"],
                    ["Investment Focus", "Quality Post-harvest facilities, Roasting"],
                    ["Target Market", "Local Specialty Cafes, Institutional Buyers"],
                    ["Status", "High priority for mountainous areas (Panay/Negros)"]
                ]
            },
            cacao: {
                title: "Cacao Industry",
                kpis: [
                    { label: "Production (2024)", value: "580 MT", trend: "15% Growth", icon: "trending-up", status: "up" },
                    { label: "Processors", value: "32", trend: "Award-winning", icon: "award", status: "" },
                    { label: "Area", value: "1,450 ha", trend: "New Plantations", icon: "map", status: "up" }
                ],
                chart: {
                    labels: ['2020', '2021', '2022', '2023', '2024'],
                    data: [320, 380, 450, 520, 580],
                    label: "Production (Metric Tons)"
                },
                details: [
                    ["Key Commodities", "Fermented Beans, Tablea, Dark Chocolate"],
                    ["Investment Focus", "Commercial-scale fermentation, Processing"],
                    ["Target Market", "Artisanal Chocolatiers, Export Markets"],
                    ["DTI Support", "Market linking with high-end confectioners"]
                ]
            },
            fruits_nuts: {
                title: "Processed Fruits & Nuts",
                kpis: [
                    { label: "Cluster MSMEs", value: "482", trend: "Strong Network", icon: "building-2", status: "" },
                    { label: "Export Value", value: "$4.2M", trend: "UP 8% YoY", icon: "trending-up", status: "up" },
                    { label: "Main Crop", value: "Mango", trend: "Guimaras Pride", icon: "sun", status: "" }
                ],
                chart: {
                    labels: ['2020', '2021', '2022', '2023', '2024'],
                    data: [3.1, 3.4, 3.8, 4.0, 4.2],
                    label: "Export Value ($ Million)"
                },
                details: [
                    ["Key Commodities", "Dried Mango, Cashew, Pineapple"],
                    ["Investment Focus", "Value-added processing, cold chain logistics"],
                    ["Target Market", "Asia-Pacific, USA, Local Retail"],
                    ["Key Hub", "Guimaras (Mango), Antique (Cashew)"]
                ]
            },
            coconut: {
                title: "Coconut Industry",
                kpis: [
                    { label: "Q3 2024 Production", value: "136k MT", trend: "Top Crop", icon: "award", status: "up" },
                    { label: "Halal Ready", value: "45", trend: "Establishments", icon: "check-circle", status: "" },
                    { label: "Value Addition", value: "Medium", trend: "Strategic Focus", icon: "info", status: "" }
                ],
                chart: {
                    labels: ['2020', '2021', '2022', '2023', '2024'],
                    data: [128, 131, 133, 135, 136.5],
                    label: "Production (Thousand Metric Tons)"
                },
                details: [
                    ["Key Commodities", "Copra, Virgin Coconut Oil, Coconut Sugar"],
                    ["Investment Focus", "High-value processing, Halal certification"],
                    ["Target Market", "Global Wellness Market, Halal Export"],
                    ["Status", "Foremost crop in WV in 2024"]
                ]
            },
            wearables: {
                title: "Wearables & Homestyle",
                kpis: [
                    { label: "Artisans Supported", value: "1,200+", trend: "Active Base", icon: "users", status: "" },
                    { label: "Creative Hubs", value: "12", trend: "Regional Hubs", icon: "map-pin", status: "" },
                    { label: "Fiber Types", value: "4", trend: "High Value", icon: "leaf", status: "up" }
                ],
                chart: {
                    labels: ['2021', '2022', '2023', '2024', '2025(P)'],
                    data: [45, 52, 68, 75, 85],
                    label: "Assisted Creative MSMEs"
                },
                details: [
                    ["Key Commodities", "Piña Cloth, Hablon, Bamboo Wearables"],
                    ["Investment Focus", "Design innovation, digital marketing"],
                    ["Target Market", "High-end Fashion, Eco-conscious consumers"],
                    ["Key Event", "Panubli-on Trade Fair"]
                ]
            },
            it_bpm: {
                title: "IT-BPM Sector",
                kpis: [
                    { label: "Estimated Jobs", value: "45k+", trend: "Rapid Expansion", icon: "user-plus", status: "up" },
                    { label: "Tech Parks", value: "7", trend: "PEZA Centers", icon: "shield-check", status: "" },
                    { label: "Focus", value: "Next Gen", trend: "AI/Analytics", icon: "cpu", status: "up" }
                ],
                chart: {
                    labels: ['2020', '2021', '2022', '2023', '2024'],
                    data: [28, 32, 38, 42, 45],
                    label: "Direct Employment (Thousands)"
                },
                details: [
                    ["Key Services", "Customer Support, Software Dev, Game Dev"],
                    ["Investment Focus", "AI optimization, creative tech"],
                    ["Target Market", "North America, Australia, Global Tech"],
                    ["Local Hubs", "Iloilo City (Atria Gardens, The Grid)"]
                ]
            }
        };

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

        // Initialize with Bamboo
        document.addEventListener('DOMContentLoaded', () => {
            updateCluster('bamboo');
        });
    </script>
@endsection