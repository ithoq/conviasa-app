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
	public function indexCaptain() {
		$this->set('crews', $this->Crew->find('all', array('conditions' => array('role' => 'cap'))));
	}

/**
 * [indexInstructors description]
 * @return [type] [description]
 */
	public function indexInstructors() {
		$this->set('crews', $this->Crew->find('all', array('conditions' => array('role' => 'tri'))));
	}

/**
 * [indexOficers description]
 * @return [type] [description]
 */
	public function indexOficers() {
		$this->set('crews', $this->Crew->find('all', array('conditions' => array('role' => 'cop'))));
	}
}
