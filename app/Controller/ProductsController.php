<?php
App::uses('AppController', 'Controller');
/**
 * Products Controller
 *
 * @property Product $Product
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ProductsController extends AppController {

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
		$this->Product->recursive = -1;
		$this->set('products', $this->Product->find('all'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Producto inválido'));
		}
		$this->Product->recursive = -1;
		$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
		$this->set('product', $this->Product->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Product->create();
			if ($this->Product->save($this->request->data)) {
				$this->Session->setFlash(__('El producto ha sido salvado.'), 'alert', array('class' => 'alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El producto no ha ha sido salvado. Por favor, intente de nuevo.'), 'alert', array('class' => 'alert-danger'));
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
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Producto inválido'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Product->save($this->request->data)) {
				$this->Session->setFlash(__('El producto ha sido editado.'), 'alert', array('class' => 'alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El producto no ha ha sido editado. Por favor, intente de nuevo.'), 'alert', array('class' => 'alert-danger'));
			}
		} else {
			$this->Product->recursive = -1;
			$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
			$this->request->data = $this->Product->find('first', $options);
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
		$this->Product->id = $id;
		if (!$this->Product->exists()) {
			throw new NotFoundException(__('Producto inválido'));
		}
		try {
			$this->request->allowMethod('post', 'delete');
			if ($this->Product->delete()) {
				$this->Session->setFlash(__('El producto ha sido eliminado.'), 'alert', array('class' => 'alert-success'));
			} else {
				$this->Session->setFlash(__('El producto no pudo ser eliminado. Por favor, intente de nuevo.'), 'alert', array('class' => 'alert-danger'));
			}
			return $this->redirect(array('action' => 'index'));
		} catch(Exception $e) {
			$this->Session->setFlash(__('El producto no pudo ser eliminado, revise no tener relaciones'), 'alert', array('class' => 'alert-danger'));
			return $this->redirect(array('action' => 'index'));
		}
	}

/**
 * Get products name by name
 * 
 * @throws Exception en caso de un error
 * @return void
 */
	public function productsByName() {
		if ($this->request->is('ajax')) {
			$this->Product->recursive = -1;
			$products = $this->Product->find('all', array(
				'fields' => array(
					'id',
					'code',
					'name'),
				'limit' => '5',
				'conditions' => array(
					'Product.name LIKE' => '%' . $this->request->query['term'] . '%')));
			$this->set(compact('products'));
			$this->layout = 'ajax';
		} else {
			throw new Exception(__('Bad request'));
		}
	}

/**
 * get products code by code
 * 
 * @throws Exception en caso de un error
 * @return void
 */
	public function productsByCode() {
		if ($this->request->is('ajax')) {
			$this->Product->recursive = -1;
			$products = $this->Product->find('all', array(
				'fields' => array(
					'id',
					'code',
					'name'),
				'limit' => '5',
				'conditions' => array(
					'Product.code LIKE' => '%' . $this->request->query['term'] . '%')));
			$this->set(compact('products'));
			$this->layout = 'ajax';
		} else {
			throw new Exception(__('Bad request'));
		}
	}
}
