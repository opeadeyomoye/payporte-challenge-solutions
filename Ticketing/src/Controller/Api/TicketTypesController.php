<?php
/**
 * Created by PhpStorm.
 * User: opeadeyomoye
 * Date: 8/30/17
 * Time: 2:47 PM
 */

namespace App\Controller\Api;


use App\Controller\Api\Traits\ValidatesInput;
use App\Model\Validation\TicketTypes as Validators;

/**
 * Class TicketTypesController
 *
 * Houses request processors for the `tickets/types` API endpoint.
 *
 * @property \App\Model\Table\TicketTypesTable $TicketTypes
 *
 * @package App\Controller\Api
 */
class TicketTypesController extends AppController
{
    use ValidatesInput;

    /**
     * Create a ticket-type.
     *
     * @return \Cake\Http\Response
     */
    public function create()
    {
        $ticketType = $this->getJsonInput();
        $this->validator(new Validators\CreateTicketType())->validate($ticketType);

        if (!($ticketTypeEntity = $this->TicketTypes->add($ticketType))) {
            return $this->response
                ->withStatus(500)
                ->withStringBody(json_encode(['errorMsg' => 'Could not create ticket-type.']));
        }

        // if all goes well...
        return $this->response
            ->withStatus(201)
            ->withStringBody(json_encode($ticketTypeEntity));
    }

    /**
     * Update a ticket-type.
     *
     * @param int $ticketTypeId
     *
     * @return \Cake\Http\Response
     */
    public function update($ticketTypeId)
    {
        $ticketType = $this->getJsonInput();
        $ticketType['id'] = $ticketTypeId;

        $this->validator(new Validators\UpdateTicketType())->validate($ticketType);

        if (!($ticketTypeEntity = $this->TicketTypes->update($ticketType))) {
            return $this->response
                ->withStatus(500)
                ->withStringBody(json_encode(['errorMsg' => 'Could not update ticket-type.']));
        }

        return $this->response
            ->withStatus(201)
            ->withStringBody(json_encode($ticketTypeEntity));
    }
}
