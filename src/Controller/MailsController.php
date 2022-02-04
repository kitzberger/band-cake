<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Mails Controller
 *
 * @property \App\Model\Table\MailsTable $Mails
 *
 * @method \App\Model\Entity\Mail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MailsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $mails = $this->paginate($this->Mails);

        $this->set(compact('mails'));
    }

    /**
     * View method
     *
     * @param string|null $id Mail id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $mail = $this->Mails->get($id, [
            'contain' => ['Users', 'Locations']
        ]);

        $this->set('mail', $mail);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $mail = $this->Mails->newEntity();
        if ($this->request->is('post')) {
            $mail = $this->Mails->patchEntity($mail, $this->request->getData());
            if ($this->Mails->save($mail)) {
                $this->Flash->success(__('The mail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The mail could not be saved. Please, try again.'));
        }
        $users = $this->Mails->Users->find('list', ['limit' => 200]);
        $locations = $this->Mails->Locations->find('list', ['limit' => 200]);
        $this->set(compact('mail', 'users', 'locations'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Mail id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $mail = $this->Mails->get($id, [
            'contain' => ['Locations']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mail = $this->Mails->patchEntity($mail, $this->request->getData());
            if ($this->Mails->save($mail)) {
                $this->Flash->success(__('The mail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The mail could not be saved. Please, try again.'));
        }
        $users = $this->Mails->Users->find('list', ['limit' => 200]);
        $locations = $this->Mails->Locations->find('list', ['limit' => 200]);
        $this->set(compact('mail', 'users', 'locations'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Mail id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mail = $this->Mails->get($id);
        if ($this->Mails->delete($mail)) {
            $this->Flash->success(__('The mail has been deleted.'));
        } else {
            $this->Flash->error(__('The mail could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * View method
     *
     * @param string|null $mailId Mail id.
     * @param string|null $locationId Location id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function send($mailId = null, $locationId = null)
    {
        $mail = $this->Mails->get(
            $mailId,
            [
                'contain' => [
                    'Locations' => function (\Cake\ORM\Query $q) use ($locationId) {
                        return $q->where(['Locations.id' => $locationId]);
                    },
                ],
            ]
        );

        $this->set('mail', $mail);
        $this->set('location', $mail->locations[0]);
    }
}
