<?php
/**
 * Created by PhpStorm.
 * User: opeadeyomoye
 * Date: 8/30/17
 * Time: 9:52 PM
 */

namespace App\Test\TestCase\Model\Validation\Tickets;


use App\Model\Validation\Tickets\CreateTicket as CreateTicketValidator;
use Cake\TestSuite\TestCase;

class CreateTicketTest extends TestCase
{
    /**
     * @var CreateTicketValidator
     */
    public $validator;


    public function setUp()
    {
        $this->validator = new CreateTicketValidator();
    }

    public function testValidSchemaPasses()
    {
        $createTicket = [
            'ticket_type_id' => '2',
            'event_id' => '3',
            'expires' => time() + 10000,
            'number' => '3'
        ];
        $this->assertEmpty($this->validator->check($createTicket));
    }

    public function testInvalidSchemasFail()
    {
        $valid = [
            'ticket_type_id' => '1',
            'event_id' => '3',
            'expires' => time() + 10000,
            'number' => '3'
        ];
        $invalid1 = $valid;
        $invalid1['ticket_type_id'] = 'invalid'; // should be an integer

        $invalid2 = $valid;
        $invalid2['event_id'] = 'invalid'; // should be an integer

        $invalid3 = $valid;
        $invalid3['expires'] = time() - 10000; // should be a time in the future

        $invalid4 = $valid;
        $invalid4['number'] = 'invalid'; // should be an integer

        $this->assertEmpty($this->validator->check($valid));

        $this->assertNotEmpty($this->validator->check($invalid1));
        $this->assertNotEmpty($this->validator->check($invalid2));
        $this->assertNotEmpty($this->validator->check($invalid3));
        $this->assertNotEmpty($this->validator->check($invalid4));

        $this->assertArrayHasKey('ticket_type_id', $this->validator->check($invalid1));
        $this->assertArrayHasKey('event_id', $this->validator->check($invalid2));
        $this->assertArrayHasKey('expires', $this->validator->check($invalid3));
        $this->assertArrayHasKey('number', $this->validator->check($invalid4));
    }
}
