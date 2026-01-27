@extends('layouts.dashboard')

@section('title', 'Edit ' . $page->title)
@section('page-title', 'Editing: ' . $page->title)

@section('content')
    <div style="margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center;">
        <a href="{{ route('admin.dashboard') }}"
            style="color: var(--accent); text-decoration: none; display: flex; align-items: center; gap: 8px;">
            <i data-lucide="arrow-left" style="width: 18px;"></i> Back to Dashboard
        </a>
        <span style="font-size: 0.875rem; color: var(--text-secondary);">Last updated:
            {{ $page->updated_at->format('M d, Y H:i') }}</span>
    </div>

    <!-- KPI Management -->
    <div class="visual-container full-width">
        <div class="visual-header">
            <h3>📈 Content KPIs</h3>
            <button onclick="document.getElementById('add-kpi-modal').style.display='flex'"
                style="background: var(--accent); color: white; border: none; padding: 6px 16px; border-radius: 6px; cursor: pointer; font-size: 0.875rem;">+
                Add New KPI</button>
        </div>
        <div style="padding: 1.5rem;">
            <div style="display: grid; grid-template-columns: 1fr; gap: 1.5rem;">
                @foreach($page->kpis as $kpi)
                    <div
                        style="background: rgba(255,255,255,0.02); border: 1px solid var(--border); border-radius: 1rem; padding: 1.5rem;">
                        <div style="display: grid; grid-template-columns: 1fr auto; gap: 1.5rem; align-items: end;">
                            <form action="{{ route('admin.kpi.update', $kpi->id) }}" method="POST" style="flex: 1;">
                                @csrf
                                <div
                                    style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem; align-items: end;">
                                    <div>
                                        <label
                                            style="display: block; font-size: 0.75rem; color: var(--text-secondary); margin-bottom: 0.5rem;">Label</label>
                                        <input type="text" name="label" value="{{ $kpi->label }}"
                                            style="width: 100%; background: var(--bg-dark); border: 1px solid var(--border); color: var(--text-primary); padding: 8px; border-radius: 6px;">
                                    </div>
                                    <div>
                                        <label
                                            style="display: block; font-size: 0.75rem; color: var(--text-secondary); margin-bottom: 0.5rem;">Value</label>
                                        <input type="text" name="value" value="{{ $kpi->value }}"
                                            style="width: 100%; background: var(--bg-dark); border: 1px solid var(--border); color: var(--text-primary); padding: 8px; border-radius: 6px;">
                                    </div>
                                    <div>
                                        <label
                                            style="display: block; font-size: 0.75rem; color: var(--text-secondary); margin-bottom: 0.5rem;">Trend
                                            Text</label>
                                        <input type="text" name="trend_value" value="{{ $kpi->trend_value }}"
                                            style="width: 100%; background: var(--bg-dark); border: 1px solid var(--border); color: var(--text-primary); padding: 8px; border-radius: 6px;">
                                    </div>
                                    <button type="submit"
                                        style="background: var(--accent); color: white; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; font-weight: 600;">Save</button>
                                </div>
                            </form>
                            <form action="{{ route('admin.kpi.destroy', $kpi->id) }}" method="POST"
                                onsubmit="return confirm('Remove this KPI?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    style="background: rgba(248, 113, 113, 0.1); color: #f87171; border: 1px solid rgba(248, 113, 113, 0.2); padding: 8px; border-radius: 6px; cursor: pointer;">
                                    <i data-lucide="trash-2" style="width: 16px;"></i>
                                </button>
                            </form>
                        </div>
                    </div>
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
                <h3>📍 Map Markers</h3>
                <button onclick="document.getElementById('add-marker-modal').style.display='flex'"
                    style="background: var(--accent); color: white; border: none; padding: 6px 16px; border-radius: 6px; cursor: pointer; font-size: 0.875rem;">+
                    Add Marker</button>
            </div>
            <div style="padding: 1.5rem;">
                <div style="display: grid; grid-template-columns: 1fr; gap: 1rem;">
                    @foreach($page->mapMarkers as $marker)
                        <div
                            style="display: flex; justify-content: space-between; align-items: center; background: rgba(255,255,255,0.02); padding: 1rem; border-radius: 0.75rem; border: 1px solid var(--border);">
                            <div>
                                <div style="font-weight: 600; color: var(--text-primary);">{{ $marker->name }} <span
                                        style="font-size: 0.75rem; color: var(--text-secondary);">({{ $marker->type }})</span></div>
                                <div style="font-size: 0.75rem; color: var(--text-secondary);">{{ $marker->lat }},
                                    {{ $marker->lng }}</div>
                            </div>
                            <form action="{{ route('admin.map-marker.destroy', $marker->id) }}" method="POST"
                                onsubmit="return confirm('Remove this marker?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: none; border: none; color: #f87171; cursor: pointer;"><i
                                        data-lucide="trash-2" style="width: 18px;"></i></button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!-- Data Sources Management -->
    <div class="visual-container full-width" style="margin-top: 2rem;">
        <div class="visual-header">
            <h3>🔗 Data Sources</h3>
            <button onclick="document.getElementById('add-source-modal').style.display='flex'"
                style="background: var(--accent); color: white; border: none; padding: 6px 16px; border-radius: 6px; cursor: pointer; font-size: 0.875rem;">+
                Add Source</button>
        </div>
        <div style="padding: 1.5rem;">
            <div style="display: grid; grid-template-columns: 1fr; gap: 1rem;">
                @foreach($page->dataSources as $source)
                    <div
                        style="background: rgba(255,255,255,0.02); border: 1px solid var(--border); border-radius: 1rem; padding: 1.5rem;">
                        <div style="display: grid; grid-template-columns: 1fr auto; gap: 1.5rem; align-items: end;">
                            <form action="{{ route('admin.data-source.update', $source->id) }}" method="POST" style="flex: 1;">
                                @csrf
                                <div
                                    style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; align-items: end;">
                                    <div>
                                        <label
                                            style="display: block; font-size: 0.75rem; color: var(--text-secondary); margin-bottom: 0.5rem;">Title</label>
                                        <input type="text" name="title" value="{{ $source->title }}"
                                            style="width: 100%; background: var(--bg-dark); border: 1px solid var(--border); color: var(--text-primary); padding: 8px; border-radius: 6px;">
                                    </div>
                                    <div>
                                        <label
                                            style="display: block; font-size: 0.75rem; color: var(--text-secondary); margin-bottom: 0.5rem;">URL</label>
                                        <input type="text" name="url" value="{{ $source->url }}"
                                            style="width: 100%; background: var(--bg-dark); border: 1px solid var(--border); color: var(--text-primary); padding: 8px; border-radius: 6px;">
                                    </div>
                                    <button type="submit"
                                        style="background: var(--accent); color: white; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; font-weight: 600;">Update
                                        Source</button>
                                </div>
                            </form>
                            <form action="{{ route('admin.data-source.destroy', $source->id) }}" method="POST"
                                onsubmit="return confirm('Remove this source?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    style="background: rgba(248, 113, 113, 0.1); color: #f87171; border: 1px solid rgba(248, 113, 113, 0.2); padding: 8px; border-radius: 6px; cursor: pointer;">
                                    <i data-lucide="trash-2" style="width: 16px;"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
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