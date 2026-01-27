@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')
@section('page-title', 'Admin Content Management')

@section('content')
    <div style="margin-bottom: 2rem;">
        <p style="color: var(--text-secondary);">Welcome to the secure data management portal. Select a page below to modify
            its content, KPIs, and charts.</p>
    </div>

    <div class="visuals-grid">
        <div class="visual-container full-width">
            <div class="visual-header">
                <h3>📋 Manage Profile Pages</h3>
                <i data-lucide="layers"></i>
            </div>
            <div style="padding: 1rem;">
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem;">
                    @foreach($pages as $page)
                        <div style="background: rgba(255,255,255,0.03); border: 1px solid var(--border); border-radius: 1rem; padding: 1.5rem; transition: transform 0.2s; cursor: pointer;"
                            onclick="window.location.href='{{ route('admin.page.edit', $page->id) }}'"
                            onmouseover="this.style.transform='translateY(-4px)'; this.style.borderColor='var(--accent)'"
                            onmouseout="this.style.transform='translateY(0)'; this.style.borderColor='var(--border)'">
                            <div
                                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                                <h4 style="margin: 0; color: var(--text-primary);">{{ $page->title }}</h4>
                                <i data-lucide="chevron-right" style="color: var(--accent); width: 20px;"></i>
                            </div>
                            <div style="display: flex; gap: 1rem; font-size: 0.75rem; color: var(--text-secondary);">
                                <span><i data-lucide="tag" style="width: 12px; vertical-align: middle;"></i>
                                    {{ $page->slug }}</span>
                                <span><i data-lucide="activity" style="width: 12px; vertical-align: middle;"></i>
                                    {{ $page->kpis_count ?? $page->kpis()->count() }} KPIs</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="visual-container full-width">
            <div class="visual-header">
                <h3>🚀 Priority Industry Clusters</h3>
                <button onclick="document.getElementById('add-cluster-modal').style.display='flex'"
                    style="background: var(--accent); color: white; border: none; padding: 6px 16px; border-radius: 6px; cursor: pointer; font-size: 0.875rem;">+
                    Add Cluster</button>
            </div>
            <div style="padding: 1rem;">
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1.25rem;">
                    @foreach($clusters as $cluster)
                        <div
                            style="background: rgba(255,255,255,0.03); border: 1px solid var(--border); border-radius: 0.75rem; padding: 1.25rem; position: relative;">
                            <div
                                style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 0.5rem;">
                                <h4 style="margin: 0; color: var(--text-primary);">{{ $cluster->name }}</h4>
                                <form action="{{ route('admin.industry-cluster.destroy', $cluster->id) }}" method="POST"
                                    onsubmit="return confirm('Remove this industry cluster?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        style="background: none; border: none; color: #f87171; cursor: pointer;"><i
                                            data-lucide="trash-2" style="width: 14px;"></i></button>
                                </form>
                            </div>
                            <span
                                style="font-size: 0.75rem; background: var(--accent); color: white; padding: 2px 8px; border-radius: 4px;">Active</span>
                            <div style="margin-top: 1rem;">
                                <button onclick="alert('Feature coming soon: Cluster Data Editor')"
                                    style="background: none; border: 1px solid var(--accent); color: var(--accent); padding: 4px 12px; border-radius: 4px; font-size: 0.75rem; cursor: pointer;">Edit
                                    Data</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    <div id="add-cluster-modal"
        style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.8); z-index: 1000; align-items: center; justify-content: center; padding: 1rem;">
        <div
            style="background: var(--bg-dark); border: 1px solid var(--border); border-radius: 1.5rem; width: 100%; max-width: 500px; padding: 2rem;">
            <h3 style="margin-bottom: 1.5rem;">Add Priority Industry</h3>
            <form action="{{ route('admin.industry-cluster.store') }}" method="POST">
                @csrf
                <div style="display: grid; gap: 1rem;">
                    <div>
                        <label
                            style="display: block; font-size: 0.75rem; color: var(--text-secondary); margin-bottom: 0.5rem;">Industry
                            Name (e.g. Cacao)</label>
                        <input type="text" name="name" required
                            style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid var(--border); color: var(--text-primary); padding: 10px; border-radius: 8px;">
                    </div>
                    <div>
                        <label
                            style="display: block; font-size: 0.75rem; color: var(--text-secondary); margin-bottom: 0.5rem;">Short
                            Description</label>
                        <textarea name="description"
                            style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid var(--border); color: var(--text-primary); padding: 10px; border-radius: 8px; min-height: 80px;"></textarea>
                    </div>
                    <div style="display: flex; gap: 1rem; margin-top: 1rem;">
                        <button type="button" onclick="this.closest('#add-cluster-modal').style.display='none'"
                            style="flex: 1; background: none; border: 1px solid var(--border); color: var(--text-secondary); padding: 12px; border-radius: 8px; cursor: pointer;">Cancel</button>
                        <button type="submit"
                            style="flex: 1; background: var(--accent); color: white; border: none; padding: 12px; border-radius: 8px; cursor: pointer; font-weight: 600;">Add
                            Industry</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <div style="margin-top: 3rem; text-align: center;">
        <button onclick="document.getElementById('logout-form').submit()"
            style="background: rgba(248, 113, 113, 0.1); color: #f87171; border: 1px solid rgba(248, 113, 113, 0.2); padding: 8px 20px; border-radius: 8px; cursor: pointer; font-family: inherit;">
            <i data-lucide="log-out" style="width: 16px; vertical-align: middle; margin-right: 8px;"></i> Logout Session
        </button>
    </div>
@endsection