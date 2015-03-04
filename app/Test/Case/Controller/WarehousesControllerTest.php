<?php
App::uses('WarehousesController', 'Controller');

/**
 * WarehousesController Test Case
 *
 */
class WarehousesControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	// public $fixtures = array(
	// 	'app.warehouse',
	// 	'app.batch',
	// 	'app.product',
	// 	'app.singleitem',
	// 	'app.purchaseorder',
	// 	'app.user',
	// 	'app.marketrate',
	// 	'app.product__marke_rate',
	// 	'app.deliverynote',
	// 	'app.batchitem',
	// 	'app.customer',
	// 	'app.vendor',
	// 	'app.users',
	// 	'app.product_market_rate'
	// );

/**
 * testIndex method
 *
 * @return void
 */
	public function testIndex() {
		$result = $this->testAction('/warehouses/index');
		debug($result);
	}

/**
 * testView method
 *
 * @return void
 */
	public function testView() {
		$result = $this->testAction('warehouses/view/1');
		debug($result);
	}

/**
 * testAdd method
 *
 * @return void
 */
	public function testAdd() {
		$this->markTestIncomplete('testAdd not implemented.');
	}

/**
 * testEdit method
 *
 * @return void
 */
	public function testEdit() {
		$this->markTestIncomplete('testEdit not implemented.');
	}

/**
 * testDelete method
 *
 * @return void
 */
	public function testDelete() {
		$this->markTestIncomplete('testDelete not implemented.');
	}

/**
 * testAdminIndex method
 *
 * @return void
 */
	public function testAdminIndex() {
		$this->markTestIncomplete('testAdminIndex not implemented.');
	}

/**
 * testAdminView method
 *
 * @return void
 */
	public function testAdminView() {
		$this->markTestIncomplete('testAdminView not implemented.');
	}

/**
 * testAdminAdd method
 *
 * @return void
 */
	public function testAdminAdd() {
		$this->markTestIncomplete('testAdminAdd not implemented.');
	}

/**
 * testAdminEdit method
 *
 * @return void
 */
	public function testAdminEdit() {
		$this->markTestIncomplete('testAdminEdit not implemented.');
	}

/**
 * testAdminDelete method
 *
 * @return void
 */
	public function testAdminDelete() {
		$this->markTestIncomplete('testAdminDelete not implemented.');
	}

}
