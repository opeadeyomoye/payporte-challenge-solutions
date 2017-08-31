<?php

namespace Migrations;

use Phinx\Migration\AbstractMigration;


class CreateEventsTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('events');

        $table->addColumn( 'organiser_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false
        ]);
        $table->addColumn( 'title', 'text', [
            'default' => null,
            'null'    => false
        ]);
        $table->addColumn( 'description', 'text', [
            'default' => null,
            'null'    => true
        ]);
        $table->addColumn( 'date', 'datetime', [
            'default' => null,
            'null'    => true
        ]);
        $table->addColumn( 'created', 'datetime', [
            'default' => null,
            'null'    => false
        ]);
        $table->addColumn( 'modified', 'datetime', [
            'default' => null,
            'null'    => true
        ]);
        $table->create();
    }
}
