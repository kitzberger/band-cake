<?php

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;

/**
 * BandsUsers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Bands
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\BandsFile get($primaryKey, $options = [])
 * @method \App\Model\Entity\BandsFile newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BandsFile[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BandsFile|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BandsFile patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BandsFile[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BandsFile findOrCreate($search, callable $callback = null)
 */
class BandsUsersTable extends Table
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

        $this->setTable('bands_users');
        $this->setDisplayField('band_id');
        $this->setPrimaryKey(['band_id', 'user_id']);

        $this->belongsTo('Bands', [
            'foreignKey' => 'band_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
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
        $rules->add($rules->existsIn(['band_id'], 'Bands'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
