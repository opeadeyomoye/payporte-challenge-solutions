<?php
namespace PayPorte\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tickets Model
 *
 * @property \Cake\ORM\Association\BelongsTo $TicketTypes
 * @property \Cake\ORM\Association\BelongsTo $Events
 *
 * @method \App\Model\Entity\Ticket get($primaryKey, $options = [])
 * @method \App\Model\Entity\Ticket newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Ticket[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Ticket|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ticket patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Ticket[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Ticket findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TicketsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('tickets');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('TicketTypes', [
            'foreignKey' => 'ticket_type_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Events', [
            'foreignKey' => 'event_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->integer('expires')
            ->allowEmpty('expires');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['ticket_type_id'], 'TicketTypes'));
        $rules->add($rules->existsIn(['event_id'], 'Events'));

        return $rules;
    }

    /**
     * Helps create multiple tickets.
     *
     * @param array $ticket An array (ideally) containing `ticket_type_id`, `event_id` and `expires`
     * @param int   $number The number of tickets to create
     *
     * @return array|bool|\Cake\ORM\ResultSet
     */
    public function createMultiple(array $ticket, $number = 1)
    {
        $template = [
            'ticket_type_id' => '',
            'event_id' => '',
            'expires' => ''
        ];
        $template = array_intersect_key($ticket, $template);

        if (!empty($this->newEntity($template)->getErrors())) {
            return false;
        }

        $entitiesArray = array_fill(0, $number, $template);
        return $this->saveMany(
            $this->newEntities($entitiesArray)
        );
    }

    /**
     * Update a ticket's expiration date.
     *
     * @param int $ticketId
     * @param int $expires
     *
     * @return \App\Model\Entity\Ticket|bool
     */
    public function updateExpiration($ticketId, $expires)
    {
        if (!($ticket = $this->get($ticketId))) {
            return false;
        }
        $ticket->set('expires', $expires);
        return $this->save($ticket);
    }
}
