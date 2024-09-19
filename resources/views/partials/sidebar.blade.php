<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
    <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu"
      aria-labelledby="sidebarMenuLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="sidebarMenuLabel">Admin</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"
          aria-label="Close"></button>
      </div>
      <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="{{ url('/admin') }}">
              <svg class="bi">
                <use xlink:href="#house-fill" />
              </svg>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2" href="{{ url('/admin/sid') }}">
              <svg class="bi">
                <use xlink:href="#file-earmark" />
              </svg>
              SID
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2" href="{{ url('/admin/originating') }}">
              <svg class="bi">
                <use xlink:href="#file-earmark" />
              </svg>
              Originating
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2" href="{{ url('/admin/terminating') }}">
              <svg class="bi">
                <use xlink:href="#file-earmark" />
              </svg>
              Terminating
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2" href="{{ url('/admin/service') }}">
              <svg class="bi">
                <use xlink:href="#file-earmark" />
              </svg>
              Service
            </a>
          </li>

        <hr class="my-3">

        <ul class="nav flex-column mb-auto">
          <li class="nav-item">
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="nav-link d-flex align-items-center gap-2">
                    <svg class="bi">
                        <use xlink:href="#door-closed" />
                      </svg>
                      Sign out
                </button>
            </form>
          </li>
        </ul>
      </div>
    </div>
  </div>

