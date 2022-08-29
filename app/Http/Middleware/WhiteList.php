<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Ip;

class WhiteList
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // dump(request()->ip());
        $user = auth()->user();
        if($user->role != 1 && !$this->checkIp(request()->ip()))
        {
            dd('Your ip not accept!');
        }
        return $next($request);
    }

    private function checkIp($clientIp)
    {
        $whiteList = Ip::all()->pluck('ip')->toArray();
            $clientIp = request()->ip();
            $splitClientIp = explode('.', $clientIp);
        foreach($whiteList as $ip)
        {
            if($ip == $clientIp|| $ip == "*.*.*.*") return true;

            if(!str_contains($ip, '*')) continue;
            $valid = [];
            foreach(explode('.', $ip) as $position => $partOfId)
            {
                if($partOfId == "*")
                {
                    $valid[]= $partOfId;
                    continue;
                }
                if($splitClientIp[$position] != $partOfId) break;
                $valid[]= $partOfId;
            }
            if(implode('.', $valid) == $ip) return true;
        }
        return false;       
    }
}
