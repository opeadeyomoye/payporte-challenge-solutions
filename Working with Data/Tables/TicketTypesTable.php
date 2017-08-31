<?php
namespace PayPorte\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TicketTypes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Events
 * @property \Cake\ORM\Association\HasMany $Tickets
 *
 * @method \App\Model\Entity\TicketType get($primaryKey, $options = [])
 * @method \App\Model\Entity\TicketType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TicketType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TicketType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TicketType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TicketType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TicketType findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TicketTypesTable extends Table
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

        $this->setTable('ticket_types');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Events', [
            'foreignKey' => 'event_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Tickets', [
            'foreignKey' => 'ticket_type_id'
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
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->integer('available')
            ->requirePresence('available', 'create')
            ->notEmpty('available');

        $validator
            ->integer('purchased')
            ->requirePresence('purchased', 'create')
            ->notEmpty('purchased');

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
        $rules->add($rules->existsIn(['event_id'], 'Events'));

        return $rules;
    }


    /**
     * Persist a new TicketType entity.
     *
     * @param array $ticketType Should have passed through the CreateTicketType validator.
     *
     * @return \App\Model\Entity\TicketType|bool
     *
     * @see \App\Model\Validation\TicketTypes\CreateTicketType
     */
    public function add(array $ticketType)
    {
        $ticketType['purchased'] = 0;

        $entity = $this->newEntity($ticketType);

        if ($entity->getErrors()) {
            return false;
        }
        return $this->save($entity);
    }


    /**
     * Update a ticket type.
     *
     * @param array $ticketType Should have passed through the UpdateTicketType Validator.
     *
     * @return \App\Model\Entity\TicketType|bool
     *
     * @see \App\Model\Validation\TicketTypes\UpdateTicketType
     */
    public function update(array $ticketType)
    {
        if (!array_key_exists('id', $ticketType)) {
            return false;
        }
        if (!($entity = $this->get($ticketType['id']))) {
            return false;
        }
        $entity->set($ticketType);
        return $this->save($entity);
    }
}
