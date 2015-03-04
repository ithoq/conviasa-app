<?php
App::uses('AppController', 'Controller');
/**
 * Providers Controller
 *
 * @property Provider $Provider
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ProvidersController extends AppController {

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
		$this->Provider->recursive = -1;
		$this->set('providers', $this->Provider->find('all'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Provider->exists($id)) {
			throw new NotFoundException(__('Proveedor inválido'));
		}
		$this->Provider->recursive = 0;
		$options = array('conditions' => array('Provider.' . $this->Provider->primaryKey => $id));
		$this->set('provider', $this->Provider->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Provider->create();
			$this->request->data['Provider']['user_id'] = $this->Auth->user()['id'];
			if ($this->Provider->save($this->request->data)) {
				$this->Session->setFlash(__('El proveedor ha sido salvado.'), 'alert', array('class' => 'alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El proveedor no ha sido salvado. Por favor, intente de nuevo.'), 'alert', array('class' => 'alert-danger'));
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
		if (!$this->Provider->exists($id)) {
			throw new NotFoundException(__('Proveedor inválido'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Provider->save($this->request->data)) {
				$this->Session->setFlash(__('El proveedor ha sido editado satisfactoriamente.'), 'alert', array('class' => 'alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El proveedor no ha sido editado. Por favor, intente de nuevo.'), 'alert', array('class' => 'alert-danger'));
			}
		} else {
			$this->Provider->recursive = -1;
			$options = array('conditions' => array('Provider.' . $this->Provider->primaryKey => $id));
			$this->request->data = $this->Provider->find('first', $options);
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
		$this->Provider->id = $id;
		if (!$this->Provider->exists()) {
			throw new NotFoundException(__('Proveedor inválido'));
		}
		try {
			$this->request->allowMethod('post', 'delete');
			if ($this->Provider->delete()) {
				$this->Session->setFlash(__('El proveedor ha sido eliminado.'), 'alert', array('class' => 'alert-success'));
			} else {
				$this->Session->setFlash(__('El proveedor no ha podido ser elimiando. Por favor, intente de nuevo.'), 'alert', array('class' => 'alert-danger'));
			}
			return $this->redirect(array('action' => 'index'));
		} catch (Exception $e){
			$this->Session->setFlash(__('El proveedor no ha podido ser elimiando. Revise que no posea relaciones'), 'alert', array('class' => 'alert-danger'));
		}
	}
}
