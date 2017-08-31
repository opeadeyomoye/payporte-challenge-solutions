<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TicketsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TicketsTable Test Case
 */
class TicketsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TicketsTable
     */
    public $Tickets;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.tickets',
        'app.ticket_types',
        'app.events'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Tickets') ? [] : ['className' => 'App\Model\Table\TicketsTable'];
        $this->Tickets = TableRegistry::get('Tickets', $config);
    }

    public function testCreateMultiple()
    {
        $ticket = [
            'ticket_type_id' => '3',
            'event_id' => '4',
            'expires' => time() + 20000
        ];
        $this->assertContainsOnlyInstancesOf(
            '\App\Model\Entity\Ticket',
            $this->Tickets->createMultiple($ticket, 2)
        );
    }

    public function testUpdateExpiration()
    {
        $this->assertInstanceOf(
            '\App\Model\Entity\Ticket',
            $this->Tickets->updateExpiration(1, time() + 10000)
        );
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Tickets);

        parent::tearDown();
    }


}
