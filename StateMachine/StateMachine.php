<?php
/**
 * Created by PhpStorm.
 * User: opeadeyomoye
 * Date: 8/30/17
 * Time: 9:42 AM
 */

namespace PayPorte\Events;

// given the pre-declared EventDispatcher interface...

interface EventDispatcher
{
    /**
     * Dispatches an event.
     */
    public function dispatch($eventName, array $parameters = array());

    /**
     * Attaches the $callable to an event, so that it will get executed
     * once the event is dispatched.
     */
    public function on($eventName, $calllable);
}

// I'll create a trait that helps implement that interface:

trait ChangesState
{
    public function dispatch($eventName, array $parameters = array())
    {
        // ...
    }

    public function on($eventName, $callable)
    {
        // ...
    }
}

/**
 * then, classes that need to make their change of state known can
 * `use` this trait, and call `$this->dispatch(...)` wherever necessary.
 *
 * HOWEVER, it's probably a better idea to split the declarations in the EventDispatcher interface
 * into two interfaces, say, `EventListenerInterface` and `EventDispatcherInterface`, since some classes
 * may want to declare a change in state, but not necessarily act on other changes in state.
 */


interface EventDispatcherInterface
{
    /**
     * Dispatches an event.
     *
     * @param   string    $eventName
     * @param   array     $parameters
     *
     * @return mixed
     */
    public function dispatch($eventName, array $parameters = array());
}

interface EventListenerInterface
{
    /**
     * Attaches the $callable to an event, so that it will get executed
     * once the event is dispatched.
     *
     * @param   string      $eventName
     * @param   callable    $callable
     *
     * @return mixed
     */
    public function on($eventName, $callable);
}

// then in our dispatcher trait, we'll have just one method => for dispatching events only.
// classes that listen to events will have to implement the listener interface
// and provide their listener method(s)

trait EventDispatcherTrait
{
    /**
     * Dispatches an event.
     *
     * @param   string    $eventName
     * @param   array     $parameters
     *
     * @return mixed
     */
    public function dispatch($eventName, array $parameters = array())
    {
        // ...
    }
}
