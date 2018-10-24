<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
/**
 * Articles Controller
 *
 * @property \App\Model\Table\ArticlesTable $Articles
 *
 * @method \App\Model\Entity\Article[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ArticlesController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        // $this->Auth->allow(['index']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $id = $this->Auth->user('id'); 
        $role = $this->Auth->user('role');
        if (!empty($id) && $role == "author") {
            $this->paginate = [
            'limit' => 3
        ];
            // debug($id);die();
            $query = $this->Articles->find('all')->where(['user_id' => $id])->contain(['Categories']);
            $this->set('articles', $this->paginate($query));
            // debug($query);die();

        }
        else {
            $this->paginate = [
            'contain' => ['Users', 'Categories'],
            'limit' => 3
        ];
             $articles = $this->paginate($this->Articles);
             $this->set(compact('articles'));

        } 
    }

    /**
     * View method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $article = $this->Articles->get($id, [
            'contain' => []
        ]);
        $this->set('article', $article);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {   
        $this->viewBuilder()->setLayout('layout');
        $article = $this->Articles->newEntity();
        if ($this->request->is('post')) {
            // Prior to 3.4.0 $this->request->data() was used.
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            // Added this line
            $article->user_id = $this->Auth->user('id');
            // You could also do the following
            //$newData = ['user_id' => $this->Auth->user('id')];
            //$article = $this->Articles->patchEntity($article, $newData);
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('Your article has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your article.'));
        }
        $this->set('article', $article);

        $category = $this->Articles->Categories->find('list');
        // debug($category);die();
        $this->set('categories', $category);
    }
    /**
     * Edit method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $article = $this->Articles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The article could not be saved. Please, try again.'));
        }
        $this->set(compact('article'));

         $category = $this->Articles->Categories->find('list');
        // debug($category);die();
        $this->set('categories', $category);

    }

    /**
     * Delete method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $article = $this->Articles->get($id);
        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('The article has been deleted.'));
        } else {
            $this->Flash->error(__('The article could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($user)
    {
        // All registered users can add articles
        // Prior to 3.4.0 $this->request->param('action') was used.
        if (in_array($this->request->getParam('action'), ['add', 'index', 'search', 'searchform','latest','view', 'aa','bb'])) {
            return true;
        }
        // The owner of an article can edit and delete it
        // Prior to 3.4.0 $this->request->param('action') was used.
        if (in_array($this->request->getParam('action'), ['edit', 'delete', 'view'])) {
            // Prior to 3.4.0 $this->request->params('pass.0')
            $articleId = (int)$this->request->getParam('pass.0');
            if ($this->Articles->isOwnedBy($articleId, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

    public function searchform()
    {

        $this->viewBuilder()->setLayout('default');
         

        $category = $this->Articles->Categories->find('list');
        // debug($category);die();
        $this->set('categories', $category);
    }

    public function search()
    {

        if ($this->request->is('post')) {
            $conditions = [];
            // $t = $this->request->data['title'];
            // debug($this->request->data); die();
            $role = $this->Auth->User('role');
            $id = $this->Auth->User('id');
            $i = $this->request->data['category_id'];
            // $strtdate = date('Y-m-d', strtotime($this->request->data['start_date']));
            // $strtdate = $this->request->data['start_date'];
            // $enddate = $this->request->data['end_date'];

            if (!empty($t)) {
                $conditions = array_merge($conditions, array('Articles.title LIKE' => '%'.$t.'%'));
            }else{

            }

            if (!empty($i)) {
                $conditions = array_merge($conditions, array('Articles.category_id' => $i));
            }else{

            }

            if(!empty($strtdate) && !empty($enddate)) {
                $conditions = array_merge($conditions, array(['Articles.created >=' => $strtdate.' 00:00:00', 'Articles.created <=' => $enddate.' 23:59:59']));
            }else{

            }

            // debug($conditions);die();
            if ($role == 'author'){
                $articles = TableRegistry::get('Articles');
                $conditions = array_merge($conditions, array('Articles.user_id' => $id));
                // $query = $articles->find()->where(['Articles.title LIKE' => '%'.$t.'%', 'Articles.user_id' => $id, 'Articles.category_id' => $i, 'Articles.created >=' => $strtdate, 'Articles.created <=' => $enddate])->contain(['Users', 'Categories']);
                $query = $articles->find()->where($conditions)->contain(['Users', 'Categories']);
            }
            else {
                $articles = TableRegistry::get('Articles');
                // $query = $articles->find()->where(['Articles.title LIKE' => '%'.$t.'%','Articles.category_id' => $i, 'Articles.created >=' => $strtdate, 'Articles.created <=' => $enddate])->contain(['Users', 'Categories']);
                $query = $articles->find()->where($conditions)->contain(['Users', 'Categories']);
            }
            
            // $result = $query;
            // debug($query);die();
            // debug($query->hydrate(false)->toList());die();       
            // debug($this->request->data['title']);die();
            $this->set('articles', $query);
        }


    } 

    public function list($user)
    {
    }

    public function latest()
    {
          $this->paginate = ['limit' => 3];
          $id = $this->Auth->user('id'); 
          $query = $this->Articles->find()->where(['user_id !=' => $id])->contain(['Categories'])->order(['Articles.created' => 'DESC']);
          $this->set('articles', $this->paginate($query));

    }
    public function aa($category_id)
    {
        $query = $this->Articles->find()->where(['category_id' => $category_id])->toArray();
        $userIds = $this->Articles->find('list', ['keyField' => 'id', 'valueField' => 'user_id'])->where(['category_id' => $category_id])->group(['user_id'])->toArray();
        // $userIds = $this->Articles->find()->where(['category_id' => $category_id])->select(['user_id'])->group(['user_id'])->toArray();
        $user = $this->Articles->Users->find('list', ['keyField' => 'id', 'valueField' => 'username'])->where(['id IN' => $userIds])->toArray();
        // debug($user);die();
        $main['user'] = $user;
        $main['query'] = $query;

        $this->set('output', $main);
        $this->set('_serialize', 'output');
    }
    public function bb($username, $category_id)
    {
        $query = $this->Articles->find()->where(['user_id' => $username ,'category_id' => $category_id])->toArray();

        // debug($query);die();
        $this->set('output', $query);
        $this->set('_serialize', 'output');
    }
}   
