<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\ListRequest;
use App\TodoList;
use App\Transformers\TodoListTransformer;
use Illuminate\Http\Request;

class ListController extends ApiBaseController
{
    /**
     * Get a list of all the auth user TodoLists
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->response->collection(
            auth()->user()->lists,
            new TodoListTransformer()
        );
    }

    /**
     * Get a list details.
     *
     * @param TodoList $list
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(TodoList $list)
    {
        return $this->response->item(
            $list,
            new TodoListTransformer()
        );
    }

    /**
     * Store a new list by the auth user.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ListRequest $request)
    {
        return $this->response->item(
            auth()->user()->lists()->create($request->all()),
            new TodoListTransformer()
        );
    }

    /**
     * Update a given list.
     *
     * @param ListRequest $request
     * @param TodoList $list
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ListRequest $request, TodoList $list)
    {
        $list->update($request->all());
        return $this->response->item(
            $list,
            new TodoListTransformer()
        );
    }

    /**
     * Delete a list.
     *
     * @param TodoList $list
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(TodoList $list)
    {
        $list->delete();

        return $this->response->accepted();
    }
}
