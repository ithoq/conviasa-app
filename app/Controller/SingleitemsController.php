<?php
App::uses('AppController', 'Controller');
/**
 * Singleitems Controller
 *
 * @property Singleitem $Singleitem
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class SingleitemsController extends AppController {

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
		$this->Singleitem->recursive = 0;
		$this->set('singleitems', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Singleitem->exists($id)) {
			throw new NotFoundException(__('Invalid singleitem'));
		}
		$options = array('conditions' => array('Singleitem.' . $this->Singleitem->primaryKey => $id));
		$this->set('singleitem', $this->Singleitem->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Singleitem->create();
			if ($this->Singleitem->save($this->request->data)) {
				$this->Session->setFlash(__('The singleitem has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The singleitem could not be saved. Please, try again.'));
			}
		}
		$warehouses = $this->Singleitem->Warehouse->find('list');
		$products = $this->Singleitem->Product->find('list');
		$purchaseOrders = $this->Singleitem->PurchaseOrder->find('list');
		$customers = $this->Singleitem->Customer->find('list');
		$deliveryNotes = $this->Singleitem->DeliveryNote->find('list');
		$this->set(compact('warehouses', 'products', 'purchaseOrders', 'customers', 'deliveryNotes'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Singleitem->exists($id)) {
			throw new NotFoundException(__('Invalid singleitem'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Singleitem->save($this->request->data)) {
				$this->Session->setFlash(__('The singleitem has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The singleitem could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Singleitem.' . $this->Singleitem->primaryKey => $id));
			$this->request->data = $this->Singleitem->find('first', $options);
		}
		$warehouses = $this->Singleitem->Warehouse->find('list');
		$products = $this->Singleitem->Product->find('list');
		$purchaseOrders = $this->Singleitem->PurchaseOrder->find('list');
		$customers = $this->Singleitem->Customer->find('list');
		$deliveryNotes = $this->Singleitem->DeliveryNote->find('list');
		$this->set(compact('warehouses', 'products', 'purchaseOrders', 'customers', 'deliveryNotes'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Singleitem->id = $id;
		if (!$this->Singleitem->exists()) {
			throw new NotFoundException(__('Invalid singleitem'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Singleitem->delete()) {
			$this->Session->setFlash(__('The singleitem has been deleted.'));
		} else {
			$this->Session->setFlash(__('The singleitem could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Singleitem->recursive = 0;
		$this->set('singleitems', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Singleitem->exists($id)) {
			throw new NotFoundException(__('Invalid singleitem'));
		}
		$options = array('conditions' => array('Singleitem.' . $this->Singleitem->primaryKey => $id));
		$this->set('singleitem', $this->Singleitem->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Singleitem->create();
			if ($this->Singleitem->save($this->request->data)) {
				$this->Session->setFlash(__('The singleitem has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The singleitem could not be saved. Please, try again.'));
			}
		}
		$warehouses = $this->Singleitem->Warehouse->find('list');
		$products = $this->Singleitem->Product->find('list');
		$purchaseOrders = $this->Singleitem->PurchaseOrder->find('list');
		$customers = $this->Singleitem->Customer->find('list');
		$deliveryNotes = $this->Singleitem->DeliveryNote->find('list');
		$this->set(compact('warehouses', 'products', 'purchaseOrders', 'customers', 'deliveryNotes'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Singleitem->exists($id)) {
			throw new NotFoundException(__('Invalid singleitem'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Singleitem->save($this->request->data)) {
				$this->Session->setFlash(__('The singleitem has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The singleitem could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Singleitem.' . $this->Singleitem->primaryKey => $id));
			$this->request->data = $this->Singleitem->find('first', $options);
		}
		$warehouses = $this->Singleitem->Warehouse->find('list');
		$products = $this->Singleitem->Product->find('list');
		$purchaseOrders = $this->Singleitem->PurchaseOrder->find('list');
		$customers = $this->Singleitem->Customer->find('list');
		$deliveryNotes = $this->Singleitem->DeliveryNote->find('list');
		$this->set(compact('warehouses', 'products', 'purchaseOrders', 'customers', 'deliveryNotes'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Singleitem->id = $id;
		if (!$this->Singleitem->exists()) {
			throw new NotFoundException(__('Invalid singleitem'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Singleitem->delete()) {
			$this->Session->setFlash(__('The singleitem has been deleted.'));
		} else {
			$this->Session->setFlash(__('The singleitem could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
