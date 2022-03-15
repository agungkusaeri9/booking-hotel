<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a href="{{ route('logout') }}" title="Logout" class="nav-link" onclick="event.preventDefault();
        document.getElementById('formLogout').submit();">
          <div class="rounded-circle px-1 border border-danger bg-danger">
            <i class="nav-icon fas fa-sign-out-alt text-light"></i>
          </div>
        </a>
        <form action="{{ route('logout') }}" method="post" id="formLogout">
          @csrf
        </form>
      </li>
    </ul>
</nav>