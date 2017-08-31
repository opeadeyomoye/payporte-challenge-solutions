<?php
/**
 * Created by PhpStorm.
 * User: opeadeyomoye
 * Date: 8/30/17
 * Time: 10:20 PM
 */

namespace App\Test\TestCase\Model\Validation\TicketTypes;

use App\Model\Validation\TicketTypes\UpdateTicketType as UpdateTicketTypeValidator;
use Cake\TestSuite\TestCase;

class UpdateTicketTypeTest extends TestCase
{
    /**
     * @var UpdateTicketTypeValidator
     */
    public $validator;


    public function setUp()
    {
        $this->validator = new UpdateTicketTypeValidator();
    }

    public function testValidSchemaPasses()
    {
        $ticketType = [
            'title' => 'A new event title'
        ];
        $this->assertEmpty($this->validator->check($ticketType));
    }

    public function testInvalidSchemasFail()
    {
        $valid = [
            'title' => 'A new event title'
        ];
        $invalid1 = $valid;
        $invalid1['title'] = ''; // should not be empty if available

        $invalid2 = $valid;
        $invalid2['event_id'] = 'invalid'; // should be an integer

        $invalid3 = $valid;
        $invalid3['available'] = 'invalid'; // should be an integer

        $this->assertEmpty($this->validator->check($valid));

        $this->assertNotEmpty($this->validator->check($invalid1));
        $this->assertNotEmpty($this->validator->check($invalid2));
        $this->assertNotEmpty($this->validator->check($invalid3));

        $this->assertArrayHasKey('title', $this->validator->check($invalid1));
        $this->assertArrayHasKey('event_id', $this->validator->check($invalid2));
        $this->assertArrayHasKey('available', $this->validator->check($invalid3));
    }

}
