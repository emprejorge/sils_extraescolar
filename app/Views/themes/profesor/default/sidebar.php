<!-- ═══════════════════════════════════════════════
     SIDEBAR
════════════════════════════════════════════════ -->
<aside id="sidebar">

    <!-- Brand -->
    <a href="#" class="sidebar-brand">
        <span class="sidebar-brand-icon">Mi</span>
        <span class="sidebar-brand-name">Mimetic</span>
    </a>

    <!-- Nav -->
    <nav class="sidebar-nav text-white">

        <span class="sidebar-section-label">Principal</span>

        <a href="<?= base_url('dashboard'); ?>" class="nav-item-link <?= (url_is('dashboard')) ? 'active' : ''; ?>">
            <i class="bi bi-grid-1x2 nav-icon"></i>
            <span class="nav-label">Inicio</span>
        </a>

        <a href="#" class="nav-item-link <?= (url_is('academias')) ? 'active' : ''; ?>">
            <i class="bi bi-grid-1x2 nav-icon"></i>
            <span class="nav-label">Mis academias</span>
        </a>

    </nav>

    <!-- Sidebar footer -->
    <div class="sidebar-footer">
        <span class="version-tag">v1.0.0 &mdash; Mimetic</span>
    </div>

</aside>

<!-- Overlay mobile -->
<div id="sidebar-overlay"></div>