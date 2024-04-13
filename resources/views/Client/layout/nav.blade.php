<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
      <a class="navbar-brand" href="index.html">My<span>Car</span></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item {{ request()->routeIs('Client.index') ? ' active' : '' }}"><a href="{{ route('Client.index') }}" class="nav-item nav-link">Home</a></li>
          <li class="nav-item {{ request()->routeIs('Client.cars') ? ' active' : '' }}"><a href="{{ route('Client.cars') }}" class="nav-item nav-link">Cars</a></li>
          <li class="nav-item {{ request()->routeIs('Client.blog') ? ' active' : '' }}"><a href="{{ route('Client.blog') }}" class="nav-item nav-link">Blogs</a></li>
          <li class="nav-item {{ request()->routeIs('Client.services') ? ' active' : '' }}"><a href="{{ route('Client.services') }}" class="nav-item nav-link">Services</a></li>
          <li class="nav-item {{ request()->routeIs('Client.about') ? ' active' : '' }}"><a href="{{ route('Client.about') }}" class="nav-item nav-link">About</a></li>
        </ul>
      </div>
    </div>
  </nav>