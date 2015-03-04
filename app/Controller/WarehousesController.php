<?php
App::uses('AppController', 'Controller');
/**
 * Warehouses Controller
 *
 * @property Warehouse $Warehouse
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class WarehousesController extends AppController {

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
		$this->Warehouse->recursive = -1;
		$this->set('warehouses', $this->Warehouse->find('all'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Warehouse->exists($id)) {
			throw new NotFoundException(__('Almacén inválido'));
		}
		$this->Warehouse->recursive = -1;
		$options = array('conditions' => array('Warehouse.' . $this->Warehouse->primaryKey => $id));
		$this->set('warehouse', $this->Warehouse->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Warehouse->create();
			if ($this->Warehouse->save($this->request->data)) {
				$this->Session->setFlash(__('El almacén ha sido salvado.'), 'alert', array('class' => 'alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El almacén no pudo ser salvado. Por favor, intente de nuevo.'), 'alert', array('class' => 'alert-danger'));
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
		if (!$this->Warehouse->exists($id)) {
			throw new NotFoundException(__('Almacén inválido'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Warehouse->save($this->request->data)) {
				$this->Session->setFlash(__('El almacén ha sido editado satisfactoriamente.'), 'alert', array('class' => 'alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El almacén no ha podido ser editado. Por favor, intente de nuevo.'), 'alert', array('class' => 'alert-danger'));
			}
		} else {
			$this->Warehouse->recursive = -1;
			$options = array('conditions' => array('Warehouse.' . $this->Warehouse->primaryKey => $id));
			$this->request->data = $this->Warehouse->find('first', $options);
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
		$this->Warehouse->id = $id;
		if (!$this->Warehouse->exists()) {
			throw new NotFoundException(__('Almacén inválido'));
		}
		try {
			$this->request->onlyAllow('post', 'delete');
			if ($this->Warehouse->delete()) {
				$this->Session->setFlash(__('El almacén ha sido eliminado.'), 'alert', array('class' => 'alert-success'));
			} else {
				$this->Session->setFlash(__('El almacén no se ha eliminado. Por favor, intente de nuevo.'), 'alert', array('class' => 'alert-danger'));
			}
			return $this->redirect(array('action' => 'index'));
		} catch(Exception $e) {
			$this->Session->setFlash(__('El almacen no pudo ser eliminado, revise no tener relaciones'), 'alert', array('class' => 'alert-danger'));
			return $this->redirect(array('action' => 'index'));
		}
	}
}
