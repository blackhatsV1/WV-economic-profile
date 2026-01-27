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
            <i data-lucide="trending-up"></i>
        </div>
        <div style="padding: 1.5rem;">
            <div style="display: grid; grid-template-columns: 1fr; gap: 1.5rem;">
                @foreach($page->kpis as $kpi)
                    <form action="{{ route('admin.kpi.update', $kpi->id) }}" method="POST"
                        style="background: rgba(255,255,255,0.02); border: 1px solid var(--border); border-radius: 1rem; padding: 1.5rem;">
                        @csrf
                        <div
                            style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; align-items: end;">
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
                            <div>
                                <button type="submit"
                                    style="background: var(--accent); color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; font-weight: 600; width: 100%;">Save
                                    KPI</button>
                            </div>
                        </div>
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
                        <!-- Simple Table Editor (Static for now) -->
                        <div
                            style="color: var(--text-secondary); font-size: 0.875rem; background: rgba(0,0,0,0.2); padding: 1rem; border-radius: 0.5rem; text-align: center;">
                            Table data editing is available in JSON format for power users.
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Data Sources Management -->
    <div class="visual-container full-width" style="margin-top: 2rem;">
        <div class="visual-header">
            <h3>🔗 Data Sources</h3>
            <i data-lucide="link"></i>
        </div>
        <div style="padding: 1.5rem;">
            <div style="display: grid; grid-template-columns: 1fr; gap: 1rem;">
                @foreach($page->dataSources as $source)
                    <div
                        style="display: flex; justify-content: space-between; align-items: center; background: rgba(255,255,255,0.02); padding: 1rem; border-radius: 0.75rem; border: 1px solid var(--border);">
                        <div>
                            <div style="font-weight: 600; color: var(--text-primary);">{{ $source->title }}</div>
                            <div style="font-size: 0.75rem; color: var(--text-secondary);">{{ $source->url }}</div>
                        </div>
                        <button
                            style="border: 1px solid var(--border); background: none; color: var(--text-secondary); padding: 4px 12px; border-radius: 4px;">Edit</button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection