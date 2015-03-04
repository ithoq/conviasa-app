<?php
App::uses('AppController', 'Controller');
/**
 * Batches Controller
 *
 * @property Batch $Batch
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class BatchesController extends AppController {

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
		$this->Batch->recursive = 0;
		$this->set('batches', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Batch->exists($id)) {
			throw new NotFoundException(__('Invalid batch'));
		}
		$options = array('conditions' => array('Batch.' . $this->Batch->primaryKey => $id));
		$this->set('batch', $this->Batch->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Batch->create();
			if ($this->Batch->save($this->request->data)) {
				$this->Session->setFlash(__('The batch has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The batch could not be saved. Please, try again.'));
			}
		}
		$warehouses = $this->Batch->Warehouse->find('list');
		$products = $this->Batch->Product->find('list');
		$purchaseOrders = $this->Batch->PurchaseOrder->find('list');
		$this->set(compact('warehouses', 'products', 'purchaseOrders'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Batch->exists($id)) {
			throw new NotFoundException(__('Invalid batch'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Batch->save($this->request->data)) {
				$this->Session->setFlash(__('The batch has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The batch could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Batch.' . $this->Batch->primaryKey => $id));
			$this->request->data = $this->Batch->find('first', $options);
		}
		$warehouses = $this->Batch->Warehouse->find('list');
		$products = $this->Batch->Product->find('list');
		$purchaseOrders = $this->Batch->PurchaseOrder->find('list');
		$this->set(compact('warehouses', 'products', 'purchaseOrders'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Batch->id = $id;
		if (!$this->Batch->exists()) {
			throw new NotFoundException(__('Invalid batch'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Batch->delete()) {
			$this->Session->setFlash(__('The batch has been deleted.'));
		} else {
			$this->Session->setFlash(__('The batch could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Batch->recursive = 0;
		$this->set('batches', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Batch->exists($id)) {
			throw new NotFoundException(__('Invalid batch'));
		}
		$options = array('conditions' => array('Batch.' . $this->Batch->primaryKey => $id));
		$this->set('batch', $this->Batch->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Batch->create();
			if ($this->Batch->save($this->request->data)) {
				$this->Session->setFlash(__('The batch has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The batch could not be saved. Please, try again.'));
			}
		}
		$warehouses = $this->Batch->Warehouse->find('list');
		$products = $this->Batch->Product->find('list');
		$purchaseOrders = $this->Batch->PurchaseOrder->find('list');
		$this->set(compact('warehouses', 'products', 'purchaseOrders'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Batch->exists($id)) {
			throw new NotFoundException(__('Invalid batch'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Batch->save($this->request->data)) {
				$this->Session->setFlash(__('The batch has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The batch could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Batch.' . $this->Batch->primaryKey => $id));
			$this->request->data = $this->Batch->find('first', $options);
		}
		$warehouses = $this->Batch->Warehouse->find('list');
		$products = $this->Batch->Product->find('list');
		$purchaseOrders = $this->Batch->PurchaseOrder->find('list');
		$this->set(compact('warehouses', 'products', 'purchaseOrders'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Batch->id = $id;
		if (!$this->Batch->exists()) {
			throw new NotFoundException(__('Invalid batch'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Batch->delete()) {
			$this->Session->setFlash(__('The batch has been deleted.'));
		} else {
			$this->Session->setFlash(__('The batch could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
