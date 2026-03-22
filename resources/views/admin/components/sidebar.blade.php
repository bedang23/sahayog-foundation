<aside class="admin-sidebar" id="adminSidebar" aria-label="Admin Sidebar Navigation">
    <div class="admin-sidebar-brand">
        <a href="{{ route('admin.dashboard') }}" class="admin-brand-link">Sahayog CMS</a>
        <button type="button" class="admin-sidebar-toggle" id="adminSidebarToggle" aria-label="Toggle sidebar">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
        </button>
    </div>

    <nav class="admin-nav" aria-label="Admin Main Navigation">
        <a href="{{ route('admin.dashboard') }}" class="admin-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="8" height="8"/><rect x="13" y="3" width="8" height="5"/><rect x="13" y="10" width="8" height="11"/><rect x="3" y="13" width="8" height="8"/></svg>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('admin.pages.index') }}" class="admin-nav-link {{ request()->routeIs('admin.pages.*') ? 'active' : '' }}">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            <span>Pages</span>
        </a>

        <a href="{{ route('admin.gallery.index') }}" class="admin-nav-link {{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
            <span>Gallery</span>
        </a>

    </nav>

    <div class="admin-sidebar-footer">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="admin-nav-link admin-nav-link-danger">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>
