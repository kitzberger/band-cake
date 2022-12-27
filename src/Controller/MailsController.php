<?php

namespace App\Controller;

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
            'contain' => ['Users', 'Locations']
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
        $mail = $this->Mails->newEmptyEntity();
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
     * prepare method
     *
     * @param string|null $mailId Mail id.
     * @param string|null $locationId Location id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function prepare($mailId = null, $locationId = null)
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

        if ($location = $mail->locations[0]) {
            $preparedMailText = $this->prepareMailText($mail->text, $location);
        } else {
            $this->Flash->error(__('The mail could not be prepared. Please, try again.'));
            $this->redirect(['action' => 'view', $mailId]);
        }

        $this->set('mail', $mail);
        $this->set('location', $location);
        $this->set('preparedMailText', $preparedMailText);
    }

    /**
     * Put an email to a location into the mail queue
     *
     * @param string|null $mailId Mail id.
     * @param string|null $locationId Location id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function enqueue($mailId = null, $locationId = null)
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

        if ($location = $mail->locations[0]) {
            if (empty($location->email)) {
                $this->Flash->error(__('Location doesn\'t have an email!'));
            } else {
                $mailText = $this->prepareMailText($mail->text, $location);

                if (strpos($mailText, '[xxx]') > -1) {
                    $this->Flash->error(__('Mailtext has unresolved placeholders!'));
                } else {
                    $locationMail = $location->_joinData;
                    $locationMail->email = $location->email;
                    $locationMail->subject = $mail->subject;
                    $locationMail->text = $this->prepareMailText($mail->text, $location);
                    $this->loadModel('LocationsMails');
                    if ($this->LocationsMails->save($locationMail)) {
                        $this->Flash->success(__('The mail has been queued for sending.'));
                    } else {
                        $this->Flash->error(__('The mail could not be sent. Please, try again.'));
                    }
                }
            }
        } else {
            $this->Flash->error(__('The mail could not be sent. Please, try again.'));
        }

        return $this->redirect(['action' => 'view', $mailId]);
    }

    /**
     * Remove an email to a location from the mail queue
     *
     * @param string|null $mailId Mail id.
     * @param string|null $locationId Location id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function unqueue($mailId = null, $locationId = null)
    {
        $this->loadModel('LocationsMails');

        $mail = $this->LocationsMails->find(
            'all',
            [
                'conditions' => [
                    'mail_id' => $mailId,
                    'location_id' => $locationId,
                    'sent IS' => null,
                ],
            ]
        )->first();

        if ($this->LocationsMails->delete($mail)) {
            $this->Flash->success(__('The mail has been deleted.'));
        } else {
            $this->Flash->error(__('The mail could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'view', $mailId]);
    }

    private function prepareMailText($text, $location)
    {
        $text = str_replace(
            [
                '{person}',
                '{location}',
                '{city}',
            ],
            [
                trim($location->person) ? trim($location->person) : '[xxx]',
                trim($location->title) ? trim($location->title) : '[xxx]',
                trim($location->city) ? trim($location->city) : '[xxx]',
            ],
            $text
        );

        return $text;
    }
}
