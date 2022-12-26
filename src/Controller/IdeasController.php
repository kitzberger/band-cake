<?php

namespace App\Controller;

/**
 * Ideas Controller
 *
 * @property \App\Model\Table\IdeasTable $Ideas
 */
class IdeasController extends AppController
{
    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');

        if ($user['is_active']) {
            if (in_array($action, ['index', 'view', 'add', 'share', 'edit'])) {
                return true;
            }

            if (in_array($action, ['delete'])) {
                $ideaId = (int)$this->request->getParam('pass')[0];
                if ($this->Ideas->isOwnedBy($ideaId, $user['id'])) {
                    return true;
                }
            }
        } else {
            if (in_array($action, ['view'])) {
                if (parent::isAuthorizedByShare($user, 'idea')) {
                    return true;
                }
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
        $sword = $this->request->getQuery('sword');

        $this->paginate = [
            'contain' => ['Users'],
            'order' => ['Ideas.modified DESC'],
            'conditions' => ['Ideas.title LIKE' => '%' . $sword . '%'],
        ];

        $ideas = $this->paginate($this->Ideas);

        $this->set(compact('ideas', 'sword'));
        $this->set('_serialize', ['ideas']);
    }

    /**
     * View method
     *
     * @param string|null $id Idea id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->loadModel('Users');
        $users = $this->Users->find(
            'all',
            [
                'conditions' => [
                    'Users.is_active' => true,
                ],
            ]
        );
        $passiveUsers = $this->Users->find(
            'all',
            [
                'conditions' => [
                    'Users.is_passive' => true,
                ],
            ]
        );

        $idea = $this->Ideas->get($id, [
            'contain' => [
                'Users',
                'Comments' => ['sort' => ['Comments.modified' => 'ASC']],
                'Files' => ['sort' => ['Files.modified' => 'DESC']],
                'Votes' => ['sort' => ['Votes.modified' => 'DESC']],
                'Files.Users',
                'Comments.Users',
                'Votes.Users',
                'Shares.Users',
            ]
        ]);

        $this->set('idea', $idea);
        $this->set('users', $users);
        $this->set('passiveUsers', $passiveUsers);
        $this->set('_serialize', ['idea']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $idea = $this->Ideas->newEmptyEntity();
        if ($this->request->is('post')) {
            $idea = $this->Ideas->patchEntity($idea, $this->request->getData());
            if ($this->Ideas->save($idea)) {
                $this->Flash->success(__('The idea has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The idea could not be saved. Please, try again.'));
            }
        }
        $users = $this->Ideas->Users->find('list', ['limit' => 200]);
        $this->set(compact('idea', 'users'));
        $this->set('_serialize', ['idea']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Idea id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $idea = $this->Ideas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $idea = $this->Ideas->patchEntity($idea, $this->request->getData());
            if ($this->Ideas->save($idea)) {
                $this->Flash->success(__('The idea has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The idea could not be saved. Please, try again.'));
            }
        }
        $users = $this->Ideas->Users->find('list', ['limit' => 200]);
        $this->set(compact('idea', 'users'));
        $this->set('_serialize', ['idea']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Idea id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $idea = $this->Ideas->get($id);
        if ($this->Ideas->delete($idea)) {
            $this->Flash->success(__('The idea has been deleted.'));
        } else {
            $this->Flash->error(__('The idea could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Shares a idea with a passive user.
     *
     * @param string|null $idea Idea id.
     * @param string|null $user User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function share($idea = null, $user = null, $template = 'share')
    {
        $this->loadModel('Users');
        $this->loadModel('Shares');

        $idea = $this->Ideas->get($idea, []);
        $user = $this->Users->get($user, [
            'conditions' => [
                'Users.is_passive' => true,
            ],
        ]);

        $subject = __('An idea is now shared with you!');
        $message = __('What\'s your opinion on this here?');

        if ($user) {
            if (!$this->Shares->sharedWithUser('idea', $idea->id, $user['id'])) {
                $share = $this->Shares->newEmptyEntity();
                $share->user = $user;
                $share->idea = $idea;
                $this->Shares->save($share);
            }

            $this->sendMail($subject, $message, $user->email, $template, ['user' => $user, 'idea' => $idea]);
            $this->Flash->success(__('The user has been asked.'));
        } else {
            $this->Flash->error(__('The user could not be asked. Please, try again.'));
        }

        return $this->redirect(['action' => 'view', $idea->id]);
    }
}
