<?php

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;

/**
 * Bands Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\HasMany $Users
 * @property \Cake\ORM\Association\HasMany $Dates
 * @property \Cake\ORM\Association\HasMany $Collections
 * @property \Cake\ORM\Association\HasMany $Songs
 * @property \Cake\ORM\Association\HasMany $SongVersions
 *
 * @method \App\Model\Entity\Song get($primaryKey, $options = [])
 * @method \App\Model\Entity\Song newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Song[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Song|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Song patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Song[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Song findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BandsTable extends AbstractTable
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

        $this->setTable('bands');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Footprint');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'LEFT'
        ]);
        $this->belongsToMany('Users', [
            'foreignKey' => 'band_id',
            'targetForeignKey' => 'user_id',
            'joinTable' => 'bands_users'
        ]);
        $this->belongsToMany('Songs', [
            'foreignKey' => 'band_id',
            'targetForeignKey' => 'song_id',
            'joinTable' => 'bands_songs'
        ]);
        $this->belongsToMany('Collections', [
            'foreignKey' => 'band_id',
            'targetForeignKey' => 'collection_id',
            'joinTable' => 'bands_collections'
        ]);
        $this->belongsToMany('Dates', [
            'foreignKey' => 'band_id',
            'targetForeignKey' => 'date_id',
            'joinTable' => 'bands_dates'
        ]);
        // $this->hasMany('Shares', [
        //     'foreignKey' => 'song_id'
        // ]);
        // $this->hasMany('SongsVersions', [
        //     'foreignKey' => 'song_id',
        //     'propertyName' => 'versions', // override ugly default property name 'songs_versions'
        // ]);
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }

    public function afterSaveCommit(\Cake\Event\Event $event, \Cake\Datasource\EntityInterface $entity, \ArrayObject $options)
    {
        $diff = $this->getDiff($entity, ['title', 'text']);

        if (!empty($diff)) {
            $logs = \Cake\ORM\TableRegistry::get('Logs');
            $log = $logs->newEntity([
                'user_id' => $entity->modified_by,
                'band_id' => $entity->id,
                'created' => $entity->modified,
                'diff' => $diff,
            ]);

            $logs->save($log);
        }
    }
}
