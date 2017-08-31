<?php
use Migrations\AbstractMigration;

class CreateTicketTypesTable extends AbstractMigration
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
        $table = $this->table('ticket_types');

        $table->addColumn( 'event_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null'    => false
        ]);
        $table->addColumn( 'title', 'text', [
            'default' => null,
            'null'    => true
        ]);
        $table->addColumn( 'available', 'integer', [
            'default' => null,
            'limit' => 11,
            'null'    => false
        ]);
        $table->addColumn( 'purchased', 'integer', [
            'default' => null,
            'limit' => 11,
            'null'    => false
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
