<?php
/**
 * Created by PhpStorm.
 * User: opeadeyomoye
 * Date: 8/30/17
 * Time: 1:19 PM
 */

namespace App\Model\Validation\Tickets;

use App\Model\Validation\ValidatorInterface;
use App\Model\Validation\ValidatorTrait;

/**
 * Class CreateTicket
 *
 * Holds validation rules for creating a ticket.
 *
 * @package App\Model\Validation\Tickets
 */
class CreateTicket implements ValidatorInterface
{
    use ValidatorTrait;

    /**
     * {@inheritdoc}
     */
    public function initialize()
    {
        $this->validator
            ->integer('ticket_type_id')
            ->requirePresence('ticket_type_id')
            ->notEmpty('ticket_type_id', 'Please specify the ticket type id');

        $this->validator
            ->integer('event_id')
            ->requirePresence('ticket_type_id')
            ->notEmpty('event_id', 'Please specify the event id');

        $this->validator
            ->integer('expires', "Please specify a valid timestamp for the ticket's expiration date")
            ->requirePresence('ticket_type_id')
            ->notEmpty('expires', 'Please specify an expiration time')
            ->greaterThanOrEqual('expires', time(), 'Sorry, you can not create an already expired ticket');

        $this->validator
            ->integer('number', 'Please specify a valid number of tickets to create')
            ->requirePresence('ticket_type_id');
    }
}
