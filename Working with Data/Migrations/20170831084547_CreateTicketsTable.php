<?php

namespace Migrations;

use Phinx\Migration\AbstractMigration;

class CreateTicketsTable extends AbstractMigration
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
        $table = $this->table('tickets');

        $table->addColumn( 'ticket_type_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false
        ]);
        $table->addColumn( 'event_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null'    => false
        ]);
        $table->addColumn( 'expires', 'integer', [
            'default' => null,
            'limit' => 20,
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
