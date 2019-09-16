<?php

use Bow\Database\Migration\Migration;
use Bow\Database\Migration\SQLGenerator;

class Version20190916165657CreateBookmarksTable extends Migration
{
    /**
     * Up Migration
     */
    public function up()
    {
        $this->create("bookmarks", function (SQLGenerator $table) {
            $table->addIncrement('id');
            $table->addString('link');
            $table->addString('description');
            $table->addInteger('user_id');
            $this->addString('tags');
            $table->addForeign('user_id', [
                'table' => 'users',
                'references' => 'id',
                'on' => 'delete cascade'
            ]);
            $table->addTimestamps();
        });
    }

    /**
     * Rollback migration
     */
    public function rollback()
    {
        $this->dropIfExists("bookmarks");
    }
}
