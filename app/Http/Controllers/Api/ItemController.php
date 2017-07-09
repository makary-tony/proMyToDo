<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\ItemRequest;
use App\TodoItem;
use App\Transformers\TodoItemTransformer;

class ItemController extends ApiBaseController
{
    /**
     * Store a new item.
     *
     * @param ItemRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ItemRequest $request)
    {
        return $this->response->item(
            TodoItem::create($request->all()),
            new TodoItemTransformer()
        );
    }

    /**
     * Update an item.
     *
     * @param ItemRequest $request
     * @param TodoItem $item
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ItemRequest $request, TodoItem $item)
    {
        return $this->response->item(
            $item->update($request->all()),
            new TodoItemTransformer()
        );
    }

    /**
     * Delete an item.
     *
     * @param TodoItem $item
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(TodoItem $item)
    {
        $item->delete();

        return $this->response->accepted();
    }
}
