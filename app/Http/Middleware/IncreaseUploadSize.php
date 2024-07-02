<?php

namespace App\Http\Middleware;

use Closure;

class IncreaseUploadSize
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
        // 增加上传限制
        ini_set('upload_max_filesize', '10M');
        ini_set('post_max_size', '10M');
        ini_set('memory_limit', '128M');

        return $next($request);
    }
}