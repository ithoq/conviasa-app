<?php
App::uses('AppController', 'Controller');
/**
 * Marketrates Controller
 *
 * @property Marketrate $Marketrate
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class MarketratesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Marketrate->recursive = 0;
		$this->set('marketrates', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Marketrate->exists($id)) {
			throw new NotFoundException(__('Invalid marketrate'));
		}
		$options = array('conditions' => array('Marketrate.' . $this->Marketrate->primaryKey => $id));
		$this->set('marketrate', $this->Marketrate->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Marketrate->create();
			if ($this->Marketrate->save($this->request->data)) {
				$this->Session->setFlash(__('The marketrate has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The marketrate could not be saved. Please, try again.'));
			}
		}
		$users = $this->Marketrate->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Marketrate->exists($id)) {
			throw new NotFoundException(__('Invalid marketrate'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Marketrate->save($this->request->data)) {
				$this->Session->setFlash(__('The marketrate has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The marketrate could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Marketrate.' . $this->Marketrate->primaryKey => $id));
			$this->request->data = $this->Marketrate->find('first', $options);
		}
		$users = $this->Marketrate->User->find('list');
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Marketrate->id = $id;
		if (!$this->Marketrate->exists()) {
			throw new NotFoundException(__('Invalid marketrate'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Marketrate->delete()) {
			$this->Session->setFlash(__('The marketrate has been deleted.'));
		} else {
			$this->Session->setFlash(__('The marketrate could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Marketrate->recursive = 0;
		$this->set('marketrates', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Marketrate->exists($id)) {
			throw new NotFoundException(__('Invalid marketrate'));
		}
		$options = array('conditions' => array('Marketrate.' . $this->Marketrate->primaryKey => $id));
		$this->set('marketrate', $this->Marketrate->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Marketrate->create();
			if ($this->Marketrate->save($this->request->data)) {
				$this->Session->setFlash(__('The marketrate has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The marketrate could not be saved. Please, try again.'));
			}
		}
		$users = $this->Marketrate->User->find('list');
		$this->set(compact('users'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Marketrate->exists($id)) {
			throw new NotFoundException(__('Invalid marketrate'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Marketrate->save($this->request->data)) {
				$this->Session->setFlash(__('The marketrate has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The marketrate could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Marketrate.' . $this->Marketrate->primaryKey => $id));
			$this->request->data = $this->Marketrate->find('first', $options);
		}
		$users = $this->Marketrate->User->find('list');
		$this->set(compact('users'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Marketrate->id = $id;
		if (!$this->Marketrate->exists()) {
			throw new NotFoundException(__('Invalid marketrate'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Marketrate->delete()) {
			$this->Session->setFlash(__('The marketrate has been deleted.'));
		} else {
			$this->Session->setFlash(__('The marketrate could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
