<?php
/**
 * Created by PhpStorm.
 * User: opeadeyomoye
 * Date: 8/30/17
 * Time: 10:17 AM
 */

namespace App\Controller\Api;

use App\Controller\Api\Traits\ValidatesInput;
use App\Model\Validation\Tickets as Validators;

/**
 * Class TicketsController
 *
 * Houses actions for the `/tickets` API collection.
 *
 * @property \App\Model\Table\TicketsTable $Tickets
 *
 * @package App\Controller\Api
 */
class TicketsController extends AppController
{
    use ValidatesInput;

    /**
     * Get all tickets.
     *
     * @return \Cake\Http\Response
     */
    public function index()
    {
        $tickets = $this->Tickets->find()->all()->toArray();

        return $this->response
            ->withStatus(200)
            ->withStringBody(json_encode($tickets));
    }

    /**
     * Create a ticket.
     *
     * @return \Cake\Http\Response
     */
    public function create()
    {
        $ticket = $this->getJsonInput();
        $this->validator(new Validators\CreateTicket())->validate($ticket);

        // try to create the ticket(s)
        if (!($tickets = $this->Tickets->createMultiple($ticket, $ticket['number']))) {
            return $this->response
                ->withStatus(500)
                ->withStringBody(json_encode(['errorMsg' => 'Could not create tickets.']));
        }

        // if all goes well...
        return $this->response
            ->withStatus(201)
            ->withStringBody(json_encode($tickets));
    }

    /**
     * Edit a ticket.
     *
     * @param int $ticketId
     *
     * @return \Cake\Http\Response
     */
    public function edit($ticketId)
    {
        $ticket = $this->getJsonInput();
        $this->validator(new Validators\EditTicket())->validate();

        if (!($updatedTicket = $this->Tickets->updateExpiration($ticketId, $ticket['expires']))) {
            return $this->response
                ->withStatus(500)
                ->withStringBody(json_encode(['errorMsg' => 'Could not update ticket.']));
        }

        return $this->response
            ->withStatus(200)
            ->withStringBody(json_encode($updatedTicket));
    }
}
