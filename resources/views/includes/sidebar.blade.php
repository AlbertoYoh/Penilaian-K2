<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      @if (auth()->user()->role == 'admin')
        <li class="nav-item">
          <a class="nav-link " href="index.html">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
          </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-menu-button-wide"></i><span>Data Master</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
              <a href="{{route('mapel.index')}}">
                <i class="bi bi-circle"></i><span>Mapel</span>
              </a>
            </li>
            <li>
              <a href="{{route('ta.index')}}">
                <i class="bi bi-circle"></i><span>TA</span>
              </a>
            </li>
            <li>
              <a href="{{route('karya.index')}}">
                <i class="bi bi-circle"></i><span>Karya</span>
              </a>
            </li>
            <li>
              <a href="{{route('siswa.index')}}">
                <i class="bi bi-circle"></i><span>Siswa</span>
              </a>
            </li>
            <li>
              <a href="{{route('guru.index')}}">
                <i class="bi bi-circle"></i><span>Guru</span>
              </a>
            </li>
          </ul>
        </li><!-- End Components Nav -->
      @endif
      <li class="nav-item">
        <a class="nav-link " href="{{route('nilai')}}">
          <i class="bi bi-bar-chart-fill"></i>
          <span>Nilai</span>
        </a>
      </li>

    </ul>

</aside><!-- End Sidebar-->