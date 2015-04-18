@extends('app')

@section('body')
<section id="dashboard">
	<div class="main-panel" style="margin-left: 0;">
		<div class="header-bar clearfix">
			<div class="logo-panel">
				<h1>
					<span>/</span>SomeApp<span>/</span>
				</h1>
			</div>
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