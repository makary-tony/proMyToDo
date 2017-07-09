<?php

use Illuminate\Database\Seeder;

class ListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lists')->delete();
        DB::table('lists')->truncate();

        factory(\App\TodoList::class, 10)->create();
    }
}
