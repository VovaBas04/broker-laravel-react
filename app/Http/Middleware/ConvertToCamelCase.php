<?php

namespace App\Http\Middleware;

use App\Services\converter\KeyCaseConverterService;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConvertToCamelCase
{
    public function __construct(private KeyCaseConverterService $service)
    {

    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        if ($response instanceof JsonResponse) {
            $response->setData(
                $this->service->convert(
                    KeyCaseConverterService::CASE_CAMEL,
                    json_decode($response->content(), true)
                )
            );
        }
        return $response;
    }
}
