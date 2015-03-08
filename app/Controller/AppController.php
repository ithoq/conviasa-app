<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	public $helpers = array('Session', 'BsHelpers.Bs', 'BsHelpers.BsForm');

/**
 * Selección del Tema Visual para la Aplicacion
 */
	//public $theme = 'Cakestrap';
/**
 * Configuración de Componentes de Autorización, Sesión y el Plugin de AutoLogin
 */
	public $components = array(
		'Session' => array(),
		'Auth' => array(
			//Redirección después de hacer Login exitosamente
			'loginRedirect' => array('controller' => 'crews', 'action' => 'index'),
			//Redirección después de hacer LogOut del Usuario
			'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
			//Mensaje de Error al no poseer privilegios
			'authError' => 'Necesitas privilegios de administrador para entrar',
			//A donde recibe autorización el usuario una vez que ha sido autenticado
			'authorize' => array('Controller'),
			//Mensaje Flash en caso de no estar autorizado el Usuario
			'flash' => array(
				'element' => 'flash/error',
				'key' => 'auth',
				'params' => array(
					'plugin' => 'BoostCake',
					'class' => 'alert-error'))),
		//Configuración de Utility.AutoLogin --- Habilita el botón RememberMe y almacena las cookies en el Browser
		'Utility.AutoLogin' => array(
			//El Nombre de la Cookie a Garduar en el Browser
			'cookieName' => 'rememberMe',
			//Tiempo de Expiración de La Cookie
			'expires' => '+1 weeks'));

/**
 * El Identificador del usuario en el sistema, se usa para
 * el fácil manejo del identificado durante toda la ejecución de
 * la aplicación
 * 
 * @var int
 */
	public $userId;

/**
 * Método que se ejecutará antes de cualquier acción en 
 * el controlador, Pasa variables a la vista como 
 * logged_in (si el usuario está logeado)
 * current_user (usuario actual)
 * activatedMenuItem (el item de la barra de menú activado)
 * 
 * @return void
 */
	public function beforeFilter() {
		if (isset($this->Auth->user()['id'])) {
			$this->loadModel('User');
			if (!$this->User->exists($this->Auth->user()['id'])) {
				return $this->redirect($this->Auth->logout());
			}
			$this->id = $this->Auth->user()['id'];
		}
		//Indica si el usuario ha sido logeado
		$this->set('loggedIn', $this->Auth->loggedIn());
		//El Objeto Usuario con todos sus campos menos el password
		$this->set('currentUser', $this->Auth->user());

		//Si el usuario está logeado iniciar el menú respecto a su rol
		$this->loadModel('Menu');
		$this->set('mainMenu', $this->Menu->adminMenu);

		//Evitar que el usuario pueda introducir un id por formulario
		foreach ($this->request->data as $key => $value) {
			if (isset($this->request->data[$key]['Id'])) {
				unset($this->request->data[$key]['Id']);
			}
		}
	}

/**
 * Método que índica si el usuario está o no autorizado
 * 
 * @param User $user El usuario autenticado
 * @return boolean true: si está autorizado, false: si no está autorizado.
 */
	public function isAuthorized($user) {
		return true;
	}
}
