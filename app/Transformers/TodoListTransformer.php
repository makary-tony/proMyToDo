<?php

namespace App\Transformers;

use App\TodoList;
use League\Fractal\TransformerAbstract;

class TodoListTransformer extends TransformerAbstract
{
    /**
     * These relations are available to be included with the user object.
     *
     * @var array
     */
    protected $availableIncludes = [

    ];

    /**
     * Transform a user object.
     *
     * @param TodoList $list
     * @return array
     */
    public function transform(TodoList $list)
    {
        return [
            'name' => $list->name,
            'key'  => $list->id,
        ];
    }
}