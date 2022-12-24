<?php

namespace App\Controller;

/**
 * Logs Controller
 *
 * @property \App\Model\Table\LogsTable $Logs
 */
class LogsController extends AppController
{
    protected $contain = [
        'Users',
        'Songs',
        'Dates',
        'Ideas',
        'Comments',
        'Comments.Ideas',
        'Comments.Dates',
        'Comments.Songs',
        'Collections',
        'Votes',
        'Votes.Ideas',
        'Votes.Dates',
        'Files',
        'Files.Ideas',
        'Files.Dates',
        'Files.Songs',
        'Shares',
    ];

    public function isAuthorized($user)
    {
        if ($user['is_active']) {
            if (in_array($this->request->getParam('action'), ['index', 'view'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => $this->contain,
            'order' => ['Logs.created DESC'],
        ];
        $logs = $this->paginate($this->Logs);

        $this->set(compact('logs'));
        $this->set('_serialize', ['logs']);
    }

    /**
     * View method
     *
     * @param string|null $id Log id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $log = $this->Logs->get($id, [
            'contain' => $this->contain
        ]);

        $this->set('log', $log);
        $this->set('_serialize', ['log']);
    }

    /**
     * Notify method (called from CLI)
     *
     * @param \App\Table\User $user
     * @return string
     */
    public function notify($user)
    {
        $logs = $this->Logs->find(
            'all',
            [
                'contain' => $this->contain,
                'order' => ['Logs.created DESC'],
                'conditions' => [
                    'Logs.user_id !=' => $user['id'],
                    'Logs.created >' => $user['notified'] ? $user['notified'] : '2000-01-01',
                    'Logs.share_id' => 0 // don't include log entries about shares
                ],
            ]
        );

        if ($logs->count()) {
            $this->sendMail(
                __('Notification'),
                null,
                $user['email'],
                'notify',
                [
                    'user' => $user,
                    'logs' => $logs,
                ]
            );
        }


        return $logs->count();
    }
}
