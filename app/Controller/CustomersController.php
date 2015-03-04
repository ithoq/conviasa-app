<?php
App::uses('AppController', 'Controller');
/**
 * Customers Controller
 *
 * @property Customer $Customer
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CustomersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Customer->recursive = -1;
		$this->set('customers', $this->Customer->find('all'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Customer->exists($id)) {
			throw new NotFoundException(__('Cliente inválido'));
		}
		$this->Customer->recursive = 0;
		$options = array('conditions' => array('Customer.' . $this->Customer->primaryKey => $id));
		$this->set('customer', $this->Customer->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->request->data['Customer']['user_id'] = $this->Auth->user()['id'];
			$this->Customer->create();
			if ($this->Customer->save($this->request->data)) {
				$this->Session->setFlash(__('El cliente ha sido salvado.'), 'alert', array('class' => 'alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El cliente no puede ser salvado. Por favor, Intente de nuevo.'), 'alert', array('class' => 'alert-danger'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Customer->exists($id)) {
			throw new NotFoundException(__('Cliente inválido'));
		}
		if ($this->request->is(array('post', 'put'))) {
			unset($this->request->data['Customer']['user_id']);
			if ($this->Customer->save($this->request->data)) {
				$this->Session->setFlash(__('El cliente ha sido salvado.'), 'alert', array('class' => 'alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El cliente no puede ser salvado. Por favor, Intente de nuevo.'), 'alert', array('class' => 'alert-danger'));
			}
		} else {
			$this->Customer->recursive = -1;
			$options = array('conditions' => array('Customer.' . $this->Customer->primaryKey => $id));
			$this->request->data = $this->Customer->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Customer->id = $id;
		if (!$this->Customer->exists()) {
			throw new NotFoundException(__('Cliente inválido'));
		}
		try {
			$this->request->allowMethod('post', 'delete');
			if ($this->Customer->delete()) {
				$this->Session->setFlash(__('El cliente ha sido eliminado.'), 'alert', array('class' => 'alert-success'));
			} else {
				$this->Session->setFlash(__('El cliente no puede ser elimiando. Por favor, intente de nuevo.'), 'alert', array('class' => 'alert-danger'));
			}
			return $this->redirect(array('action' => 'index'));
		} catch(Exception $e) {
			$this->Session->setFlash(__('El cliente no pudo ser eliminado, revise no tener relaciones'), 'alert', array('class' => 'alert-danger'));
			return $this->redirect(array('action' => 'index'));
		}
	}
}
