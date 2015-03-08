<?php
App::uses('AppModel', 'Model');

/**
 * Menu Model 
 *
 */
class Menu extends AppModel {

		public $adminMenu = array(
					array(
						'title' => 'Inicio',
						'url' => array('controller' => 'Crews', 'action' => 'index'),
						'icon' => 'fa fa-home'
					),
					array(
						'title' => 'Usuarios',
						'url' => array('controller' => 'Users', 'action' => 'index'),
						'icon' => 'fa fa-users'
					),
					array(
						'title' => 'Capitanes',
						'url' => array('controller' => 'Crew', 'action' => 'add'),
						'icon' => 'fa fa-plane'
					),
					array(
						'title' => 'Primeros Oficiales',
						'url' => array('controller' => 'Home', 'action' => 'oficers'),
						'icon' => 'fa fa-paper-plane'
					),
					array(
						'title' => 'Instructores',
						'url' => array('controller' => 'Home', 'action' => 'instructors'),
						'icon' => 'fa fa-graduation-cap'
					),
				);
}