@extends('layouts.dashboard')

@section('title', 'Infrastructure')
@section('page-title', 'Infrastructure & Connectivity')

@section('content')
    <div class="kpi-grid">
        <div class="kpi-card">
            <span class="label">Airports</span>
            <span class="value">9</span>
            <div class="trend"><i data-lucide="plane"></i> Major & Community</div>
        </div>
        <div class="kpi-card">
            <span class="label">Sea Ports</span>
            <span class="value">152</span>
            <div class="trend"><i data-lucide="ship"></i> Strategic Hubs</div>
        </div>
        <div class="kpi-card">
            <span class="label">Cell Towers</span>
            <span class="value">1,027</span>
            <div class="trend up"><i data-lucide="signal"></i> Connectivity</div>
        </div>
        <div class="kpi-card">
            <span class="label">Wi-Fi Hotspots</span>
            <span class="value">293</span>
            <div class="trend"><i data-lucide="wifi"></i> Public Access</div>
        </div>
    </div>

    <div class="visuals-grid">
        <!-- Logistics Map Placeholder -->
        <div class="visual-container">
            <div class="visual-header">
                <h3>📍 Airports & Ports Distribution</h3>
                <i data-lucide="map-pin"></i>
            </div>
            <div class="map-wrapper">
                <div id="infra-map"></div>
            </div>
            <div style="margin-top: 1.5rem; display: flex; gap: 2rem;">
                <div>
                    <span style="font-size: 0.75rem; color: var(--text-secondary);">International Hubs:</span>
                    <p style="font-weight: 600; margin-top: 0.25rem;">Iloilo, Kalibo</p>
                </div>
                <div>
                    <span style="font-size: 0.75rem; color: var(--text-secondary);">Major Ports:</span>
                    <p style="font-weight: 600; margin-top: 0.25rem;">Iloilo, Dumangas</p>
                </div>
            </div>
        </div>

        <!-- Connectivity Table/Stats -->
        <div class="visual-container">
            <div class="visual-header">
                <h3>🌐 Digital Readiness</h3>
                <i data-lucide="globe"></i>
            </div>
            <div style="margin-top: 1rem;">
                <div class="stat-row"
                    style="display: flex; justify-content: space-between; padding: 1rem 0; border-bottom: 1px solid var(--border);">
                    <span>Fiber Optic Lines (Backbone)</span>
                    <span style="font-weight: 600;">20 Major Lines</span>
                </div>
                <div class="stat-row"
                    style="display: flex; justify-content: space-between; padding: 1rem 0; border-bottom: 1px solid var(--border);">
                    <span>Tech Hub Presence</span>
                    <span style="font-weight: 600;">5 Rated Tech Parks</span>
                </div>
                <div class="stat-row"
                    style="display: flex; justify-content: space-between; padding: 1rem 0; border-bottom: 1px solid var(--border);">
                    <span>Average Internet Speed (Region)</span>
                    <span style="font-weight: 600;">45.5 Mbps</span>
                </div>
            </div>
            <div
                style="margin-top: 2rem; padding: 1rem; background: rgba(255,255,255,0.03); border-radius: 0.75rem; font-size: 0.875rem; color: var(--text-secondary);">
                <i data-lucide="info" style="width: 16px; height: 16px; vertical-align: middle; margin-right: 0.5rem;"></i>
                Strategic investment in digital infra has made WV a top choice for BPO expansion outside Metro Manila.
            </div>
        </div>
        <div class="sources-section">
            <h3><i data-lucide="library"></i> Data Sources & References</h3>
            <div class="sources-list">
                <div class="source-item">
                    <span class="title">Civil Aviation Authority of the Philippines (CAAP)</span>
                    <a href="https://www.caap.gov.ph" target="_blank" class="link">https://www.caap.gov.ph</a>
                    <p class="description">Source for airport classification and flight passenger statistics in the region.
                    </p>
                </div>
                <div class="source-item">
                    <span class="title">Philippine Ports Authority (PPA)</span>
                    <a href="https://www.ppa.com.ph" target="_blank" class="link">https://www.ppa.com.ph</a>
                    <p class="description">Primary source for sea port distribution and cargo throughput data for Panay and
                        Guimaras.</p>
                </div>
                <div class="source-item">
                    <span class="title">Dept. of Information and Communications Technology (DICT)</span>
                    <a href="https://dict.gov.ph" target="_blank" class="link">https://dict.gov.ph</a>
                    <p class="description">Source for digital connectivity stats, fiber backbone mapping, and public Wi-Fi
                        hotspots.</p>
                </div>
            </div>
        </div>
@endsection

    @section('scripts')
        <script>
            // Infrastructure Map Initialization - Locked to Western Visayas
            const westVisayasBounds = L.latLngBounds([9.0, 121.0], [12.5, 124.0]);

            const infraMap = L.map('infra-map', {
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
            }).addTo(infraMap);



            const hubs = [
                {
                    name: "Iloilo International Airport",
                    coords: [10.8290, 122.4933],
                    type: "Airport",
                    color: "#38bdf8",
                    data: "<strong>Role:</strong> Main gateway to Western Visayas.<br><strong>Status:</strong> International Hub"
                },
                {
                    name: "Kalibo International Airport",
                    coords: [11.6783, 122.3783],
                    type: "Airport",
                    color: "#38bdf8",
                    data: "<strong>Role:</strong> Primary gateway to Boracay Island."
                },
                {
                    name: "Roxas Airport",
                    coords: [11.5975, 122.7111],
                    type: "Airport",
                    color: "#38bdf8",
                    data: "<strong>Role:</strong> Serving Capiz and Northern Panay."
                },
                {
                    name: "Iloilo Port",
                    coords: [10.6925, 122.5800],
                    type: "Port",
                    color: "#fbbf24",
                    data: "<strong>Role:</strong> Major hub for domestic and regional trade."
                },
                {
                    name: "Dumangas Port",
                    coords: [10.8167, 122.7500],
                    type: "Port",
                    color: "#fbbf24",
                    data: "<strong>Role:</strong> Strategic Ro-Ro connection to Negros Island."
                }
            ];

            hubs.forEach(hub => {
                const marker = L.circleMarker(hub.coords, {
                    radius: 8,
                    fillColor: hub.color,
                    color: "#fff",
                    weight: 1,
                    opacity: 1,
                    fillOpacity: 0.8
                }).addTo(infraMap);

                marker.bindTooltip(hub.name, {
                    permanent: true,
                    direction: 'top',
                    className: 'leaflet-tooltip-custom',
                    offset: [0, -8]
                });

                marker.bindPopup(`
                                                                <div style="padding: 0.5rem;">
                                                                    <h4 style="margin: 0 0 0.5rem 0; color: ${hub.color}; border-bottom: 1px solid var(--border); padding-bottom: 0.25rem;">${hub.name}</h4>
                                                                    <div style="font-size: 0.875rem;">${hub.data}</div>
                                                                </div>
                                                            `);
            });
        </script>
    @endsection