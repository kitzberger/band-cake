<?php

namespace App\Model\Behavior;

use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\Event\EventInterface;
use Cake\ORM\Behavior;

class FootprintBehavior extends Behavior
{
    public function getFootprint(EntityInterface $entity)
    {
        if (isset($_SESSION['Auth'])) {
            if ($entity->isNew()) {
                $entity->set('created_by', $_SESSION['Auth']['User']['id']);
                $entity->set('modified_by', $_SESSION['Auth']['User']['id']);
            } else {
                $entity->set('modified_by', $_SESSION['Auth']['User']['id']);
            }
        }
    }

    public function beforeSave(EventInterface $event, EntityInterface $entity, ArrayObject $options)
    {
        $this->getFootprint($entity);
    }
}
