<!-- sidebar @s -->
<div class="nk-sidebar nk-sidebar-fixed is-light " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-sidebar-brand">
            <a href="html/index.html" class="logo-link nk-sidebar-logo">
                <B>BILLIARD RESERVATION <em class="icon ni ni-brick"></em></B>
            </a>
        </div>
        <div class="nk-menu-trigger me-n2">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
            <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
        </div>
    </div><!-- .nk-sidebar-element -->
    <div class="nk-sidebar-element">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Dashboards</h6>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item">
                        <a href="html/index-analytics.html" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-cc-alt2-fill"></em></span>
                            <span class="nk-menu-text">Reservation Dashboard</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item {{ ($page === "Reservation Form")  ? 'active' : '' }}">
                        <a href="/formReservation" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-file-docs"></em></span>
                            <span class="nk-menu-text">Reservation Form</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item {{ ($page === "Reservation List")  ? 'active' : '' }}">
                        <a href="/listReservation" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-table-view-fill"></em></span>
                            <span class="nk-menu-text">Reservation List</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Master</h6>
                    </li><!-- .nk-menu-heading -->
                    <li class="nk-menu-item has-sub {{ ($page === "Package Master" || "Table Master")  ? 'active' : '' }}">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-grid-alt-fill"></em></span>
                            <span class="nk-menu-text">Master Data</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item {{ ($page === "Table Master")  ? 'active' : '' }}">
                                <a href="/masterTable" class="nk-menu-link"><span class="nk-menu-text">Table</span></a>
                            </li>
                            <li class="nk-menu-item {{ ($page === "Package Master")  ? 'active' : '' }}">
                                <a href="/masterPackage" class="nk-menu-link"><span class="nk-menu-text">Package</span></a>
                            </li>
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                </ul><!-- .nk-menu -->
            </div><!-- .nk-sidebar-menu -->
        </div><!-- .nk-sidebar-content -->
    </div><!-- .nk-sidebar-element -->
</div>
<!-- sidebar @e -->