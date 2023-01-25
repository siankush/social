<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Mailer\Email;
use Cake\Mailer\Mailer;
use Cake\Mailer\TransportFactory;
// use Cake\Auth\DefaultPasswordHasher;
use Cake\Utility\Security;
use Cake\ORM\TableRegistry;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */

    // public function initialize(): void
    // {
    //     // parent::initialize();

    //     $this->loadModel('Post');
    //     $this->loadModel('Comment');
    //     $this->loadComponent('Flash');
    // }


    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions(['login']);
        $this->loadModel('Post');
        $this->loadModel('Comment');
        $this->loadComponent('Flash');
    }


    public function index()
    {

        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    public function home()
    {
        $this->paginate = [
            'contain' => ['Users'],
        ];
        $post = $this->paginate($this->Post);

        $this->set(compact('post'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Post'],
        ]);

        $this->set(compact('user'));
    }

    public function postview($id = null, $userid = null )
    {
        $post = $this->Post->get($id, [
            'contain' => ['Users','Comment'],
        ]);
        $post['userid'] = $userid;

        $comment = $this->Comment->newEmptyEntity();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $data['post_id'] = $id;
            $comment = $this->Comment->patchEntity($comment, $data);
            if ($this->Comment->save($comment)) {
                $this->Flash->success(__('The comment has been saved.'));
                return $this->redirect(['action' => 'postview', $id, $userid]);
            }
            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
        }

        $this->set(compact('post', 'comment'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    public function postadd($userid)
    {
        $post = $this->Post->newEmptyEntity();
        $post['userid'] = $userid;
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['users_id'] = $userid;
            $post = $this->Post->patchEntity($post, $data);
            if ($this->Post->save($post)) {
                $this->Flash->success(__('The post has been saved.'));

                return $this->redirect(['action' => 'view', $userid]);
            }
            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }
        $users = $this->Post->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('post', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    public function postedit($id = null, $userid = null)
    {
        $post = $this->Post->get($id, [
            'contain' => [],
        ]);
        $post['userid'] = $userid;

        // echo '<pre>';print_r($post);die;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $post = $this->Post->patchEntity($post, $this->request->getData());
            if ($this->Post->save($post)) {
                $this->Flash->success(__('The post has been saved.'));

                return $this->redirect(['controller' => 'users', 'action' => 'view', $userid]);
            }
            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }
        $users = $this->Post->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('post', 'users'));
    }

    public function commentedit($id = null, $userid, $postid)
    {
        $comment = $this->Comment->get($id, [
            'contain' => [],
        ]);

        $comment['postid'] = $postid;
        $comment['userid'] = $userid;
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $comment = $this->Comment->patchEntity($comment, $this->request->getData());
            if ($this->Comment->save($comment)) {
                $this->Flash->success(__('The comment has been saved.'));

                return $this->redirect(['action' => 'postview', $userid, $postid]);
            }
            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
        }
        $this->set(compact('comment'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function postdelete($id = null, $userid)
    {
        $this->request->allowMethod(['post', 'delete']);
        $post = $this->Post->get($id);
        if ($this->Post->delete($post)) {
            $this->Flash->success(__('The post has been deleted.'));
        } else {
            $this->Flash->error(__('The post could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller' => 'users', 'action' => 'view', $userid]);
    }

    public function commentdelete($id = null, $postid, $userid)
    {
        $this->request->allowMethod(['post', 'delete']);
        $comment = $this->Comment->get($id);
        if ($this->Comment->delete($comment)) {
            $this->Flash->success(__('The comment has been deleted.'));
        } else {
            $this->Flash->error(__('The comment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'postview', $postid, $userid]);
    }


    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in

        if ($result && $result->isValid()) {
            // redirect to /articles after login success


            
            $result = $this->Authentication->getIdentity();
            // echo '<pre>';print_r($result->user_type);die;
            // $value = $result->name;
            // print_r($value); die;

            if($result->user_type == 0){

            $this->Flash->success(__('The admin has been logged in successfully.'));

            return $this->redirect(['controller'=>'Users', 'action' => 'adminpage']);

            }else if($result->user_type == 1){

                $this->Flash->success(__('The user has been logged in successfully.'));
                $redirect = $this->request->getQuery('redirect', [
                    'controller' => 'Users',
                    'action' => 'index',
                ]);
            }


            return $this->redirect($redirect);
        }
        // display error if user submitted and authentication failed
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid username or password'));
        }
    }


    public function forgtpass(){

        if ($this->request->is('post')) {
            $email = $this->request->getData('email');
            $token = Security::hash(Security::randomBytes(25));
            
            $userTable = TableRegistry::get('Users');
                if ($email == NULL) {
                    $this->Flash->error(__('Please insert your email address')); 
                } 
                if	($user = $userTable->find('all')->where(['email'=>$email])->first()) { 
                    $user->token = $token;
                    if ($userTable->save($user)){
                        $mailer = new Mailer('default');
                        $mailer->setTransport('gmail');
                        $mailer->setFrom(['ankush14042000@gmail.com' => 'ankush'])
                        ->setTo($email)
                        ->setEmailFormat('html')
                        ->setSubject('Forgot Password Request')
                        ->deliver('Hello<br/>Please click link below to reset your password<br/><br/><a href="http://localhost:8765/users/resetpassword/'.$token.'">Reset Password</a>');
                    }
                    $this->Flash->success('Reset password link has been sent to your email ('.$email.'), please check your email');
                }
                if	($total = $userTable->find('all')->where(['email'=>$email])->count()==0) {
                    $this->Flash->error(__('Email is not registered in system'));
                }
        }

    }

    public function resetpassword($token)
{
	if($this->request->is('post')){
		
		$newPass = $this->request->getData('password');

		$userTable = TableRegistry::get('Users');
		$user = $userTable->find('all')->where(['token'=>$token])->first();
		$user->password = $newPass;
        $user->token = 'null';

		if ($userTable->save($user)) {
			$this->Flash->success('Password successfully reset. Please login using your new password');
			return $this->redirect(['action'=>'login']);
		}
	}
    
}

public function adminpage(){

}

    public function logout()
    {
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result && $result->isValid()) {
            $this->Authentication->logout();
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
    }
}
