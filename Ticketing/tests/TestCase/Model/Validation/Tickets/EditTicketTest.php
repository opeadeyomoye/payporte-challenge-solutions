<?php
/**
 * Created by PhpStorm.
 * User: opeadeyomoye
 * Date: 8/30/17
 * Time: 10:15 PM
 */

namespace App\Test\TestCase\Model\Validation\Tickets;


use App\Model\Validation\Tickets\EditTicket as EditTicketValidator;
use Cake\TestSuite\TestCase;

class EditTicketTest extends TestCase
{
    /**
     * @var EditTicketValidator
     */
    public $validator;


    public function setUp()
    {
        $this->validator = new EditTicketValidator();
    }

    public function testValidSchemaPasses()
    {
        $editTicket = [
            'expires' => time() + 1000
        ];
        $this->assertEmpty($this->validator->check($editTicket));
    }

    public function testInvalidSchemasFail()
    {
        $invalid = ['expires' => 'kxx'];
        $this->assertNotEmpty($this->validator->check($invalid));
    }

}