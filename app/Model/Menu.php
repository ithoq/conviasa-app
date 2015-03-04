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
						'url' => array('controller' => 'Home', 'action' => 'index'),
						'icon' => 'fa fa-home'
					),
					array(
						'title' => 'Usuarios',
						'url' => array('controller' => 'Users', 'action' => 'index'),
						'icon' => 'fa fa-users'
					),
					array(
						'title' => 'Inventario',
						'url' => array('controller' => 'Stocks', 'action' => 'index'),
						'icon' => 'fa fa-folder-open'
					),
					array(
						'title' => 'Productos',
						'url' => array('controller' => 'Products', 'action' => 'index'),
						'icon' => 'fa fa-shopping-cart'
					),
					array(
						'title' => 'Almacenes',
						'url' => array('controller' => 'Warehouses', 'action' => 'index'),
						'icon' => 'fa fa-building'
					),
					array(
						'title' => 'Proveedores',
						'url' => array('controller' => 'Providers', 'action' => 'index'),
						'icon' => 'fa fa-heartbeat'
					),
					array(
						'title' => 'Clientes',
						'url' => array('controller' => 'Customers', 'action' => 'index'),
						'icon' => 'fa fa-user-plus'
					),
					array(
						'title' => 'Notas de Entrega',
						'url' => array('controller' => 'DeliveryNotes', 'action' => 'index'),
						'icon' => 'fa fa-edit'
					),
					array(
						'title' => 'Ordenes de Compra',
						'url' => array('controller' => 'PurchaseOrders', 'action' => 'index'),
						'icon' => 'fa fa-file-archive-o'
					),
					array(
						'title' => 'Cotizaciones',
						'url' => array('controller' => 'MarketRates', 'action' => 'index'),
						'icon' => 'fa fa-file-excel-o'
					)
				);

	public $userMenu = array(
					array(
						'title' => 'Inicio',
						'url' => array('controller' => 'Home', 'action' => 'index'),
						'icon' => 'fa fa-home'
					),
					array(
						'title' => 'Usuarios',
						'url' => array('controller' => 'Users', 'action' => 'index'),
						'icon' => 'fa fa-users'
					),
					array(
						'title' => 'Inventario',
						'url' => array('controller' => 'Stocks', 'action' => 'index'),
						'icon' => 'fa fa-folder-open'
					),
					array(
						'title' => 'Productos',
						'url' => array('controller' => 'Products', 'action' => 'index'),
						'icon' => 'fa fa-shopping-cart'
					),
					array(
						'title' => 'Almacenes',
						'url' => array('controller' => 'Warehouses', 'action' => 'index'),
						'icon' => 'fa fa-building'
					),
					array(
						'title' => 'Proveedores',
						'url' => array('controller' => 'Providers', 'action' => 'index'),
						'icon' => 'fa fa-heartbeat'
					),
					array(
						'title' => 'Clientes',
						'url' => array('controller' => 'Customers', 'action' => 'index'),
						'icon' => 'fa fa-user-plus'
					),
					array(
						'title' => 'Notas de Entrega',
						'url' => array('controller' => 'DeliveryNotes', 'action' => 'index'),
						'icon' => 'fa fa-edit'
					),
					array(
						'title' => 'Ordenes de Compra',
						'url' => array('controller' => 'PurchaseOrders', 'action' => 'index'),
						'icon' => 'fa fa-file-archive-o'
					),
					array(
						'title' => 'Cotizaciones',
						'url' => array('controller' => 'MarketRates', 'action' => 'index'),
						'icon' => 'fa fa-file-excel-o'
					)
				);
}