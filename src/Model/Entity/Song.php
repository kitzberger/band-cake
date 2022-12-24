<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Song Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $artist
 * @property string $url
 * @property string $text
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Comment[] $comments
 * @property \App\Model\Entity\File[] $files
 * @property \App\Model\Entity\Share[] $shares
 * @property \App\Model\Entity\SongsVersion[] $versions
 */
class Song extends Entity
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
        'id' => false
    ];
}
