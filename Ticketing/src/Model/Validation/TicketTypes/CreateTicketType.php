<?php
/**
 * Created by PhpStorm.
 * User: opeadeyomoye
 * Date: 8/30/17
 * Time: 3:02 PM
 */

namespace App\Model\Validation\TicketTypes;

use App\Model\Validation\ValidatorInterface;
use App\Model\Validation\ValidatorTrait;

/**
 * Class CreateTicketType
 *
 * Holds validation rules for creating a ticket-type.
 *
 * @package App\Model\Validation\TicketTypes
 */
class CreateTicketType implements ValidatorInterface
{
    use ValidatorTrait;

    /**
     * {@inheritdoc}
     */
    public function initialize()
    {
        $this->validator
            ->integer('event_id')
            ->requirePresence('event_id')
            ->notEmpty('event_id', 'Please specify an event id for this ticket type.');

        $this->validator
            ->requirePresence('title')
            ->notEmpty('title', 'Please specify a title for this ticket type');

        $this->validator
            ->integer('available')
            ->requirePresence('available')
            ->notEmpty('available', 'Please specify how many tickets of this type are available');
    }
}
