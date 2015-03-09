<?php
App::uses('AppController', 'Controller');
/**
 * Home Controller
 *
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class TrainsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

	public $helpers = array('Time');

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->loadModel('Crew');
		if ($this->request->is('post')) {
			$date = str_replace('/', '-', $this->request->data['Train']['date']);
			$this->request->data['Train']['date'] = date('Y-m-d', strtotime($date));
			$captain = $this->Crew->find('first', array('conditions' => array('id' => $this->request->data['Train']['captain'])));
			$oficer = $this->Crew->find('first', array('conditions' => array('id' => $this->request->data['Train']['oficer'])));
			$this->request->data['Train']['captain'] = $captain['Crew']['name'];
			$this->request->data['Train']['oficer'] = $oficer['Crew']['name'];
			$this->Train->create();
			if ($this->Train->save($this->request->data)) {
				$this->Session->setFlash(__('El entrenamiento ha sido registrado.'), 'alert', array('class' => 'alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Ha ocurrido un problema registrando al entrenamiento, por favor intente de nuevo.'), 'alert', array('class' => 'alert-danger'));
			}
		}
		$captains = $this->Crew->find('list', array(
			'fields' => array(
				'name'),
			'conditions' => array(
				'role' => 'cap'),
			'order' => array(
				'name asc')));
		$oficers = $this->Crew->find('list', array(
			'fields' => array(
				'name'),
			'conditions' => array(
				'role' => 'cop'),
			'order' => array(
				'name asc')));
		$this->set('captains', $captains);
		$this->set('oficers', $oficers);
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Train->id = $id;
		if (!$this->Train->exists()) {
			throw new NotFoundException(__('Entrenamiento inválido'));
		}
		try {
			if ($this->Train->delete()) {
				$this->Session->setFlash(__('El Entrenamiento ha sido eliminado satisfactoriamente.'), 'alert', array('class' => 'alert-success'));
			} else {
				$this->Session->setFlash(__('El Entrenamiento no pudo ser eliminado'), 'alert', array('class' => 'alert-danger'));
			}
			return $this->redirect(array('action' => 'index'));
		} catch(Exception $e) {
			$this->Session->setFlash(__('El Entrenamiento no pudo ser eliminado, revise no tener relaciones'), 'alert', array('class' => 'alert-danger'));
			return $this->redirect(array('action' => 'index'));
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
		$this->loadModel('Crew');
		if (!$this->Train->exists($id)) {
			throw new NotFoundException(__('Tripulante inválido'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$date = str_replace('/', '-', $this->request->data['Train']['date']);
			$this->request->data['Train']['date'] = date('Y-m-d', strtotime($date));
			$captain = $this->Crew->find('first', array('conditions' => array('id' => $this->request->data['Train']['captain'])));
			$oficer = $this->Crew->find('first', array('conditions' => array('id' => $this->request->data['Train']['oficer'])));
			$this->request->data['Train']['captain'] = $captain['Crew']['name'];
			$this->request->data['Train']['oficer'] = $oficer['Crew']['name'];
			if ($this->Train->save($this->request->data)) {
				$this->Session->setFlash(__('El entrenamiento ha sido editado.'), 'alert', array('class' => 'alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El entrenamiento no ha podido ser editado. Por favor, intente de nuevo.'), 'alert', array('class' => 'alert-danger'));
			}
		}
		$options = array('conditions' => array('Train.' . $this->Train->primaryKey => $id));
		$this->request->data = $this->Train->find('first', $options);
		$this->request->data['Train']['date'] = date('d/m/Y', strtotime($this->request->data['Train']['date']));
		$this->request->data['Train']['date'] = str_replace('-', '/', $this->request->data['Train']['date']);
		$captains = $this->Crew->find('list', array(
			'fields' => array(
				'name'),
			'conditions' => array(
				'role' => 'cap'),
			'order' => array(
				'name asc')));
		$oficers = $this->Crew->find('list', array(
			'fields' => array(
				'name'),
			'conditions' => array(
				'role' => 'cop'),
			'order' => array(
				'name asc')));
		$this->set('captains', $captains);
		$this->set('oficers', $oficers);
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('trains', $this->Train->find('all'));
	}
}
