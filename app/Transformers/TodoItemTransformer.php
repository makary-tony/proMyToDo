<?php

namespace App\Transformers;

use App\TodoItem;
use League\Fractal\TransformerAbstract;

class TodoItemTransformer extends TransformerAbstract
{
    /**
     * These relations are available to be included with the user object.
     *
     * @var array
     */
    protected $availableIncludes = [
        'list'
    ];

    /**
     * Transform a user object.
     *
     * @param TodoItem $item
     * @return array
     */
    public function transform(TodoItem $item)
    {
        return [
            'title' => $item->title,
            'key'   => $item->id,
        ];
    }

    /**
     * Include the item list.
     *
     * @param TodoItem $item
     * @return \League\Fractal\Resource\Item
     */
    public function includeList(TodoItem $item)
    {
        return $this->item($item->list, new TodoListTransformer());
    }
}