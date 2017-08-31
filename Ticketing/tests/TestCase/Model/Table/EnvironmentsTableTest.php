<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EnvironmentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EnvironmentsTable Test Case
 */
class EnvironmentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EnvironmentsTable
     */
    public $Environments;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.environments'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Environments') ? [] : ['className' => 'App\Model\Table\EnvironmentsTable'];
        $this->Environments = TableRegistry::get('Environments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Environments);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
