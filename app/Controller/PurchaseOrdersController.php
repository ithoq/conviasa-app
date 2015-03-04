<?php
App::uses('AppController', 'Controller');
/**
 * Purchaseorders Controller
 *
 * @property Purchaseorder $Purchaseorder
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PurchaseOrdersController extends AppController {

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
		$this->Purchaseorder->recursive = 0;
		$this->set('purchaseorders', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Purchaseorder->exists($id)) {
			throw new NotFoundException(__('Invalid purchaseorder'));
		}
		$options = array('conditions' => array('Purchaseorder.' . $this->Purchaseorder->primaryKey => $id));
		$this->set('purchaseorder', $this->Purchaseorder->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Purchaseorder->create();
			if ($this->Purchaseorder->save($this->request->data)) {
				$this->Session->setFlash(__('The purchaseorder has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The purchaseorder could not be saved. Please, try again.'));
			}
		}
		$this->loadModel('Warehouse');
		$providers = $this->PurchaseOrder->Provider->find('list', array(
			'fields' => array(
				'id', 'name')));
		$warehouses = $this->Warehouse->find('list', array(
			'fields' => array(
				'id', 'name')));
		$this->set(compact('warehouses', 'providers'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Purchaseorder->exists($id)) {
			throw new NotFoundException(__('Invalid purchaseorder'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Purchaseorder->save($this->request->data)) {
				$this->Session->setFlash(__('The purchaseorder has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The purchaseorder could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Purchaseorder.' . $this->Purchaseorder->primaryKey => $id));
			$this->request->data = $this->Purchaseorder->find('first', $options);
		}
		$users = $this->Purchaseorder->User->find('list');
		$vendors = $this->Purchaseorder->Vendor->find('list');
		$this->set(compact('users', 'vendors'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Purchaseorder->id = $id;
		if (!$this->Purchaseorder->exists()) {
			throw new NotFoundException(__('Invalid purchaseorder'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Purchaseorder->delete()) {
			$this->Session->setFlash(__('The purchaseorder has been deleted.'));
		} else {
			$this->Session->setFlash(__('The purchaseorder could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Purchaseorder->recursive = 0;
		$this->set('purchaseorders', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Purchaseorder->exists($id)) {
			throw new NotFoundException(__('Invalid purchaseorder'));
		}
		$options = array('conditions' => array('Purchaseorder.' . $this->Purchaseorder->primaryKey => $id));
		$this->set('purchaseorder', $this->Purchaseorder->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Purchaseorder->create();
			if ($this->Purchaseorder->save($this->request->data)) {
				$this->Session->setFlash(__('The purchaseorder has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The purchaseorder could not be saved. Please, try again.'));
			}
		}
		$users = $this->Purchaseorder->User->find('list');
		$vendors = $this->Purchaseorder->Vendor->find('list');
		$this->set(compact('users', 'vendors'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Purchaseorder->exists($id)) {
			throw new NotFoundException(__('Invalid purchaseorder'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Purchaseorder->save($this->request->data)) {
				$this->Session->setFlash(__('The purchaseorder has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The purchaseorder could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Purchaseorder.' . $this->Purchaseorder->primaryKey => $id));
			$this->request->data = $this->Purchaseorder->find('first', $options);
		}
		$users = $this->Purchaseorder->User->find('list');
		$vendors = $this->Purchaseorder->Vendor->find('list');
		$this->set(compact('users', 'vendors'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Purchaseorder->id = $id;
		if (!$this->Purchaseorder->exists()) {
			throw new NotFoundException(__('Invalid purchaseorder'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Purchaseorder->delete()) {
			$this->Session->setFlash(__('The purchaseorder has been deleted.'));
		} else {
			$this->Session->setFlash(__('The purchaseorder could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
