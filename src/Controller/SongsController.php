<?php

namespace App\Controller;

/**
 * Songs Controller
 *
 * @property \App\Model\Table\SongsTable $Songs
 */
class SongsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Github');
    }

    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');

        if ($user['is_active']) {
            if (in_array($action, ['index', 'view', 'add', 'display'])) {
                return true;
            }

            if (in_array($action, ['edit', 'delete'])) {
                $songId = (int)$this->request->getParam('pass')[0];
                if ($this->Songs->isOwnedBy($songId, $user['id'])) {
                    return true;
                }
            }
        } else {
            if (in_array($action, ['view', 'display'])) {
                if (parent::isAuthorizedByShare($user, 'song')) {
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
            'contain' => ['Users', 'SongsVersions'],
            'order' => ['Songs.modified DESC'],
            'conditions' => [
                'OR' => [
                    'Songs.title LIKE' => '%' . $sword . '%',
                    'Songs.artist LIKE' => '%' . $sword . '%',
                ],
            ],
        ];
        $songs = $this->paginate($this->Songs);

        $this->set(compact('songs', 'sword'));
        $this->set('_serialize', ['songs']);
    }

    /**
     * View method
     *
     * @param string|null $id Song id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $song = $this->Songs->get($id, [
            'contain' => [
                'Users',
                'Comments' => ['sort' => ['Comments.created' => 'ASC']],
                'Comments.Users',
                'Files' => ['sort' => ['Files.created' => 'DESC']],
                'Files.Users',
                'Files.Collections',
                'Collections.Users',
                'SongsVersions',
                'SongsVersions.Files' => ['conditions' => ['is_public' => 1]],
            ]
        ]);

        $this->set('song', $song);
        $this->set('_serialize', ['song']);
    }

    /**
     * Render method
     *
     * @param string|null $id Song id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function display($id = null)
    {
        $song = $this->Songs->get($id);

        if (isset($this->request->query['transposeBy'])) {
            $this->set('transposeBy', $this->request->query['transposeBy']);
        } else {
            $this->set('transposeBy', 0);
        }

        $this->set('mode', $this->request->query['mode'] ?? 'full');

        $this->set('song', $song);
        $this->set('_serialize', ['song']);
    }

    /**
     * Sync method
     *
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function sync()
    {
        if ($this->enabledFeatures['githubEnabled']) {
            $songs = $this->Songs->find('all')->where(['Songs.url !=' => '']);

            $count = 0;
            foreach ($songs as $song) {
                if ($song['url']) {
                    $songText = $this->Github->loadResource($song['url']);
                    if ($songText && $songText != $song['text']) {
                        $song = $this->Songs->patchEntity($song, ['text' => $songText]);
                        if ($this->Songs->save($song)) {
                            $this->Flash->success(sprintf(__('The song "{0}" has been updated.', $song['title'])));
                            $count++;
                        }
                    }
                }
            }

            if ($count === 0) {
                $this->Flash->default(__('No songs updated!'));
            }
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $song = $this->Songs->newEmptyEntity();
        if ($this->request->is('post')) {
            $song = $this->Songs->patchEntity($song, $this->request->getData());
            if ($this->Songs->save($song)) {
                $this->Flash->success(__('The song has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The song could not be saved. Please, try again.'));
            }
        }
        $users = $this->Songs->Users->find('list', ['limit' => 200]);
        $this->set(compact('song', 'users'));
        $this->set('_serialize', ['song']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Song id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $song = $this->Songs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $song = $this->Songs->patchEntity($song, $this->request->getData());
            if ($this->Songs->save($song)) {
                $this->Flash->success(__('The song has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The song could not be saved. Please, try again.'));
            }
        }
        $users = $this->Songs->Users->find('list', ['limit' => 200]);
        $this->set(compact('song', 'users'));
        $this->set('_serialize', ['song']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Song id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $song = $this->Songs->get($id);
        if ($this->Songs->delete($song)) {
            $this->Flash->success(__('The song has been deleted.'));
        } else {
            $this->Flash->error(__('The song could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
