<?php

namespace App\Http\Controllers\Api;

use App\Transformers\UserTransformer;

class UserController extends ApiBaseController
{
    /**
     * Get the authenticated user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show()
    {
        return $this->response->item(
            auth()->user(),
            new UserTransformer()
        );
    }
}
