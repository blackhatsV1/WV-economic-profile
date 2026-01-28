@extends('layouts.dashboard')

@section('title', 'Edit ' . $page->title)
@section('page-title', 'Editing: ' . $page->title)

@section('content')
    <div style="margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center;">
        <div style="display: flex; gap: 1rem; align-items: center;">
            <a href="{{ route('admin.dashboard') }}"
                style="color: var(--accent); text-decoration: none; display: flex; align-items: center; gap: 8px;">
                <i data-lucide="arrow-left" style="width: 18px;"></i> Back to Dashboard
            </a>
            <form method="GET" action="{{ route('admin.page.edit', $page->id) }}"
                style="display: flex; align-items: center; gap: 8px;">
                <label style="color: var(--text-secondary); font-size: 0.875rem;">Year:</label>
                <select name="year" onchange="this.form.submit()"
                    style="background: var(--bg-dark); color: var(--text-primary); border: 1px solid var(--border); padding: 4px 8px; border-radius: 4px;">
                    @foreach(range(date('Y') + 1, 2020) as $y)
                        <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endforeach
                </select>
            </form>
        </div>
        <span style="font-size: 0.875rem; color: var(--text-secondary);">Last updated:
            {{ $page->updated_at->format('M d, Y H:i') }}</span>
    </div>

    <!-- KPI Management -->
    <div class="visual-container full-width">
        <div class="visual-header">
            <h3>📈 Content KPIs ({{ $year }})</h3>
            <button onclick="document.getElementById('add-kpi-modal').style.display='flex'"
                style="background: var(--accent); color: white; border: none; padding: 6px 16px; border-radius: 6px; cursor: pointer; font-size: 0.875rem;">+
                Add New KPI</button>
        </div>
        <div style="padding: 1.5rem;">
            <form action="{{ route('admin.kpi.batch-update') }}" method="POST">
                @csrf
                <input type="hidden" name="year" value="{{ $year }}">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr
                            style="text-align: left; color: var(--text-secondary); font-size: 0.75rem; border-bottom: 1px solid var(--border);">
                            <th style="padding: 8px;">Label</th>
                            <th style="padding: 8px;">Value</th>
                            <th style="padding: 8px;">Trend Text</th>
                            <th style="padding: 8px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($page->kpis as $index => $kpi)
                            <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                                <td style="padding: 8px;">
                                    <input type="hidden" name="kpis[{{ $index }}][id]" value="{{ $kpi->id }}">
                                    <input type="hidden" name="kpis[{{ $index }}][year]" value="{{ $year }}">
                                    <input type="text" name="kpis[{{ $index }}][label]" value="{{ $kpi->label }}"
                                        style="width: 100%; background: transparent; border: none; color: var(--text-primary); padding: 4px;">
                                </td>
                                <td style="padding: 8px;">
                                    <input type="text" name="kpis[{{ $index }}][value]" value="{{ $kpi->value }}"
                                        style="width: 100%; background: transparent; border: none; color: var(--text-primary); padding: 4px;">
                                </td>
                                <td style="padding: 8px;">
                                    <input type="text" name="kpis[{{ $index }}][trend_value]" value="{{ $kpi->trend_value }}"
                                        style="width: 100%; background: transparent; border: none; color: var(--text-primary); padding: 4px;">
                                </td>
                                <td style="padding: 8px;">
                                    <button type="button"
                                        onclick="if(confirm('Delete?')) document.getElementById('delete-kpi-{{ $kpi->id }}').submit()"
                                        style="color: #f87171; background: none; border: none; cursor: pointer;"><i
                                            data-lucide="trash-2" style="width: 14px;"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="margin-top: 1rem; text-align: right;">
                    <button type="submit"
                        style="background: var(--accent); color: white; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; font-weight: 600;">Save
                        All Changes</button>
                </div>
            </form>
            @foreach($page->kpis as $kpi)
                <form id="delete-kpi-{{ $kpi->id }}" action="{{ route('admin.kpi.destroy', $kpi->id) }}" method="POST"
                    style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            @endforeach
        </div>
    </div>
    </div>

    @if($page->tableData->count() > 0)
        <!-- Table Data Management -->
        <div class="visual-container full-width" style="margin-top: 2rem;">
            <div class="visual-header">
                <h3>📋 Table Content</h3>
                <i data-lucide="table"></i>
            </div>
            <div style="padding: 1.5rem;">
                @foreach($page->tableData as $table)
                    <div style="margin-bottom: 2rem;">
                        <h4 style="color: var(--accent); margin-bottom: 1rem;">{{ $table->title }}</h4>
                        <div
                            style="color: var(--text-secondary); font-size: 0.875rem; background: rgba(0,0,0,0.2); padding: 1rem; border-radius: 0.5rem; text-align: center;">
                            Table data editing is available in JSON format for power users.
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Map Markers Management (if applicable) -->
    @if($page->slug == 'infrastructure' || $page->slug == 'regional-overview')
        <div class="visual-container full-width" style="margin-top: 2rem;">
            <div class="visual-header">
                <h3>📍 Map Markers ({{ $year }})</h3>
                <button onclick="document.getElementById('add-marker-modal').style.display='flex'" style="background: var(--accent); color: white; border: none; padding: 6px 16px; border-radius: 6px; cursor: pointer; font-size: 0.875rem;">+ Add Marker</button>
            </div>
            <div style="padding: 1.5rem;">
                <form action="{{ route('admin.map-marker.batch-update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="year" value="{{ $year }}">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="text-align: left; color: var(--text-secondary); font-size: 0.75rem; border-bottom: 1px solid var(--border);">
                                <th style="padding: 8px;">Name</th>
                                <th style="padding: 8px;">Lat</th>
                                <th style="padding: 8px;">Lng</th>
                                <th style="padding: 8px;">Type</th>
                                <th style="padding: 8px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($page->mapMarkers as $index => $marker)
                                <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                                    <td style="padding: 8px;">
                                        <input type="hidden" name="markers[{{ $index }}][id]" value="{{ $marker->id }}">
                                        <input type="hidden" name="markers[{{ $index }}][year]" value="{{ $year }}">
                                        <input type="text" name="markers[{{ $index }}][name]" value="{{ $marker->name }}" style="width: 100%; background: transparent; border: none; color: var(--text-primary); padding: 4px;">
                                    </td>
                                    <td style="padding: 8px;">
                                        <input type="number" step="any" name="markers[{{ $index }}][lat]" value="{{ $marker->lat }}" style="width: 80px; background: transparent; border: none; color: var(--text-primary); padding: 4px;">
                                    </td>
                                    <td style="padding: 8px;">
                                        <input type="number" step="any" name="markers[{{ $index }}][lng]" value="{{ $marker->lng }}" style="width: 80px; background: transparent; border: none; color: var(--text-primary); padding: 4px;">
                                    </td>
                                    <td style="padding: 8px;">
                                        <input type="text" name="markers[{{ $index }}][type]" value="{{ $marker->type }}" style="width: 100%; background: transparent; border: none; color: var(--text-primary); padding: 4px;">
                                    </td>
                                    <td style="padding: 8px;">
                                        <button type="button" onclick="if(confirm('Delete?')) document.getElementById('delete-marker-{{ $marker->id }}').submit()" style="color: #f87171; background: none; border: none; cursor: pointer;"><i data-lucide="trash-2" style="width: 14px;"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div style="margin-top: 1rem; text-align: right;">
                        <button type="submit" style="background: var(--accent); color: white; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; font-weight: 600;">Save All Markers</button>
                    </div>
                </form>
                @foreach($page->mapMarkers as $marker)
                    <form id="delete-marker-{{ $marker->id }}" action="{{ route('admin.map-marker.destroy', $marker->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Data Sources Management -->
    <div class="visual-container full-width" style="margin-top: 2rem;">
        <div class="visual-header">
            <h3>🔗 Data Sources ({{ $year }})</h3>
            <button onclick="document.getElementById('add-source-modal').style.display='flex'" style="background: var(--accent); color: white; border: none; padding: 6px 16px; border-radius: 6px; cursor: pointer; font-size: 0.875rem;">+ Add Source</button>
        </div>
        <div style="padding: 1.5rem;">
            <form action="{{ route('admin.data-source.batch-update') }}" method="POST">
                @csrf
                <input type="hidden" name="year" value="{{ $year }}">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="text-align: left; color: var(--text-secondary); font-size: 0.75rem; border-bottom: 1px solid var(--border);">
                            <th style="padding: 8px;">Title</th>
                            <th style="padding: 8px;">URL</th>
                            <th style="padding: 8px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($page->dataSources as $index => $source)
                            <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                                <td style="padding: 8px;">
                                    <input type="hidden" name="sources[{{ $index }}][id]" value="{{ $source->id }}">
                                    <input type="hidden" name="sources[{{ $index }}][year]" value="{{ $year }}">
                                    <input type="text" name="sources[{{ $index }}][title]" value="{{ $source->title }}" style="width: 100%; background: transparent; border: none; color: var(--text-primary); padding: 4px;">
                                </td>
                                <td style="padding: 8px;">
                                    <input type="text" name="sources[{{ $index }}][url]" value="{{ $source->url }}" style="width: 100%; background: transparent; border: none; color: var(--text-primary); padding: 4px;">
                                </td>
                                <td style="padding: 8px;">
                                    <button type="button" onclick="if(confirm('Delete?')) document.getElementById('delete-source-{{ $source->id }}').submit()" style="color: #f87171; background: none; border: none; cursor: pointer;"><i data-lucide="trash-2" style="width: 14px;"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="margin-top: 1rem; text-align: right;">
                    <button type="submit" style="background: var(--accent); color: white; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; font-weight: 600;">Save All Sources</button>
                </div>
            </form>
            @foreach($page->dataSources as $source)
                <form id="delete-source-{{ $source->id }}" action="{{ route('admin.data-source.destroy', $source->id) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            @endforeach
        </div>
    </div>

    <!-- Modals -->
    <div id="add-kpi-modal"
        style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.8); z-index: 1000; align-items: center; justify-content: center; padding: 1rem;">
        <div
            style="background: var(--bg-dark); border: 1px solid var(--border); border-radius: 1.5rem; width: 100%; max-width: 500px; padding: 2rem;">
            <h3 style="margin-bottom: 1.5rem;">Add New KPI</h3>
            <form action="{{ route('admin.kpi.store', $page->id) }}" method="POST">
                @csrf
                <div style="display: grid; gap: 1rem;">
                    <div>
                        <label
                            style="display: block; font-size: 0.75rem; color: var(--text-secondary); margin-bottom: 0.5rem;">Label</label>
                        <input type="text" name="label" required
                            style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid var(--border); color: var(--text-primary); padding: 10px; border-radius: 8px;">
                    </div>
                    <div>
                        <label
                            style="display: block; font-size: 0.75rem; color: var(--text-secondary); margin-bottom: 0.5rem;">Value</label>
                        <input type="text" name="value" required
                            style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid var(--border); color: var(--text-primary); padding: 10px; border-radius: 8px;">
                    </div>
                    <div>
                        <label
                            style="display: block; font-size: 0.75rem; color: var(--text-secondary); margin-bottom: 0.5rem;">Trend
                            Text (Optional)</label>
                        <input type="text" name="trend_value"
                            style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid var(--border); color: var(--text-primary); padding: 10px; border-radius: 8px;">
                    </div>
                    <div style="display: flex; gap: 1rem; margin-top: 1rem;">
                        <button type="button" onclick="this.closest('#add-kpi-modal').style.display='none'"
                            style="flex: 1; background: none; border: 1px solid var(--border); color: var(--text-secondary); padding: 12px; border-radius: 8px; cursor: pointer;">Cancel</button>
                        <button type="submit"
                            style="flex: 1; background: var(--accent); color: white; border: none; padding: 12px; border-radius: 8px; cursor: pointer; font-weight: 600;">Add
                            KPI</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="add-marker-modal"
        style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.8); z-index: 1000; align-items: center; justify-content: center; padding: 1rem;">
        <div
            style="background: var(--bg-dark); border: 1px solid var(--border); border-radius: 1.5rem; width: 100%; max-width: 500px; padding: 2rem;">
            <h3 style="margin-bottom: 1.5rem;">Add Map Marker</h3>
            <form action="{{ route('admin.map-marker.store', $page->id) }}" method="POST">
                @csrf
                <div style="display: grid; gap: 1rem;">
                    <div>
                        <label
                            style="display: block; font-size: 0.75rem; color: var(--text-secondary); margin-bottom: 0.5rem;">Name</label>
                        <input type="text" name="name" required
                            style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid var(--border); color: var(--text-primary); padding: 10px; border-radius: 8px;">
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div>
                            <label
                                style="display: block; font-size: 0.75rem; color: var(--text-secondary); margin-bottom: 0.5rem;">Latitude</label>
                            <input type="number" step="any" name="lat" required
                                style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid var(--border); color: var(--text-primary); padding: 10px; border-radius: 8px;">
                        </div>
                        <div>
                            <label
                                style="display: block; font-size: 0.75rem; color: var(--text-secondary); margin-bottom: 0.5rem;">Longitude</label>
                            <input type="number" step="any" name="lng" required
                                style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid var(--border); color: var(--text-primary); padding: 10px; border-radius: 8px;">
                        </div>
                    </div>
                    <div>
                        <label
                            style="display: block; font-size: 0.75rem; color: var(--text-secondary); margin-bottom: 0.5rem;">Type
                            (e.g. Airport, Port)</label>
                        <input type="text" name="type"
                            style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid var(--border); color: var(--text-primary); padding: 10px; border-radius: 8px;">
                    </div>
                    <div style="display: flex; gap: 1rem; margin-top: 1rem;">
                        <button type="button" onclick="this.closest('#add-marker-modal').style.display='none'"
                            style="flex: 1; background: none; border: 1px solid var(--border); color: var(--text-secondary); padding: 12px; border-radius: 8px; cursor: pointer;">Cancel</button>
                        <button type="submit"
                            style="flex: 1; background: var(--accent); color: white; border: none; padding: 12px; border-radius: 8px; cursor: pointer; font-weight: 600;">Add
                            Marker</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="add-source-modal"
        style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.8); z-index: 1000; align-items: center; justify-content: center; padding: 1rem;">
        <div
            style="background: var(--bg-dark); border: 1px solid var(--border); border-radius: 1.5rem; width: 100%; max-width: 500px; padding: 2rem;">
            <h3 style="margin-bottom: 1.5rem;">Add Data Source</h3>
            <form action="{{ route('admin.data-source.store', $page->id) }}" method="POST">
                @csrf
                <div style="display: grid; gap: 1rem;">
                    <div>
                        <label
                            style="display: block; font-size: 0.75rem; color: var(--text-secondary); margin-bottom: 0.5rem;">Title</label>
                        <input type="text" name="title" required
                            style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid var(--border); color: var(--text-primary); padding: 10px; border-radius: 8px;">
                    </div>
                    <div>
                        <label
                            style="display: block; font-size: 0.75rem; color: var(--text-secondary); margin-bottom: 0.5rem;">URL</label>
                        <input type="url" name="url"
                            style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid var(--border); color: var(--text-primary); padding: 10px; border-radius: 8px;">
                    </div>
                    <div style="display: flex; gap: 1rem; margin-top: 1rem;">
                        <button type="button" onclick="this.closest('#add-source-modal').style.display='none'"
                            style="flex: 1; background: none; border: 1px solid var(--border); color: var(--text-secondary); padding: 12px; border-radius: 8px; cursor: pointer;">Cancel</button>
                        <button type="submit"
                            style="flex: 1; background: var(--accent); color: white; border: none; padding: 12px; border-radius: 8px; cursor: pointer; font-weight: 600;">Add
                            Source</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection