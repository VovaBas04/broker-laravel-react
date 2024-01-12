<?php

namespace App\Http\Middleware;

use App\Services\converter\KeyCaseConverterService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConvertToSnakeCase
{
    public function __construct(private KeyCaseConverterService $service)
    {

    }
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $request->replace(
            $this->service->convert(
                KeyCaseConverterService::CASE_SNAKE,
                $request->all()
            )
        );
        return $next($request);
    }
}
