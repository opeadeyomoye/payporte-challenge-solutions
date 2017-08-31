<?php
/**
 * Created by PhpStorm.
 * User: opeadeyomoye
 * Date: 8/30/17
 * Time: 8:17 PM
 */

namespace App\Model\Validation\TicketTypes;


use App\Model\Validation\ValidatorInterface;
use App\Model\Validation\ValidatorTrait;

/**
 * Class UpdateTicketType
 *
 * Holds validation rules for updating a ticket-type.
 *
 * @package App\Model\Validation\TicketTypes
 */
class UpdateTicketType implements ValidatorInterface
{
    use ValidatorTrait;

    /**
     * {@inheritdoc}
     */
    public function initialize()
    {
        $this->validator
            ->integer('event_id')
            ->notEmpty('event_id');

        $this->validator
            ->notEmpty('title');

        $this->validator
            ->integer('available')
            ->notEmpty('available');
    }
}