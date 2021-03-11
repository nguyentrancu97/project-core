<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\JWTAuth;

class ApiAccessPermission
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /** @var JWTAuth $jwtAuth */
        $jwtAuth = app(JWTAuth::class);

        try {
            $permissions = $jwtAuth->parseToken()->getPayload()->get('application_access_permissions');

            if (empty($permissions) || !is_array($permissions) || !in_array('SAsset', $permissions)) {
                return response()->json([
                    'success' => false,
                    'data' => null,
                    'message' => 'Unauthorized',
                    'error_code' => 401,
                ]);
            }

            return $next($request);
        } catch (\Exception $e) {
            Log::error(self::class . ' - ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Unauthorized.',
                'error_code' => 401,
            ]);
        }
    }
}
