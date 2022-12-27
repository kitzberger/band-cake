<?php

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LocationsMails Model
 *
 * @property \App\Model\Table\LocationsTable|\Cake\ORM\Association\BelongsTo $Locations
 * @property \App\Model\Table\MailsTable|\Cake\ORM\Association\BelongsTo $Mails
 *
 * @method \App\Model\Entity\LocationsMail get($primaryKey, $options = [])
 * @method \App\Model\Entity\LocationsMail newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\LocationsMail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\LocationsMail|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LocationsMail saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LocationsMail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\LocationsMail[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\LocationsMail findOrCreate($search, callable $callback = null, $options = [])
 */
class LocationsMailsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('locations_mails');
        $this->setDisplayField('location_id');
        $this->setPrimaryKey(['location_id', 'mail_id']);

        $this->belongsTo('Locations', [
            'foreignKey' => 'location_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Mails', [
            'foreignKey' => 'mail_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->email('email')
            ->allowEmptyString('email');

        $validator
            ->scalar('subject')
            ->maxLength('subject', 255)
            ->allowEmptyString('subject');

        $validator
            ->scalar('text')
            ->allowEmptyString('text');

        $validator
            ->dateTime('sent')
            ->allowEmptyDateTime('sent');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['location_id'], 'Locations'));
        $rules->add($rules->existsIn(['mail_id'], 'Mails'));

        return $rules;
    }
}
