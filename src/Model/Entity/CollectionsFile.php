<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CollectionsFile Entity
 *
 * @property int $collection_id
 * @property int $file_id
 * @property int $sorting
 *
 * @property \App\Model\Entity\Collection $collection
 * @property \App\Model\Entity\File $file
 */
class CollectionsFile extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'collection_id' => false,
        'file_id' => false
    ];
}
