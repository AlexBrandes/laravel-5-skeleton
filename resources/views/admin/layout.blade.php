@extends('app')

@section('body')
<section id="dashboard">
	<div class="left-panel">
		<div class="logo-panel">
			<h1>
				<span>/</span>SomeApp<span>/</span>
			</h1>
		</div>
		<div class="left-panel-inner">
			<h5 class="sidebar-title">Navigation</h5>
			<ul id="admin-links" class="nav nav-pills nav-stacked nav-bracket">
				<li>
					<a href="#">
						<i class="fa fa-credit-card"></i>
						<span>An Item</span>
					</a>
				</li>
				<li class="nav-parent">
					<a href="#">
						<i class="fa fa-list"></i>
						<span>Main Item</span>
					</a>
					<ul class="children">
						<li>
							<a href="#">
								<i class="fa fa-caret-right"></i> Sub Item
							</a>
						</li>
						<li>
							<a href="#">
								<i class="fa fa-caret-right"></i> Sub Item 2
							</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<div class="main-panel">
		<div class="header-bar clearfix">
			<a class="menu-toggle">
				<i class="fa fa-bars"></i>
			</a>
			<div class="header-right">
				<ul class="header-menu">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Login</a></li>
						<li><a href="{{ url('/auth/register') }}">Register</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
								{{ Auth::user()->name }} <span class="caret"></span>
							</a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
		@yield('content')
	</div>
</section>
@endsection