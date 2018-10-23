<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;

class UsersController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Auth->allow(['add', 'logout','forgotPassword','resetPassword','focusout','email']);
    }

     public function index()
     {
          $this->paginate = [
            'contain' => ['Articles'],
            'limit' => 5
        ]; 
        $users = $this->paginate($this->Users);
        $this->set(compact('users'));
    }

    public function view($id)
    {
         $this->paginate = [
            'contain' => ['Users','Articles']
        ]; 
        $user = $this->Users->get($id);
        $articles = TableRegistry::get('Articles');
        $articleid = $user['id'];
        // debug($articleid);die();
        $article = $this->Users->Articles->find('all')->where(['Articles.user_id' => $articleid])->hydrate(false)->toList();
        // debug($user['id']);
        // debug($article);die();

        $this->set('article', $article);
        $user = $this->Users->get($id);
        $this->set(compact('user'));
    }

    public function add()
    {
        if ($this->request->is(['post', 'ajax'])) {
            $user = $this->Users->newEntity();
            //Check if image has been uploaded
            if(!empty($this->request->data['img']['tmp_name']))
            {
                $file = $this->request->data['img']; //put the data into a var for easy use

                $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                $arr_ext = array('jpg', 'jpeg', 'gif'); //set allowed extensions

                //only process if the extension is valid
                if(in_array($ext, $arr_ext))
                {
                    $filename = time().$file['name'];
                    //do the actual uploading of the file. First arg is the tmp name, second arg is
                    //where we are putting it
                    move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img' .DS.$filename);

                    //prepare the filename for database entry
                    $this->request->data['img'] = $filename;
                }
            }
            else{
                 $this->request->data['img'] = "default.png";
            }
           
            $user = $this->Users->patchEntity($user, $this->request->getData());

            if ($this->Users->save($user)) {
                $output = "success";
            }
            else {
                $output = "failure";
            }
        }
        $this->set('output', $output);
        $this->set('_serialize', 'output');
    }

    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
                // debug($user);die();
            if(!empty($this->request->data['img']['name']))
            {
                $file = $this->request->data['img']; //put the data into a var for easy use

                $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                $arr_ext = array('jpg', 'jpeg', 'gif'); //set allowed extensions

                //only process if the extension is valid
                if(in_array($ext, $arr_ext))
                {
                    $filename = time().$file['name'];
                    //do the actual uploading of the file. First arg is the tmp name, second arg is
                    //where we are putting it
                    move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img' .DS. $filename);

                    //prepare the filename for database entry
                    $this->request->data['img'] = $filename;
                }

                if($user->img == "default.png"){

                }
                else{
                    $dir = WWW_ROOT . 'img' .DS.$user['img'];
                    unlink($dir);
                }

            }
            else{
                unset($this->request->data['img']);
            }

            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                 $this->Auth->setUser($user);
                //debug($user);die();
                if($user['role'] == 'author'){
                    return $this->redirect(['controller' => 'Articles', 'action' => 'index']);
                }
                else{
                    return $this->redirect(['controller' => 'Users', 'action' => 'index']);
                }
                
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    public function login()
    {
        $this->viewBuilder()->setLayout('ajax');
        if ($this->request->is('post')) {
        // debug($this->request->data()); die();
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);

                // debug($user); die();
                // echo $user['role']=='author';die();
                if ($user['role'] == 'admin') {
                    // debug($user);die();
                    return $this->redirect(['controller' => 'Users', 'action' => 'index']);
                }else{
                    return $this->redirect(['controller' => 'Articles', 'action' => 'index']);
                }
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }

    public function isAuthorized($user)
    {
       

        // The owner of an article can edit and delete it
        // Prior to 3.4.0 $this->request->param('action') was used.
        if (in_array($this->request->getParam('action'), ['edit','changePassword'])) {
            // Prior to 3.4.0 $this->request->params('pass.0')
            $userid = (int)$this->request->getParam('pass.0');
            if ($this->Users->isOwnedBy($userid, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }


    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    public function changePassword($id=null)
    {
        $this->viewBuilder()->setLayout('layout');
         $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $p = $this->request->getdata();
            $password = $p['old_password'];
            $new = $p['newpassword'];
            $confirm = $p['confirm'];

            if ((new DefaultPasswordHasher)->check($password, $user['password'])) {
                //  debug($p);
                // debug($user['password']);die();
                if($new == $confirm){
                    // $this->request->data['password'] = $p['New_password'];
                    $user->password = $new;
                    $d = $this->Users->patchEntity($user, $this->request->getData());
                    // debug($user);die();
                    // debug($p);debug($this->request->data['password']);
                    if ($this->Users->save($user)) {
                    // debug($user);die();
                    $this->Flash->success(__('The user has been saved.'));
                    if ($user['role'] == 'admin') {
                        return $this->redirect(['controller' => 'Users', 'action' => 'index']);
                    }else {
                        return $this->redirect(['controller' => 'Articles', 'action' => 'index']);
                    }
                }
                }else{
                    $this->Flash->error(__('Password didnt matched'));
                    // return $this->redirect(['controller' => 'Users', 'action' => 'index']); 
                }
                
            }else {
                $this->Flash->error(__('Old Password didnt matched'));
            } 
        }
            
        // $this->set('changePassword', $user);
        // debug($user);die();
    }


    public function forgotPassword()
    {

         $this->viewBuilder()->setLayout('ajax');
         if ($this->request->is('post')) {
            $users = TableRegistry::get('Users');
            $email = $this->Users->table();
            // debug($this->Users);
            // debug($this->request->data);die();
            $data = $this->request->data();
            // debug($data['email']);die();
            // debug($users);die();
            // debug($query);die();
            if (!empty($data)) {
                $conditions = array('Users.email' => $data['email']);
                    // debug('true');
            }else {
                // debug('false');
                // die();
            }
            $query = $users->find()->where($conditions)->hydrate(false)->first();
            if(!empty($query)) {
            // debug($query);die();
               $email = new Email('default');
               $email->template('reset')
                     ->viewVars(['id' => $query['id']])

                     ->emailFormat('html')
                     ->to($data['email'])
                     ->send();
                     // ->subject('About')
                     // ->send('My message');

                     
            } else {
                $this->Flash->error(__('No user with that email found.'));
                return $this->redirect(['controller' => 'Users','action' => 'forgotPassword']);
            }
         }
    }

    public function resetPassword($id = null)
    {
        $this->viewBuilder()->setLayout('layout');
         $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $p = $this->request->getdata();
            $new = $p['New_password'];
            $confirm = $p['confirm_password'];
                if($new == $confirm){
                    // $this->request->data['password'] = $p['New_password'];
                    $user->password = $new;
                    $d = $this->Users->patchEntity($user, $this->request->getData());
                    // debug($user);die();
                    // debug($p);debug($this->request->data['password']);
                    if ($this->Users->save($user)) {
                    // debug($user);die();
                    $this->Flash->success(__('The Password has been changed.'));
                        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
                        
                    }
                }else{
                    $this->Flash->error(__('Password didnt matched'));
                    // return $this->redirect(['controller' => 'Users', 'action' => 'index']); 
                }
                
        }
    }


    public function focusout($username)
    {
        $query = $this->Users->find()->where(['username' => $username])->first();
        // debug($query);die();
        if (!empty($query)) {
                $output = "failure";
            }
            else {
                $output = "sucess";
            }
        $this->set('output', $output);
        $this->set('_serialize', 'output');
    }

    public function email($email)
    {
        $query = $this->Users->find()->where(['email' => $email])->first();
        // debug($email);die();
        if(!empty($query)){
            $output = "failure";
        }
        else{
            $output = "success";
        }
        $this->set('output', $output);
        $this->set('_serialize', 'output');
    }
}