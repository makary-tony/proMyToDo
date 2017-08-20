<?php

namespace App\Transformers;

use App\TodoList;
use League\Fractal\TransformerAbstract;
use App\Transformers\ItemTransformer;

class TodoListTransformer extends TransformerAbstract
{
    /**
     * These relations are available to be included with the user object.
     *
     * @var array
     */
    protected $availableIncludes = [
        'items'
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
            'name'       => $list->name,
            'created_at' => $list->created_at,
            'items_count'=> $list->items->count(),
            'key'        => $list->id,
            'loading'    => false,
        ];
    }
    
    public function includeItems(TodoList $list)
    {
        return $this->collection($list->items, new ItemTransformer());   
    }
}
