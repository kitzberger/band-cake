<?php

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;

/**
 * Files Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Dates
 * @property \Cake\ORM\Association\BelongsTo $Ideas
 * @property \Cake\ORM\Association\BelongsTo $Songs
 * @property \Cake\ORM\Association\BelongsToMany $Collections
 * @property \Cake\ORM\Association\HasMany $Shares
 *
 * @method \App\Model\Entity\File get($primaryKey, $options = [])
 * @method \App\Model\Entity\File newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\File[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\File|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\File patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\File[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\File findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FilesTable extends AbstractTable
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

        $this->setTable('files');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Footprint');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'LEFT'
        ]);
        $this->belongsTo('Dates', [
            'foreignKey' => 'date_id'
        ]);
        $this->belongsTo('Ideas', [
            'foreignKey' => 'idea_id'
        ]);
        $this->belongsTo('Songs', [
            'foreignKey' => 'song_id'
        ]);
        $this->belongsToMany('Collections', [
            'foreignKey' => 'file_id',
            'targetForeignKey' => 'collection_id',
            'joinTable' => 'collections_files'
        ]);
        $this->hasMany('Shares', [
            'foreignKey' => 'files_id'
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('user_id', 'create')
            ->notEmpty('user_id');

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->requirePresence('file', 'create')
            ->notEmpty('file');

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
        $rules->add($rules->existsIn(['date_id'], 'Dates'));
        $rules->add($rules->existsIn(['idea_id'], 'Ideas'));
        $rules->add($rules->existsIn(['song_id'], 'Songs'));

        return $rules;
    }

    public function afterSave(\Cake\Event\Event $event, \Cake\Datasource\EntityInterface $entity, \ArrayObject $options)
    {
        if ($entity->song_id) {
            $songs = \Cake\ORM\TableRegistry::get('Songs');
            $songs->query()
                ->update()
                ->set(['modified' => time()])
                ->where(['id' => $entity->song_id])
                ->execute();
        }
        if ($entity->collection_id) {
            $collections = \Cake\ORM\TableRegistry::get('Collections');
            $collections->query()
                ->update()
                ->set(['modified' => time()])
                ->where(['id' => $entity->collection_id])
                ->execute();
        }
        if ($entity->date_id) {
            $dates = \Cake\ORM\TableRegistry::get('Dates');
            $dates->query()
                ->update()
                ->set(['modified' => time()])
                ->where(['id' => $entity->date_id])
                ->execute();
        }
        if ($entity->idea_id) {
            $ideas = \Cake\ORM\TableRegistry::get('Ideas');
            $ideas->query()
                ->update()
                ->set(['modified' => time()])
                ->where(['id' => $entity->idea_id])
                ->execute();
        }
    }

    public function afterSaveCommit(\Cake\Event\Event $event, \Cake\Datasource\EntityInterface $entity, \ArrayObject $options)
    {
        $diff = $this->getDiff($entity, ['title', 'file', 'is_public']);

        if (!empty($diff)) {
            $logs = \Cake\ORM\TableRegistry::get('Logs');
            $log = $logs->newEntity([
                'user_id' => $entity->modified_by,
                'file_id' => $entity->id,
                'created' => $entity->modified,
                'diff' => $diff,
            ]);
            if ($entity->date_id) {
                $log->date_id = $entity->date_id;
            }
            if ($entity->idea_id) {
                $log->idea_id = $entity->idea_id;
            }
            if ($entity->song_id) {
                $log->song_id = $entity->song_id;
            }

            $logs->save($log);
        }
    }
}
