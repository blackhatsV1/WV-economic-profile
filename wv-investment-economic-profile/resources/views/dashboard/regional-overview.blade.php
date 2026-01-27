@extends('layouts.dashboard')

@section('title', 'Regional Overview')
@section('page-title', 'Regional Overview (Executive Summary)')

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
                // GRDP Growth Chart
                @php $grdpChart = $page->charts->where('identifier', 'grdpGrowthChart')->first(); @endphp
                @if($grdpChart)
                    const ctxGrdp = document.getElementById('grdpGrowthChart').getContext('2d');
                    new Chart(ctxGrdp, {
                        type: '{{ $grdpChart->type }}',
                        data: {
                            labels: {!! json_encode($grdpChart->labels) !!},
                            datasets: {!! json_encode($grdpChart->datasets) !!}
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
                @endif

                // Economic Contribution by Area (Doughnut)
                @php $areaChart = $page->charts->where('identifier', 'areaContributionChart')->first(); @endphp
                @if($areaChart)
                    const ctxArea = document.getElementById('areaContributionChart').getContext('2d');
                    new Chart(ctxArea, {
                        type: '{{ $areaChart->type }}',
                        data: {
                            labels: {!! json_encode($areaChart->labels) !!},
                            datasets: {!! json_encode($areaChart->datasets) !!}
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
                @endif

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

                L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager_labels_under/{z}/{x}/{y}{r}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
                    subdomains: 'abcd',
                    maxZoom: 20
                }).addTo(map);

                const areas = {!! json_encode($page->mapMarkers->map(function ($m) {
            return [
                'name' => $m->name,
                'coords' => [$m->lat, $m->lng],
                'color' => $m->color,
                'data' => $m->data
            ];
        })) !!};

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