<?php
namespace Modules\User\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\User\Entities\User;

/**
 * Class UserTransformer
 * @package Modules\User\Transformers
 */
class UserTransformer extends TransformerAbstract {

    public function transform(User $user): array
    {
        return [
            'id' => $user->id,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
        ];
    }

}
