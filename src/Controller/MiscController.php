<?php

namespace App\Controller;

use App\Model\Entity\Date;
use Cake\I18n\FrozenDate;

/**
 * Misc Controller
 */
class MiscController extends AppController
{
    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');

        if ($user['is_active']) {
            if (in_array($action, ['dashboard'])) {
                return true;
            }
        } else {
            $this->redirect(['controller' => 'pages', 'action' => 'welcome']);
        }

        return parent::isAuthorized($user);
    }

    /**
     * Dashboard method
     *
     * @return \Cake\Network\Response|null
     */
    public function dashboard()
    {
        $this->loadModel('Dates');
        $this->loadModel('Songs');
        $this->loadModel('Ideas');
        $this->loadModel('Collections');

        $now = new FrozenDate();
        $dates = $this->Dates->find(
            'all',
            [
                'conditions' => [
                    'Dates.begin >=' => $now,
                    'OR' => [
                        ['Dates.status' => Date::STATUS_UNCONFIRMED],
                        ['Dates.status' => Date::STATUS_CONFIRMED],
                    ],
                ],
                'order' => 'Dates.begin ASC',
                'limit' => 5,
            ]
        );
        $songs = $this->Songs->find(
            'all',
            [
                'order' => 'modified DESC',
                'limit' => 5,
            ]
        );
        $ideas = $this->Ideas->find(
            'all',
            [
                'contain' => ['Comments'],
                'order' => 'modified DESC',
                'limit' => 5,
            ]
        );
        $collections = $this->Collections->find(
            'all',
            [
                'contain' => ['Files', 'Songs'],
                'order' => 'modified DESC',
                'limit' => 5,
            ]
        );

        $this->set(compact('dates', 'songs', 'ideas', 'collections'));
        $this->set('_serialize', ['dates', 'songs', 'ideas', 'collections']);
    }
}
