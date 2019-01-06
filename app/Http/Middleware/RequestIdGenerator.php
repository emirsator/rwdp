<?php

namespace App\Http\Middleware;

use Closure;
use Webpatser\Uuid\Uuid;

class RequestIdGenerator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        request()->request->add(['request_id' => Uuid::generate()->string]);

        return $next($request);
    }
}
