<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TodoItem extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'todo_list_id',
        'title',
    ];

    /*
     |--------------------------------------------------------------------------
     | Relations
     |--------------------------------------------------------------------------
     */

    /**
     * An item belongs to a list of items.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function todoList()
    {
        return $this->belongsTo(TodoList::class);
    }
}
