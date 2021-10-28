<?php
declare(strict_types=1);

namespace App\Controller;

//use Cake\ORM\Locator\LocatorAwareTrait;
use Authentication\PasswordHasher\DefaultPasswordHasher;

/**
 * Settings Controller
 *
 * @method \App\Model\Entity\Setting[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SettingsController extends AppController
{
    private $userTable;
    private $identity;

    public function initialize(): void
    {
        parent::initialize();

        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if (!$result->isValid()) {
             $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

        $this->userTable = $this->fetchTable('Users');

        $this->identity = $this->Authentication->getIdentity();
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();

        $user = $this->userTable->get($this->identity->id);

        $this->set(compact('user'));
    }

    public function updatePassword() {
        $this->Authorization->skipAuthorization();

        $this->request->allowMethod(['patch', 'post', 'put', 'get']);

        $user = $this->userTable->get($this->identity->id);

        if($this->request->is(['patch', 'post', 'put'])){
            $data = $this->getRequest()->getData();

            if (empty($data['old']) || empty($data['new'])) {
                return $this->redirect(['action' => 'index']);
            }

            $hasher = new DefaultPasswordHasher();
            $hashedOldPassword = $hasher->hash($data['old']);

            if ($hasher->check($data['new'], $user->password) === FALSE){
                // update password to new hashed password
                $user->password = $hasher->hash($data['new']);

                // save in database
                $this->userTable->save($user, $this->request->getData());
                $this->Flash->success('Password changed successfully');

                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('Sorry, your new password cannot be the same as your current one'));


        }

        return $this->redirect(['action' => 'index']);

    }

}
