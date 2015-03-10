<?php
App::uses('AppController', 'Controller');
App::uses('ConvertidorDeCaracteres', 'Model/General');

/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UsersController extends AppController {

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
		$this->User->recursive = -1;
		$this->set('users', $this->User->find('all', array(
			'conditions' => array(
				'not' => array(
					'username' => 'admin')))));
	}

/**
 * Método que realiza la validación del usuario 
 * y el password antes de iniciar la sesión en la aplicación
 * 
 * @return void
 */
	public function login() {
		//Si el Usuario se encuentra ya Logeado en el sistema

		if ($this->User->validates()) {
			if ($this->Auth->user()) {
				return $this->redirect($this->Auth->redirectUrl());
			}
		}
		//Si Uso el form para logearse (POST)
		if ($this->request->is('post')) {
			//Convertir a minusculas el nombre de usuario ya que no se hacen distinciones entre minusculas y mayusculas
			ConvertidorDeCaracteres::convertirAMinusculas($this->data['User']['username']);
			//Si el Usuario Colocó un nombre de usuario y contraseña correcta
			if ($this->Auth->login()) {
				//Asiganación del ID autenticado al avariable $userId para un manejo más cómodo
				$userId = $this->Auth->user()['id'];
				//Redirecciona al home page de la aplicación
				return $this->redirect($this->Auth->redirectUrl());
			} else {
				//Asigna a la variable session que va luego a la vista el mensaje de error
				$this->Session->setFlash(__('Nombre de Usuario o contraseña incorrectos'), 'alert', array('class' => 'alert-danger'));
			}
		}
		//Se Define el Layout de Login que no es el mismo del deafult
		$this->layout = 'login';
	}

/**
 * Método que cierra la sesión del usuario activo
 * 
 * @return void
 */
	public function logout() {
		//Redirecciona a la página de Login Inicial
		return $this->redirect($this->Auth->logout());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Usuario inválido'));
		}
		$this->User->recursive = -1;
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('El usuario ha sido registrado.'), 'alert', array('class' => 'alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Ha ocurrido un problema registrando al usuario, por favor intente de nuevo.'), 'alert', array('class' => 'alert-danger'));
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
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Usuario inválido'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->data['User']['password'] === '' && $this->data['User']['password_confirmation'] === '') {
				$this->User->modificarValidacion();
			}
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('El usuario ha sido editado.'), 'alert', array('class' => 'alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->set('user', $this->User->enum('role'));
				$this->Session->setFlash(__('El usuario no ha podido ser editado. Por favor, intente de nuevo.'), 'alert', array('class' => 'alert-danger'));
			}
		} else {
			$this->User->recursive = -1;
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
		$this->request->data['User']['password'] = ''; //Se limpia el campo del password por seguridad
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Usuario inválido'));
		}
		try {
			if ($this->User->delete()) {
				$this->Session->setFlash(__('El usuario ha sido eliminado satisfactoriamente.'), 'alert', array('class' => 'alert-success'));
			} else {
				$this->Session->setFlash(__('El usuario no pudo ser eliminado'), 'alert', array('class' => 'alert-danger'));
			}
			return $this->redirect(array('action' => 'index'));
		} catch(Exception $e) {
			$this->Session->setFlash(__('El usuario no pudo ser eliminado, revise no tener relaciones'), 'alert', array('class' => 'alert-danger'));
			return $this->redirect(array('action' => 'index'));
		}
	}
}
