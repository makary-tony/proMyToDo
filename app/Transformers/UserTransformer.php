<?php

namespace App\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * These relations are available to be included with the user object.
     *
     * @var array
     */
    protected $availableIncludes = [
        'lists',
        'items',
    ];

    /**
     * Transform a user object.
     *
     * @param User $user
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'name'    => $user->name,
            'email'   => $user->email,
            'key'     => $user->id,
            'loading' => false,
        ];
    }

    /**
     * Include the user lists.
     *
     * @param User $user
     * @return \League\Fractal\Resource\Collection
     */
    public function includeLists(User $user)
    {
        return $this->collection($user->lists, new TodoListTransformer());
    }

    /**
     * Include the user items.
     *
     * @param User $user
     * @return \League\Fractal\Resource\Collection
     */
    public function includeItems(User $user)
    {
        return $this->collection($user->items, new TodoItemTransformer());
    }
}