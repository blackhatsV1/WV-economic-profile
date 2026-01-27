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
                <i data-lucide="box"></i>
            </div>
            <div style="padding: 1rem;">
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1.25rem;">
                    @foreach($clusters as $cluster)
                        <div
                            style="background: rgba(255,255,255,0.03); border: 1px solid var(--border); border-radius: 0.75rem; padding: 1.25rem; position: relative;">
                            <h4 style="margin: 0; color: var(--text-primary); margin-bottom: 0.5rem;">{{ $cluster->title }}</h4>
                            <span
                                style="font-size: 0.75rem; background: var(--accent); color: white; padding: 2px 8px; border-radius: 4px;">Active</span>
                            <div style="margin-top: 1rem;">
                                <button
                                    style="background: none; border: 1px solid var(--accent); color: var(--accent); padding: 4px 12px; border-radius: 4px; font-size: 0.75rem; cursor: pointer;">Edit
                                    Data</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
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