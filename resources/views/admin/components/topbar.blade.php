<header class="admin-topbar">
    @php
        $adminUser = auth()->user();
        $adminName = $adminUser?->name ?: 'Admin';
        $adminInitial = strtoupper(substr($adminName, 0, 1));
    @endphp

    <div class="admin-topbar-title">
        <h1>@yield('admin_title', 'Dashboard')</h1>
        <p>@yield('admin_subtitle', 'Content management panel')</p>
    </div>

    <div class="admin-topbar-actions">
        <div class="admin-profile" id="adminProfileMenuWrap">
            <button type="button" class="admin-profile-btn" id="adminProfileBtn" aria-expanded="false" aria-controls="adminProfileMenu">
                <span class="admin-avatar" aria-hidden="true">{{ $adminInitial }}</span>
                <span class="admin-profile-name">{{ $adminName }}</span>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
            </button>

            <div class="admin-profile-menu" id="adminProfileMenu" role="menu" aria-hidden="true">
                <a href="{{ route('admin.dashboard') }}" class="admin-profile-link" role="menuitem">Dashboard</a>
                <form action="{{ route('logout') }}" method="POST" role="none">
                    @csrf
                    <button type="submit" class="admin-profile-link admin-profile-link-danger" role="menuitem">Logout</button>
                </form>
            </div>
        </div>
    </div>
</header>
