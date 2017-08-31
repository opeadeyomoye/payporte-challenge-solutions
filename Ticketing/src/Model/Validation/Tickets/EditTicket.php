<?php
/**
 * Created by PhpStorm.
 * User: opeadeyomoye
 * Date: 8/30/17
 * Time: 2:25 PM
 */

namespace App\Model\Validation\Tickets;

use App\Model\Validation\ValidatorInterface;
use App\Model\Validation\ValidatorTrait;

/**
 * Class EditTicket
 *
 * Validation rules for editing a ticket.
 *
 * @package App\Model\Validation\Tickets
 */
class EditTicket implements ValidatorInterface
{
    use ValidatorTrait;

    /**
     * {@inheritdoc}
     */
    public function initialize()
    {
        // for our tickets, only the expiration date can be edited
        $this->validator
            ->integer('expires', "Please specify a valid timestamp for the ticket's expiration date")
            ->requirePresence('expires')
            ->notEmpty('expires');
    }
}
