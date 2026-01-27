@extends('layouts.dashboard')

@section('title', 'Infrastructure')
@section('page-title', 'Infrastructure & Connectivity')

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
                Strategic investment in digital infra has made Western Visayas a top choice for BPO expansion outside Metro
                Manila.
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
                // Infrastructure Map Initialization - Locked to Western Visayas
                const westVisayasBounds = L.latLngBounds([9.0, 121.0], [12.5, 124.0]);

                const map = L.map('infra-map', {
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

                const hubs = {!! json_encode($page->mapMarkers->map(function ($m) {
            return [
                'name' => $m->name,
                'coords' => [$m->lat, $m->lng],
                'type' => $m->type,
                'color' => $m->color,
                'data' => $m->data
            ];
        })) !!};

                hubs.forEach(hub => {
                    const marker = L.circleMarker(hub.coords, {
                        radius: hub.type === 'Airport' ? 12 : 8,
                        fillColor: hub.color,
                        color: "#fff",
                        weight: 2,
                        opacity: 1,
                        fillOpacity: 0.9
                    }).addTo(map);

                    marker.bindPopup(`
                            <div style="padding: 0.5rem; min-width: 200px;">
                                <span style="font-size: 0.65rem; text-transform: uppercase; color: var(--text-secondary); letter-spacing: 1px;">${hub.type}</span>
                                <h4 style="margin: 0.2rem 0 0.5rem 0; color: var(--accent); border-bottom: 1px solid var(--border); padding-bottom: 0.25rem;">${hub.name}</h4>
                                <div style="font-size: 0.875rem; color: #1e293b;">${hub.data}</div>
                            </div>
                        `);

                    marker.bindTooltip(hub.name, {
                        direction: 'top',
                        offset: [0, -10],
                        className: 'leaflet-tooltip-custom'
                    });
                });
            </script>
    @endsection