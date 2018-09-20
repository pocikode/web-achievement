<!-- Navigation -->
<nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
  	<div class="container">
	    <a class="navbar-brand js-scroll-trigger" href="{{ url('/') }}">Activity</a>
	    <button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
	      Menu
	    	<i class="fa fa-bars"></i>
	    </button>
	    <div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
				@guest
					<li class="nav-item mx-0 mx-lg-1">
					  	<a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="{{ url('login') }}">Login</a>
					</li>
					<li class="nav-item mx-0 mx-lg-1">
					  	<a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="{{ url('register') }}">Register</a>
					</li>
				@else
					<li class="nav-item mx-0 mx-lg-1">
						<a href="{{ url('dashboard') }}" class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger">{{ Auth::user()->name }}</a>
					</li>
					<li class="nav-item mx-0 mx-lg-1">
						<a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="{{ route('logout') }}"
	                       onclick="event.preventDefault();
	                                     document.getElementById('logout-form').submit();">
	                        {{ __('Logout') }}
	                    </a>

	                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	                        @csrf
	                    </form>
					</li>
				@endguest
			</ul>
	    </div>
  	</div>
</nav>