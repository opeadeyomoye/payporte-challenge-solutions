<?php
/**
 * Created by PhpStorm.
 * User: opeadeyomoye
 * Date: 8/30/17
 * Time: 10:18 PM
 */

namespace App\Test\TestCase\Model\Validation\TicketTypes;


use App\Model\Validation\TicketTypes\CreateTicketType as CreateTicketTypeValidator;
use Cake\TestSuite\TestCase;

class CreateTicketTypeTest extends TestCase
{
    /**
     * @var CreateTicketTypeValidator
     */
    public $validator;


    public function setUp()
    {
        $this->validator = new CreateTicketTypeValidator();
    }

    public function testValidSchemaPasses()
    {
        $ticketType = [
            'event_id' => '3',
            'title' => 'an event',
            'available' => '3'
        ];
        $this->assertEmpty($this->validator->check($ticketType));
    }

    public function testInvalidSchemasFail()
    {
        $valid = [
            'event_id' => '3',
            'title' => 'an event',
            'available' => '3'
        ];
        $invalid1 = $valid;
        $invalid1['event_id'] = 'invalid'; // should be an integer

        $invalid2 = $valid;
        unset($invalid2['title']); // title should be present

        $invalid3 = $valid;
        $invalid3['available'] = 'invalid'; // should be an integer

        $this->assertEmpty($this->validator->check($valid));

        $this->assertNotEmpty($this->validator->check($invalid1));
        $this->assertNotEmpty($this->validator->check($invalid2));
        $this->assertNotEmpty($this->validator->check($invalid3));

        $this->assertArrayHasKey('event_id', $this->validator->check($invalid1));
        $this->assertArrayHasKey('title', $this->validator->check($invalid2));
        $this->assertArrayHasKey('available', $this->validator->check($invalid3));
    }

}