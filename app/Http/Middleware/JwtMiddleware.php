<?php

namespace App\Http\Middleware;

use App\User;
use SonLeu\SConnect\ObjectSerializer;
use Closure;
use Exception;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = (string)$this->auth->getToken();
        if (!$token) {
            $response = [
                'success' => false,
                'data' => null,
                'message' => 'Token not provided',
                'error_code' => null,
            ];

            return response()->json($response, 401);
        }
        try {

            $user = $this->auth->parseToken()->getPayload()->get('user');

            $user = json_decode(json_encode($user));

            /** @var User $user */
            $user = ObjectSerializer::deserialize($user, User::class);

            auth('sconnect')->login($user, $token);

            return $next($request);
        } catch (Exception $e) {
            $response = [
                'success' => false,
                'data' => null,
                'error_code' => null,
            ];

            if ($e instanceof TokenInvalidException) {
                $response['message'] = 'Token is Invalid';
            } else if ($e instanceof TokenExpiredException) {
                $response['message'] = 'Token is Expired';
            } else {
                $response['message'] = $e->getMessage();
            }

            return response()->json($response, 401);
        }
    }
}
