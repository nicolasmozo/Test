<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App\Models\Setting;
use Illuminate\Http\Request;

class Timezone
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $setting = Setting::first();
        
        config(['app.timezone' => $setting->timezone]);
        date_default_timezone_set($setting->timezone);

        return $next($request);

        
    }
}
