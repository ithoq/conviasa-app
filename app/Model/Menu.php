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
					'url' => array('controller' => 'Crews', 'action' => 'captains'),
					'icon' => 'fa fa-plane'
				),
				array(
					'title' => 'Primeros Oficiales',
					'url' => array('controller' => 'Crews', 'action' => 'oficers'),
					'icon' => 'fa fa-paper-plane'
				),
				array(
					'title' => 'Instructores',
					'url' => array('controller' => 'Crews', 'action' => 'instructors'),
					'icon' => 'fa fa-graduation-cap'
				),
				array(
					'title' => 'Propuesta',
					'url' => array('controller' => 'Crews', 'action' => 'proposal'),
					'icon' => 'fa fa-edit'
				),
				array(
					'title' => 'Definitivo',
					'url' => array('controller' => 'Trains', 'action' => 'index'),
					'icon' => 'fa fa-check-square-o'
				),
			);
}