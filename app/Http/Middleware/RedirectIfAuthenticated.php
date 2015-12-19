<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;

class RedirectIfAuthenticated
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param Guard $auth
     *
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->check()) {
            return $this->authenticated($request);
        }

        return $next($request);
    }

    /**
     * Redirect after authenticated.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  App\Models\User         $user
     *
     * @return Illuminate\Support\Facades\Redirect
     */
    protected function authenticated($request)
    {
        return redirect()->intended(url('/home'));
    }
}
