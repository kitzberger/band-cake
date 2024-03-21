<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Band Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $text
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\User[] $users
 * @property \App\Model\Entity\Idea[] $ideas
 * @property \App\Model\Entity\Date[] $dates
 * @property \App\Model\Entity\Song[] $songs
 * @property \App\Model\Entity\SongsVersion[] $versions
 * @property \App\Model\Entity\Collection[] $shares
 */
class Band extends Entity
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
