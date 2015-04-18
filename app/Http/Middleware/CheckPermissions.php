<?php namespace App\Http\Middleware;

use Closure;

class CheckPermissions {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$action = $request->route()->getAction();

		if (! isset($action['permissions'])) {
			return $next($request);
		}

		$permissions = (array) $action['permissions'];

		foreach ($permissions as $permission) {
			if (! \Auth::user()->can($permission)) {
				return $request->ajax() ? response('Unauthorized.', 401) : redirect('auth/unauthorized');
			}
		}

		return $next($request);
	}

}
