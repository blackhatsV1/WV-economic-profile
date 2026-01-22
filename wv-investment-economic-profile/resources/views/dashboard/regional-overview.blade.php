@extends('layouts.dashboard')

@section('title', 'Regional Overview')
@section('page-title', 'Regional Overview (Executive Summary)')

@section('content')
    <div class="kpi-grid">
        <div class="kpi-card">
            <span class="label">Population (2024)</span>
            <span class="value">4,861,911</span>
            <div class="trend up"><i data-lucide="trending-up"></i> Census 2024</div>
        </div>
        <div class="kpi-card">
            <span class="label">Land Area</span>
            <span class="value">20,794 <small>sq. km</small></span>
        </div>
        <div class="kpi-card">
            <span class="label">Density</span>
            <span class="value">370 / km²</span>
        </div>
        <div class="kpi-card">
            <span class="label">GRDP (2024)</span>
            <span class="value">₱641.76B</span>
            <div class="trend up"><i data-lucide="trending-up"></i> 4.3% Growth</div>
        </div>
        <div class="kpi-card">
            <span class="label">Share to PH GDP</span>
            <span class="value">2.9%</span>
        </div>
    </div>

    <div class="visuals-grid">
        <!-- Map Section -->
        <div class="visual-container">
            <div class="visual-header">
                <h3>📍 Regional Profile & Geography</h3>
                <i data-lucide="map-pin"></i>
            </div>
            <div class="map-wrapper">
                <div id="map"></div>
            </div>
            <div
                style="margin-top: 1rem; color: var(--text-secondary); line-height: 1.5; padding: 0 0.5rem; font-size: 0.875rem;">
                Region VI is located in Central Philippines. 2024 economic data reflects the region following the
                Negros Island Region (NIR) Act.
            </div>
            <div style="margin-top: 1.5rem; color: var(--text-secondary); font-size: 0.9rem;">
                <p><strong>Provinces:</strong> Aklan, Antique, Capiz, Guimaras, Iloilo</p>
                <p style="margin-top: 0.5rem;"><strong>Regional Center:</strong> Iloilo City</p>
                <p style="margin-top: 0.5rem; font-size: 0.75rem;">*Negros Occidental & Bacolod City data reported
                    separately for 2024.</p>
            </div>
        </div>

        <!-- Chart Section -->
        <div class="visual-container">
            <div class="visual-header">
                <h3>📊 GRDP Growth (2023 vs 2024)</h3>
                <i data-lucide="bar-chart"></i>
            </div>
            <div class="chart-wrapper">
                <canvas id="grdpGrowthChart"></canvas>
            </div>
            <div style="margin-top: 1.5rem;">
                <p style="font-size: 0.875rem; color: var(--text-secondary);">The region ranked 8th largest economy in the
                    Philippines in 2024.</p>
            </div>
        </div>

        <!-- Economic Contribution by Area -->
        <div class="visual-container full-width">
            <div class="visual-header">
                <h3>💰 Economic Contribution by Area (2024)</h3>
                <i data-lucide="pie-chart"></i>
            </div>
            <div class="chart-wrapper" style="height: 400px;">
                <canvas id="areaContributionChart"></canvas>
            </div>
        </div>
        <div class="sources-section">
            <h3><i data-lucide="library"></i> Data Sources & References</h3>
            <div class="sources-list">
                <div class="source-item">
                    <span class="title">Philippine Statistics Authority (PSA)</span>
                    <a href="https://psa.gov.ph" target="_blank" class="link">https://psa.gov.ph</a>
                    <p class="description">Primary source for Census (2024), GRDP growth rates, and regional economic
                        accounts.</p>
                </div>
                <div class="source-item">
                    <span class="title">DTI Region VI (Western Visayas)</span>
                    <a href="https://www.dti.gov.ph/regions/region-6/" target="_blank"
                        class="link">https://www.dti.gov.ph/regions/region-6/</a>
                    <p class="description">Source for regional investment priorities and industry cluster mappings.</p>
                </div>
                <div class="source-item">
                    <span class="title">National Economic and Development Authority (NEDA)</span>
                    <a href="https://neda.gov.ph" target="_blank" class="link">https://neda.gov.ph</a>
                    <p class="description">Regional development plans and macroeconomic targets for Western Visayas.</p>
                </div>
            </div>
        </div>
@endsection

    @section('scripts')
        <script>
            // GRDP Growth Chart
            const ctxGrdp = document.getElementById('grdpGrowthChart').getContext('2d');
            new Chart(ctxGrdp, {
                type: 'bar',
                data: {
                    labels: ['2023', '2024'],
                    datasets: [{
                        label: 'GRDP (₱ Billion)',
                        data: [615.3, 641.76],
                        backgroundColor: ['rgba(56, 189, 248, 0.2)', 'rgba(56, 189, 248, 0.8)'],
                        borderColor: ['rgba(56, 189, 248, 1)', 'rgba(56, 189, 248, 1)'],
                        borderWidth: 1,
                        borderRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: false,
                            min: 550,
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

            // Economic Contribution by Area (Doughnut)
            const ctxArea = document.getElementById('areaContributionChart').getContext('2d');
            new Chart(ctxArea, {
                type: 'doughnut',
                data: {
                    labels: ['Iloilo Province', 'Iloilo City', 'Capiz', 'Antique', 'Aklan', 'Guimaras'],
                    datasets: [{
                        data: [34.1, 26.7, 13, 11.8, 11.5, 2.8],
                        backgroundColor: [
                            '#38bdf8',
                            '#0ea5e9',
                            '#0284c7',
                            '#0369a1',
                            '#075985',
                            '#0c4a6e'
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
                            position: 'right',
                            labels: { color: '#94a3b8', padding: 20 }
                        }
                    },
                    cutout: '65%'
                }
            });

            // Interactive Map Initialization - Locked to Western Visayas
            const westVisayasBounds = L.latLngBounds([9.0, 121.0], [12.5, 124.0]);

            const map = L.map('map', {
                center: [11.0, 122.5],
                zoom: 8,
                minZoom: 8,
                maxZoom: 11,
                maxBounds: westVisayasBounds,
                maxBoundsViscosity: 1.0
            });

            // Use CartoDB Voyager - A vibrant, professional "OpenStreetMap" based layer
            L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager_labels_under/{z}/{x}/{y}{r}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
                subdomains: 'abcd',
                maxZoom: 20
            }).addTo(map);



            const areas = [
                {
                    name: "Iloilo Province",
                    coords: [11.0, 122.5],
                    color: "#38bdf8",
                    data: "<strong>Share:</strong> 34.1%<br><strong>Focus:</strong> Agriculture & Services"
                },
                {
                    name: "Iloilo City",
                    coords: [10.7202, 122.5621],
                    color: "#0ea5e9",
                    data: "<strong>Share:</strong> 26.7%<br><strong>Growth:</strong> 7.1% (Fastest)<br><strong>Focus:</strong> Trade & Real Estate"
                },
                {
                    name: "Aklan",
                    coords: [11.55, 122.3683],
                    color: "#075985",
                    data: "<strong>Share:</strong> 11.5%<br><strong>Focus:</strong> Tourism & Services"
                },
                {
                    name: "Antique",
                    coords: [11.0, 122.0],
                    color: "#0369a1",
                    data: "<strong>Share:</strong> 11.8%<br><strong>Focus:</strong> Agriculture & Fishing"
                },
                {
                    name: "Capiz",
                    coords: [11.4, 122.7],
                    color: "#0284c7",
                    data: "<strong>Share:</strong> 13.0%<br><strong>Focus:</strong> Seafood & Agriculture"
                },
                {
                    name: "Guimaras",
                    coords: [10.5929, 122.6325],
                    color: "#0c4a6e",
                    data: "<strong>Share:</strong> 2.8%<br><strong>Status:</strong> Most Competitive Province"
                }
            ];

            areas.forEach(area => {
                const marker = L.circleMarker(area.coords, {
                    radius: 10,
                    fillColor: area.color,
                    color: "#fff",
                    weight: 1,
                    opacity: 1,
                    fillOpacity: 0.8
                }).addTo(map);

                marker.bindTooltip(area.name, {
                    permanent: true,
                    direction: 'top',
                    className: 'leaflet-tooltip-custom',
                    offset: [0, -10]
                });

                marker.bindPopup(`
                                                                        <div style="padding: 0.5rem;">
                                                                            <h4 style="margin: 0 0 0.5rem 0; color: var(--accent); border-bottom: 1px solid var(--border); padding-bottom: 0.25rem;">${area.name}</h4>
                                                                            <div style="font-size: 0.875rem;">${area.data}</div>
                                                                        </div>
                                                                    `);
            });
        </script>
    @endsection