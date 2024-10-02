<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">


  <!-- Topbar Navbar -->
  <ul class="navbar-nav ml-auto">

      <!-- Nav Item - Search Dropdown (Visible Only XS) -->
     

     
      <!-- Nav Item - Messages -->
     
      <div class="topbar-divider d-none d-sm-block"></div>

      <!-- Nav Item - User Information -->
      <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
          href="#" id="userDropdown" role="button"
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="mr-2 d-none d-lg-inline text-gray-600 small">Desconectarse</span>

              
          </a>

          <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display: none;">
            @csrf
        </form>
          <!-- Dropdown - User Information -->
      </li>

  </ul>

</nav>