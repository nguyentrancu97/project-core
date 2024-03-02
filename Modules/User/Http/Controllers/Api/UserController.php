<?php

namespace Modules\User\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;
use Modules\User\Repositories\UserRepository;
use Modules\User\Transformers\UserTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends BaseApiController
{

    /**
     * @var UserRepository
     */

     public function __construct(UserRepository $repository)
     {
         parent::__construct($repository);
     }

     /**
      * Api Login
      * @param Request $request
      * @return mixed
      */
     public function login(Request $request)
     {
        try {
            $credentials = request(['email', 'password']);

            if (!$token = auth('api')->attempt($credentials)) {
                return $this->responseErrors(401);
            }

            $user = auth('api')->user();

            $response = [
                'token' => $token,
                'user' => $this->transform($user, UserTransformer::class, $request)
            ];

            return $this->responseSuccess($response);
        } catch (\Exception $e) {
            Log::error($e);
            return $this->responseErrors(500, $e->getMessage());
        }
     }

}
