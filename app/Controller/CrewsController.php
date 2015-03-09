<?php
App::uses('AppController', 'Controller');
/**
 * Home Controller
 *
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CrewsController extends AppController {

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
		if ($this->request->is('post')) {
			$semestralDate = str_replace('/', '-', $this->request->data['Crew']['semestral_date']);
			$annualDate = str_replace('/', '-', $this->request->data['Crew']['annual_date']);
			$this->request->data['Crew']['semestral_date'] = date('Y-m-d', strtotime($semestralDate));
			$this->request->data['Crew']['annual_date'] = date('Y-m-d', strtotime($annualDate));
			$this->Crew->create();
			if ($this->Crew->save($this->request->data)) {
				$this->Session->setFlash(__('El tripulante ha sido registrado.'), 'alert', array('class' => 'alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Ha ocurrido un problema registrando al tripulante, por favor intente de nuevo.'), 'alert', array('class' => 'alert-danger'));
			}
		}
		$this->set('crew', $this->Crew->enum('role'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Crew->id = $id;
		if (!$this->Crew->exists()) {
			throw new NotFoundException(__('Tripulante inválido'));
		}
		try {
			$this->request->allowMethod('post', 'delete');
			if ($this->Crew->delete()) {
				$this->Session->setFlash(__('El Tripulante ha sido eliminado satisfactoriamente.'), 'alert', array('class' => 'alert-success'));
			} else {
				$this->Session->setFlash(__('El tripulante no pudo ser eliminado'), 'alert', array('class' => 'alert-danger'));
			}
			return $this->redirect(array('action' => 'index'));
		} catch(Exception $e) {
			$this->Session->setFlash(__('El Tripulante no pudo ser eliminado, revise no tener relaciones'), 'alert', array('class' => 'alert-danger'));
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
		if (!$this->Crew->exists($id)) {
			throw new NotFoundException(__('Tripulante inválido'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$semestralDate = str_replace('/', '-', $this->request->data['Crew']['semestral_date']);
			$annualDate = str_replace('/', '-', $this->request->data['Crew']['annual_date']);
			$this->request->data['Crew']['semestral_date'] = date('Y-m-d', strtotime($semestralDate));
			$this->request->data['Crew']['annual_date'] = date('Y-m-d', strtotime($annualDate));
			if ($this->Crew->save($this->request->data)) {
				$this->Session->setFlash(__('El Tripulante ha sido editado.'), 'alert', array('class' => 'alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->set('crew', $this->Crew->enum('role'));
				$this->Session->setFlash(__('El Tripulante no ha podido ser editado. Por favor, intente de nuevo.'), 'alert', array('class' => 'alert-danger'));
			}
		}
		$this->Crew->recursive = -1;
		$options = array('conditions' => array('Crew.' . $this->Crew->primaryKey => $id));
		$this->request->data = $this->Crew->find('first', $options);
		$this->request->data['Crew']['semestral_date'] = date('d/m/Y', strtotime($this->request->data['Crew']['semestral_date']));
		$this->request->data['Crew']['annual_date'] = date('d/m/Y', strtotime($this->request->data['Crew']['annual_date']));
		$this->request->data['Crew']['semestral_date'] = str_replace('-', '/', $this->request->data['Crew']['semestral_date']);
		$this->request->data['Crew']['annual_date'] = str_replace('-', '/', $this->request->data['Crew']['annual_date']);
		$this->set('crew', $this->Crew->enum('role'));
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('crews', $this->Crew->find('all'));
	}

/**
 * [indexCaptain description]
 * @return [type] [description]
 */
	public function captains() {
		$this->set('crews', $this->Crew->find('all', array('conditions' => array('role' => 'cap'))));
	}

/**
 * [indexInstructors description]
 * @return [type] [description]
 */
	public function instructors() {
		$this->set('crews', $this->Crew->find('all', array('conditions' => array('role' => 'tri'))));
	}

/**
 * [indexOficers description]
 * @return [type] [description]
 */
	public function oficers() {
		$this->set('crews', $this->Crew->find('all', array('conditions' => array('role' => 'cop'))));
	}

	public function proposal() {
		$captains = $this->Crew->find('all', array(
			'conditions' => array(
				'role' => 'cap'),
			'order' => array(
				'semestral_date DESC',
				'annual_date',
				'visa DESC')));
		$oficers = $this->Crew->find('all', array(
			'conditions' => array(
				'role' => 'cop'),
			'order' => array(
				'semestral_date DESC',
				'annual_date',
				'visa DESC')));
		if (count($captains) > count($oficers)) {
			$this->set('index', count($captains));
		} else {
			$this->set('index', count($oficers));
		}
		$this->set('captains', $captains);
		$this->set('oficers', $oficers);
	}
}
