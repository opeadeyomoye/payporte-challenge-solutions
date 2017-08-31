<?php
namespace App\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TicketTypesTable Test Case
 */
class TicketTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TicketTypesTable
     */
    public $TicketTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ticket_types',
        'app.events',
        'app.tickets'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TicketTypes') ? [] : ['className' => 'App\Model\Table\TicketTypesTable'];
        $this->TicketTypes = TableRegistry::get('TicketTypes', $config);
    }

    public function testAdd()
    {
        $ticketType = [
            'event_id' => '3',
            'title' => 'an event',
            'available' => '3'
        ];
        $this->assertInstanceOf('\App\Model\Entity\TicketType', $this->TicketTypes->add($ticketType));
    }

    public function testUpdate()
    {
        $ticketType = [
            'id' => 1,
            'event_id' => '3',
            'title' => 'an event',
            'available' => '3'
        ];
        $this->assertInstanceOf('\App\Model\Entity\TicketType', $this->TicketTypes->update($ticketType));
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TicketTypes);

        parent::tearDown();
    }
}
