<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="{{ route('admin') }}">
        <img src="{{ config('app.url') }}/images/logo.png" class="navbar-brand-img h-100" alt="main_logo">
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav px-4">
        <li class="nav-item border mb-4 rounded">
          <a class="nav-link active" href="{{ route('admin') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item border mb-4 rounded">
          <a class="nav-link " href="{{ route('admin.plots') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-world-2 text-danger text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Plots</span>
          </a>
        </li>
        <li class="nav-item border mb-4 rounded">
          <a class="nav-link " href="{{ route('admin.payments') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Payments</span>
          </a>
        </li>
        @can('view', ['roles'])
            <li class="nav-item border mb-4 rounded">
            <a class="nav-link " href="{{ route('admin.roles') }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-world-2 text-warning text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Roles</span>
            </a>
            </li>
        @endcan
        <li class="nav-item border mb-4 rounded">
          <a class="nav-link " href="{{ route('admin.clients') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Clients</span>
          </a>
        </li>
        @can('view', ['staff'])
            <li class="nav-item border mb-4 rounded">
            <a class="nav-link " href="{{ route('admin.staff') }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-app text-info text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Staff</span>
            </a>
            </li>
        @endcan
        <li class="nav-item border mb-4 rounded">
          <a class="nav-link " href="{{ route('admin.layouts') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-world-2 text-danger text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Layouts</span>
          </a>
        </li>
        <li class="nav-item border mb-4 rounded">
          <a class="nav-link " href="{{ route('admin.plans') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-world-2 text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Plans</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>