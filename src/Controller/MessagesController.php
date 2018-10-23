<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;
/**
 * Messages Controller
 *
 * @property \App\Model\Table\MessagesTable $Messages
 *
 * @method \App\Model\Entity\Message[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MessagesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
            'limit' => 2
        ];
        $messages = $this->paginate($this->Messages);

        $this->set(compact('messages'));
    }

    /**
     * View method
     *
     * @param string|null $id Message id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $message = $this->Messages->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('message', $message);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
         $this->viewBuilder()->setLayout('layout');
        $message = $this->Messages->newEntity();
        $user = $this->Auth->user('id');
        
        // debug($id);die();
        // debug($user);die();
        if ($this->request->is('post')) {
            // debug($this->request->data);die();
            $mail = $this->Messages->Users->find()->where(['id' => $this->request->data['user_id']])->hydrate(false)->first();
            // debug($mail);die();
            $text = $this->request->getData('message');
            $title = $this->request->getData('title');
            $this->request->data['senderid'] = $user;
            $message = $this->Messages->patchEntity($message, $this->request->getData());
            // debug($message);die();

            if ($this->Messages->save($message)) {
                $this->Flash->success(__('The message has been saved.'));
                    $email = new Email('default');
                    $email->template('message')
                         ->viewVars(['message' => $text])
                          ->subject($title)
                         ->emailFormat('html')
                         ->to($mail['email'])
                         ->send();       

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The message could not be saved. Please, try again.'));
        }
        $this->loadModel('Users');
        $users = $this->Users->find('list', ['keyField' => 'id', 'valueField' => 'username']);
        // debug($users->hydrate(false)->toArray());die();


        $this->set(compact('message', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Message id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
         $this->viewBuilder()->setLayout('layout');
        $message = $this->Messages->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $message = $this->Messages->patchEntity($message, $this->request->getData());
            if ($this->Messages->save($message)) {
                $this->Flash->success(__('The message has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The message could not be saved. Please, try again.'));
        }
        $users = $this->Messages->Users->find('list', ['limit' => 200]);
        $this->set(compact('message', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Message id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $message = $this->Messages->get($id);
        if ($this->Messages->delete($message)) {
            $this->Flash->success(__('The message has been deleted.'));
        } else {
            $this->Flash->error(__('The message could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
