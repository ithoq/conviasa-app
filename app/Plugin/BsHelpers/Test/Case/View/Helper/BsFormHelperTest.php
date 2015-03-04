<?php

App::uses('View', 'View');
App::uses('BsFormHelper', 'BsHelpers.View/Helper');
App::uses('BsHelper', 'BsHelpers.View/Helper');

class BsFormHelperTest extends CakeTestCase {

    public function setUp()
    {
    	parent::setUp();
	    $View = new View();
	    $this->BsForm = new BsFormHelper($View);
	    $this->Bs = new BsHelper($View);
    }

    public function testSetLeft()
    {
    	$result = $this->BsForm->setLeft(3);

		$this->assertEquals(3, $this->BsForm->getLeft());
    }

    public function testSetRight()
    {
    	$result = $this->BsForm->setRight(3);

		$this->assertEquals(3, $this->BsForm->getRight());
    }

/**
 * Create function
 * @return void
 */
    public function testCreate()
    {

	    /////////////////////
    	// WITHOUT OPTIONS //
	    /////////////////////

    	$result = $this->BsForm->create();

		$expected = array(
			array('form' => array('action', 'class' => 'form-horizontal', 'role' => 'form', 'id', 'method' => 'post', 'accept-charset' => 'utf-8')),
				array('div' => array('style' => 'display:none;')),
					array('input' => array('name', 'type' => 'hidden', 'value' => 'POST')),
				'/div'
		);
		$this->assertTags($result, $expected);


		//////////////////
		// WITH OPTIONS //
		//////////////////

		$result = $this->BsForm->create('Model', array('action' => 'action', 'role' => 'formulaire', 'class' => 'form-inline', 'enctype' => 'multipart/form-data'));

		$expected = array(
			array('form' => array('action' => '/models/action', 'class' => 'form-inline', 'role' => 'formulaire', 'id' => 'ModelActionForm', 'method' => 'post', 'accept-charset' => 'utf-8', 'enctype' => 'multipart/form-data')),
				array('div' => array('style' => 'display:none;')),
					array('input' => array('name', 'type' => 'hidden', 'value' => 'POST')),
				'/div'
		);
		$this->assertTags($result, $expected);
    }

/**
 * Input function
 * @return void
 */
    public function testInput()
    {
    	$this->dateRegex = array(
			'daysRegex' => 'preg:/(?:<option value="0?([\d]+)">\\1<\/option>[\r\n]*)*/',
			'monthsRegex' => 'preg:/(?:<option value="[\d]+">[\w]+<\/option>[\r\n]*)*/',
			'yearsRegex' => 'preg:/(?:<option value="([\d]+)">\\1<\/option>[\r\n]*)*/'
		);
		extract($this->dateRegex);

	    ///////////
    	// BASIC //
	    ///////////

    	$result = $this->BsForm->input('Name');

		$expected = array(
			array('div' => array('class' => 'form-group')),
				array('label' => array('for', 'class' => 'control-label col-md-'.$this->BsForm->getLeft())), 'Name', '/label',
				array('div' => array('class' => 'col-md-'.$this->BsForm->getRight())),
					array('input' => array('name', 'class' => 'form-control', 'type', 'id')),
				'/div',
			'/div'
		);
		$this->assertTags($result, $expected);

		////////////////
		// WITH LABEL //
		////////////////

    	$result = $this->BsForm->input('Name', array('label' => 'Other Name'));

		$expected = array(
			array('div' => array('class' => 'form-group')),
				array('label' => array('for', 'class' => 'control-label col-md-'.$this->BsForm->getLeft())), 'Other Name', '/label',
				array('div' => array('class' => 'col-md-'.$this->BsForm->getRight())),
					array('input' => array('name', 'class' => 'form-control', 'type', 'id')),
				'/div',
			'/div'
		);
		$this->assertTags($result, $expected);

		//////////////////////
		// WITH LABEL ARRAY //
		//////////////////////

    	$result = $this->BsForm->input('Name', array('label' => array('text' => 'Other Name', 'class' => 'labelClass')));

		$expected = array(
			array('div' => array('class' => 'form-group')),
				array('label' => array('for', 'class' => 'labelClass control-label col-md-'.$this->BsForm->getLeft())), 'Other Name', '/label',
				array('div' => array('class' => 'col-md-'.$this->BsForm->getRight())),
					array('input' => array('name', 'class' => 'form-control', 'type', 'id')),
				'/div',
			'/div'
		);
		$this->assertTags($result, $expected);

		////////////////////////////////////////////////
		// WITH LABEL ARRAY AND NO CLASS ON THE LABEL //
		////////////////////////////////////////////////

    	$result = $this->BsForm->input('Name', array('label' => array('text' => 'Other Name')));

		$expected = array(
			array('div' => array('class' => 'form-group')),
				array('label' => array('for', 'class' => 'control-label col-md-'.$this->BsForm->getLeft())), 'Other Name', '/label',
				array('div' => array('class' => 'col-md-'.$this->BsForm->getRight())),
					array('input' => array('name', 'class' => 'form-control', 'type', 'id')),
				'/div',
			'/div'
		);
		$this->assertTags($result, $expected);

		///////////////////
		// WITHOUT LABEL //
		///////////////////

    	$result = $this->BsForm->input('Name', array('label' => false));

		$expected = array(
			array('div' => array('class' => 'form-group')),
				array('div' => array('class' => 'col-md-'.$this->BsForm->getRight().' col-md-offset-'.$this->BsForm->getLeft())),
					array('input' => array('name', 'class' => 'form-control', 'type', 'id')),
				'/div',
			'/div'
		);
		$this->assertTags($result, $expected);

		/////////////////
		// FORM-INLINE //
		/////////////////

		$this->BsForm->create('Model', array('class' => 'form-inline'));
    	$result = $this->BsForm->input('Name');
    	$this->BsForm->end();
    	$this->BsForm->setFormType('horizontal');

		$expected = array(
			array('div' => array('class' => 'form-group')),
				array('label' => array('for', 'class' => 'control-label sr-only')), 'Name', '/label',
				array('input' => array('name', 'class' => 'form-control', 'type', 'id')),
			'/div'
		);
		$this->assertTags($result, $expected);


		////////////////////////////
		// BEFORE, BETWEEN, AFTER //
		////////////////////////////

		$result = $this->BsForm->input('Name', array('before' => '<div class="classTest">', 'between' => '<span>between</span>', 'after' => '</div>'));

		$expected = array(
			array('div' => array('class' => 'classTest')),
				array('label' => array('for', 'class' => 'control-label col-md-'.$this->BsForm->getLeft())), 'Name', '/label',
				'<span',
					'between',
				'/span',
				array('input' => array('name', 'class' => 'form-control', 'type', 'id')),
			'/div'
		);
		$this->assertTags($result, $expected);


	    ///////////////
    	// TEST HELP //
	    ///////////////

    	$result = $this->BsForm->input('Name', array('help' => 'this is a warning', 'state' => 'warning', 'id' => false, 'class' => 'classTest'));

		$expected = array(
			array('div' => array('class' => 'form-group has-warning')),
				array('label' => array('for', 'class' => 'control-label col-md-'.$this->BsForm->getLeft())), 'Name', '/label',
				array('div' => array('class' => 'col-md-'.$this->BsForm->getRight())),
					array('input' => array('name', 'class' => 'classTest form-control', 'type')),
					array('span' => array('class' => 'help-block')),
						'this is a warning',
					'/span',
				'/div',
			'/div'
		);
		$this->assertTags($result, $expected);

		//////////////////
    	// STATE SUCESS //
	    //////////////////

    	$result = $this->BsForm->input('Name', array('state' => 'success'));

		$expected = array(
			array('div' => array('class' => 'form-group has-success')),
				array('label' => array('for', 'class' => 'control-label col-md-'.$this->BsForm->getLeft())), 'Name', '/label',
				array('div' => array('class' => 'col-md-'.$this->BsForm->getRight())),
					array('input' => array('name', 'class' => 'form-control', 'type', 'id')),
				'/div',
			'/div'
		);
		$this->assertTags($result, $expected);

		/////////////////
    	// STATE ERROR //
	    /////////////////

    	$result = $this->BsForm->input('Name', array('state' => 'error'));

		$expected = array(
			array('div' => array('class' => 'form-group has-error')),
				array('label' => array('for', 'class' => 'control-label col-md-'.$this->BsForm->getLeft())), 'Name', '/label',
				array('div' => array('class' => 'col-md-'.$this->BsForm->getRight())),
					array('input' => array('name', 'class' => 'form-control', 'type', 'id')),
				'/div',
			'/div'
		);
		$this->assertTags($result, $expected);

		/////////////////
    	// WRONG STATE //
	    /////////////////

    	$result = $this->BsForm->input('Name', array('state' => 'nostate'));

		$expected = array(
			array('div' => array('class' => 'form-group')),
				array('label' => array('for', 'class' => 'control-label col-md-'.$this->BsForm->getLeft())), 'Name', '/label',
				array('div' => array('class' => 'col-md-'.$this->BsForm->getRight())),
					array('input' => array('name', 'class' => 'form-control', 'type', 'id')),
				'/div',
			'/div'
		);
		$this->assertTags($result, $expected);


		////////////////
		// INPUT DATE //
		////////////////

		$result = $this->BsForm->input('Date', array('type' => 'date'));
 
		$now = strtotime('now');

		$expected = array(
			array('div' => array('class' => 'form-group')),
				array('label' => array('for', 'class' => 'control-label col-md-'.$this->BsForm->getLeft())), 'Date', '/label',
				array('div' => array('class' => 'col-md-'.$this->BsForm->getRight())),
					array('select' => array('name', 'class' => 'input-date form-control', 'id')),
						$monthsRegex,
						array('option' => array('value' => date('m', $now), 'selected' => 'selected')),
							date('F', $now),
						'/option',
					'*/select',
					'-',
					array('select' => array('name', 'class' => 'input-date form-control', 'id')),
						$daysRegex,
						array('option' => array('value' => date('d', $now), 'selected' => 'selected')),
							date('j', $now),
						'/option',
					'*/select',
					'-',
					array('select' => array('name', 'class' => 'input-date form-control', 'id')),
						$yearsRegex,
						array('option' => array('value' => date('Y', $now), 'selected' => 'selected')),
							date('Y', $now),
						'/option',
					'*/select',
				'/div',
			'/div'
		);
		$this->assertTags($result, $expected);



		///////////////////////////
		// INPUT DATE WITH CLASS //
		///////////////////////////

		$result = $this->BsForm->input('Date', array('type' => 'date', 'class' => 'classTest'));
 
		$now = strtotime('now');

		$expected = array(
			array('div' => array('class' => 'form-group')),
				array('label' => array('for', 'class' => 'control-label col-md-'.$this->BsForm->getLeft())), 'Date', '/label',
				array('div' => array('class' => 'col-md-'.$this->BsForm->getRight())),
					array('select' => array('name', 'class' => 'classTest input-date form-control', 'id')),
						$monthsRegex,
						array('option' => array('value' => date('m', $now), 'selected' => 'selected')),
							date('F', $now),
						'/option',
					'*/select',
					'-',
					array('select' => array('name', 'class' => 'classTest input-date form-control', 'id')),
						$daysRegex,
						array('option' => array('value' => date('d', $now), 'selected' => 'selected')),
							date('j', $now),
						'/option',
					'*/select',
					'-',
					array('select' => array('name', 'class' => 'classTest input-date form-control', 'id')),
						$yearsRegex,
						array('option' => array('value' => date('Y', $now), 'selected' => 'selected')),
							date('Y', $now),
						'/option',
					'*/select',
				'/div',
			'/div'
		);
		$this->assertTags($result, $expected);


    }


    public function testInputGroup()
    {
	    ///////////////////////
    	// SIMPLE INPUTGROUP //
	    ///////////////////////

    	$result = $this->BsForm->inputGroup('Test', array('content' => 'Simple'));

		$expected = array(
			array('div' => array('class' => 'form-group')),
				array('div' => array('class' => 'col-md-'.$this->BsForm->getRight().' col-md-offset-'.$this->BsForm->getLeft())),
					array('div' => array('class' => 'input-group')),
						array('span' => array('class' => 'input-group-addon')),
							'Simple',
						'/span',
						array('input' => array('name', 'type', 'id', 'class' => 'form-control')),
					'/div',
				'/div',
			'/div'
		);

    	$this->assertTags($result, $expected);

    	/////////////////////////////
    	// WITH DIFFERENTS OPTIONS //
	    /////////////////////////////

    	$result = $this->BsForm->inputGroup('Test', array('content' => 'Simple', 'side' => 'right', 'type' => 'submit', 'state' => 'warning', 'class' => 'classTest'));

		$expected = array(
			array('div' => array('class' => 'form-group')),
				array('div' => array('class' => 'col-md-'.$this->BsForm->getRight().' col-md-offset-'.$this->BsForm->getLeft())),
					array('div' => array('class' => 'input-group')),
						array('input' => array('name', 'class' => 'form-control', 'type', 'id')),
						array('span' => array('class' => 'input-group-btn')),
							array('button' => array('type' => 'submit', 'class' => 'classTest btn btn-warning')),
								'Simple',
							'/button',
						'/span',
					'/div',
				'/div',
			'/div'
		);

    	$this->assertTags($result, $expected);

    	$result = $this->BsForm->inputGroup('Test', array('content' => 'Simple', 'class' => 'classTest'));

		$expected = array(
			array('div' => array('class' => 'form-group')),
				array('div' => array('class' => 'col-md-'.$this->BsForm->getRight().' col-md-offset-'.$this->BsForm->getLeft())),
					array('div' => array('class' => 'input-group')),
						array('span' => array('class' => 'classTest input-group-addon')),
							'Simple',
						'/span',
						array('input' => array('name', 'type', 'id', 'class' => 'form-control')),
					'/div',
				'/div',
			'/div'
		);

    	$this->assertTags($result, $expected);

    	$result = $this->BsForm->inputGroup('Test', array('content' => 'Simple', 'type' => 'image', 'src' => 'http://myimage.com'));

		$expected = array(
			array('div' => array('class' => 'form-group')),
				array('div' => array('class' => 'col-md-'.$this->BsForm->getRight().' col-md-offset-'.$this->BsForm->getLeft())),
					array('div' => array('class' => 'input-group')),
						array('span' => array('class' => 'input-group-btn')),
							array('input' => array('name', 'type' => 'image', 'id', 'class' => 'btn btn-default', 'src' => 'http://myimage.com')),
						'/span',
						array('input' => array('name', 'type', 'id', 'class' => 'form-control')),
					'/div',
				'/div',
			'/div'
		);

    	$this->assertTags($result, $expected);
    }

	  //   public function testInputGroupWithLabel()
	  //   {
	  //   	$result = $this->BsForm->inputGroup('User.test', array('content' => 'Simple'), array('label' => 'Mon Label'));

			// $expected = array(
			// 	array("div" => array("class" => "form-group")),
			// 	"label" => array("class" => "control-label col-md-3", "for" => "UserTest"),
			// 	"Mon Label",
			// 	"/label",
			// 	array("div" => array("class" => "col-md-9")),
			// 	array("div" => array("class" => "input-group")),
			// 	array("span" => array("class" => "input-group-addon")),
			// 	'Simple',
			// 	'/span',
			// 	"input" => array(
			// 		"name" => "data[User][test]",
			// 		"type" => "text",
			// 		"id" => "UserTest",
			// 		"class" => "form-control"
			// 	),
			// 	"/div",
			// 	"/div",
			// 	"/div"
			// );

	  //   	$this->assertTags($result, $expected);
	  //   }

	  //   public function testInputGroupWithButtonFullOptions()
	  //   {
	  //   	$result = $this->BsForm->inputGroup('User.test', array('content' => 'Simple', 'type' => 'button', 'state' => 'warning', 'side' => 'right', 'class' => 'ma-class'), array('label' => 'Mon Label'));
			// $expected = array(
			// 	array("div" => array("class" => "form-group")),
			// 	"label" => array("class" => "control-label col-md-3", "for" => "UserTest"),
			// 	"Mon Label",
			// 	"/label",
			// 	array("div" => array("class" => "col-md-9")),
			// 	array("div" => array("class" => "input-group")),
			// 	"input" => array(
			// 		"name" => "data[User][test]",
			// 		"type" => "text",
			// 		"id" => "UserTest",
			// 		"class" => "form-control"
			// 	),
			// 	array("span" => array("class" => "input-group-btn")),
			// 	"button" => array("type" => "button", "class" => "ma-class btn btn-warning"),
			// 	"Simple",
			// 	"/button",
			// 	"/span",
			// 	"/div",
			// 	"/div",
			// 	"/div"
			// );

	  //   	$this->assertTags($result, $expected);
	  //   }

	  //   public function testInputGroupWithTypeImage()
	  //   {
	  //   	$result = $this->BsForm->inputGroup('User.test', array('content' => 'Simple', 'type' => 'image', 'side' => 'right', "src" => "my-image"), array('label' => 'Mon Label'));
			// $expected = array(
			// 	array("div" => array("class" => "form-group")),
			// 	"label" => array("class" => "control-label col-md-3", "for" => "UserTest"),
			// 	"Mon Label",
			// 	"/label",
			// 	array("div" => array("class" => "col-md-9")),
			// 	array("div" => array("class" => "input-group")),
			// 	array("input" => array(
			// 		"name" => "data[User][test]",
			// 		"type" => "text",
			// 		"id" => "UserTest",
			// 		"class" => "form-control"
			// 	)),
			// 	"span" => array("class" => "input-group-btn"),
			// 	array("input" => array("type" => "image", "class" => "btn btn-default", "src" => "my-image")),
			// 	"/span",
			// 	"/div",
			// 	"/div",
			// 	"/div"
			// );

	  //   	$this->assertTags($result, $expected);
	  //   }

    public function testCheckbox()
    {
	    /////////////////////
    	// CHECKBOX INLINE //
	    /////////////////////

	    $this->BsForm->create('Model', array('class' => 'form-inline'));
	    $result = $this->BsForm->checkbox('Test');
	    $this->BsForm->end();

	    $expected = array(
	    	array('div' => array('class' => 'checkbox')),
	    		array('label' => array('for')),
	    			array('input' => array('name', 'type' => 'hidden', 'value', 'id')),
	    			array('input' => array('id', 'type' => 'checkbox', 'name', 'value')),
	    			' Test',
	    		'/label',
	    	'/div'
	    );

    	/////////////////////////
    	// CHECKBOX HORIZONTAL //
	    /////////////////////////

	    $this->BsForm->create('Model', array('class' => 'form-horizontal'));
	    $result = $this->BsForm->checkbox('Test');
	    $this->BsForm->end();

	    $expected = array(
	    	array('div' => array('class' => 'form-group')),
	    		array('div' => array('class' => 'col-md-offset-'.$this->BsForm->getLeft().' col-md-'.$this->BsForm->getRight())),
	    			array('div' => array('class' => 'checkbox')),
			    		array('label' => array('for')),
			    			array('input' => array('name', 'type' => 'hidden', 'value', 'id')),
			    			array('input' => array('id', 'type' => 'checkbox', 'name', 'value')),
			    			' Test',
			    		'/label',
	    			'/div',
	    		'/div',
	    	'/div'
	    );

		$this->assertTags($result, $expected);

		/////////////////////
    	// CHECKBOX INLINE //
	    /////////////////////

	    $result = $this->BsForm->checkbox('Test', array('inline' => true));

	    $expected = array(
	    	array('label' => array('for')),
			    array('input' => array('name', 'type' => 'hidden', 'value', 'id')),
			    array('input' => array('id', 'type' => 'checkbox', 'name', 'value')),
			    ' Test',
			'/label'
	    );

		$this->assertTags($result, $expected);

		///////////////////
		// FULL FEATURED //
		///////////////////

	    $result = $this->BsForm->checkbox('Test', array(
	    	'class' => 'classTest', 
	    	'id' => 'myId', 
	    	'label' => 'Label',
	    	'help' => 'helpTest',
	    	'hiddenField' => false,
	    	'label-class' => 'classLabel',
	    ));

	    $expected = array(
	    	array('div' => array('class' => 'form-group')),
	    		array('div' => array('class' => 'col-md-offset-'.$this->BsForm->getLeft().' col-md-'.$this->BsForm->getRight())),
	    			array('div' => array('class' => 'checkbox')),
			    		array('label' => array('for', 'class' => 'classLabel')),
			    			array('input' => array('type' => 'checkbox', 'name', 'value', 'class' => 'classTest', 'id' => 'myId')),
			    			' Label',
			    		'/label',
			    		array('span' => array('class' => 'help-block')),
			    			'helpTest',
			    		'/span',
	    			'/div',
	    		'/div',
	    	'/div'
	    );

		$this->assertTags($result, $expected);
    }

    public function testSelect($value='')
    {
    	$selectOptions = array(
    		'first' => 'Test1',
    		'second' => 'Test2',
    	);

	    ///////////////////
    	// SIMPLE SELECT //
	    ///////////////////

		$result = $this->BsForm->select('Test', $selectOptions);

		$expected = array(
	    	array('div' => array('class' => 'form-group')),
	    		array('div' => array('class' => 'col-md-offset-'.$this->BsForm->getLeft().' col-md-'.$this->BsForm->getRight())),
	    			array('select' => array('class' => 'form-control', 'name', 'id')),
			    		array('option' => array('value' => 'first')),
			    			'Test1',
			    		'/option',
			    		array('option' => array('value' => 'second')),
			    			'Test2',
			    		'/option',
	    			'/select',
	    		'/div',
	    	'/div'
	    );

		$this->assertTags($result, $expected);

		/////////////////////
		// MULTIPLE SELECT //
		/////////////////////

		$result = $this->BsForm->select('Test', $selectOptions, array('multiple'));

		$expected = array(
	    	array('div' => array('class' => 'form-group')),
	    		array('div' => array('class' => 'col-md-offset-'.$this->BsForm->getLeft().' col-md-'.$this->BsForm->getRight())),
	    			array('select' => array('class' => 'form-control', 'name', 'id', 'multiple')),
			    		array('option' => array('value' => 'first')),
			    			'Test1',
			    		'/option',
			    		array('option' => array('value' => 'second')),
			    			'Test2',
			    		'/option',
	    			'/select',
	    		'/div',
	    	'/div'
	    );

		$this->assertTags($result, $expected);

		///////////////////////
		// MULTIPLE CHECKBOX //
		///////////////////////

		$result = $this->BsForm->select('Test', $selectOptions, array('multiple' => 'checkbox'));

		$expected = array(
	    	array('div' => array('class' => 'form-group')),
	    		array('div' => array('class' => 'col-md-offset-'.$this->BsForm->getLeft().' col-md-'.$this->BsForm->getRight())),
	    			array('input' => array('type' => 'hidden', 'name', 'value' => '', 'id')),
	    			array('div' => array('class' => 'checkbox')),
			    		array('label' => array('for')),
			    			array('input' => array('type' => 'checkbox', 'name', 'value' => 'first', 'id')),
			    			'Test1',
			    		'/label',
	    			'/div',
	    			array('div' => array('class' => 'checkbox')),
			    		array('label' => array('for')),
			    			array('input' => array('type' => 'checkbox', 'name', 'value' => 'second', 'id')),
			    			'Test2',
			    		'/label',
	    			'/div',
	    		'/div',
	    	'/div'
	    );

		$this->assertTags($result, $expected);

		//////////////////////////////
		// MULTIPLE CHECKBOX INLINE //
		//////////////////////////////

		$result = $this->BsForm->select('Test', $selectOptions, array('multiple' => 'checkbox', 'inline' => true));

		$expected = array(
	    	array('div' => array('class' => 'form-group')),
	    		array('div' => array('class' => 'col-md-offset-'.$this->BsForm->getLeft().' col-md-'.$this->BsForm->getRight())),
	    			array('input' => array('type' => 'hidden', 'name', 'value' => '', 'id')),
		    		array('label' => array('for', 'class' => 'checkbox-inline')),
		    			array('input' => array('type' => 'checkbox', 'name', 'value' => 'first', 'id')),
		    			'Test1',
		    		'/label',
		    		array('label' => array('for', 'class' => 'checkbox-inline')),
		    			array('input' => array('type' => 'checkbox', 'name', 'value' => 'second', 'id')),
		    			'Test2',
		    		'/label',
	    		'/div',
	    	'/div'
	    );

		$this->assertTags($result, $expected);
    }

    public function testRadio($value='')
    {
    	$radioOptions = array(
    		'first' => 'Test1',
    		'second' => 'Test2',
    	);

	    //////////////////
    	// SIMPLE RADIO //
	    //////////////////

		$result = $this->BsForm->radio('Test', $radioOptions);

		$expected = array(
	    	array('div' => array('class' => 'form-group')),
	    		array('div' => array('class' => 'col-md-offset-'.$this->BsForm->getLeft().' col-md-'.$this->BsForm->getRight())),
	    			array('div' => array('class' => 'radio')),
	    				'<label',
		    				array('input' => array('type' => 'hidden', 'name', 'value' => '', 'id')),
				    		array('input' => array('type' => 'radio', 'name', 'value' => 'first', 'id')),
			    			'Test1',
			    		'/label',
			    	'/div',
			    	array('div' => array('class' => 'radio')),
	    				'<label',
				    		array('input' => array('type' => 'radio', 'name', 'value' => 'second', 'id')),
			    			'Test2',
			    		'/label',
			    	'/div',
	    		'/div',
	    	'/div'
	    );

		$this->assertTags($result, $expected);

		//////////////////////
    	// RADIO WITH LABEL //
	    //////////////////////

		// $result = $this->BsForm->radio('Test', $radioOptions, array('label' => 'My radio buttons'));
		// // '<div class="form-group"><label class="control-label col-md-3">My radio buttons</label><div class="col-md-9"><div class="radio"><label><input type="hidden" name="data[Test]" id="Test_" value=""/>
		// // <input type="radio" name="data[Test]" id="TestFirst" value="first" /><label for="TestFirst">Test1</label></label></div><div class="radio"><label><input type="radio" name="data[Test]" id="TestSecond" value="second" /><label for="TestSecond">Test2</label></label></div></div></div>'

		// // Enlever les <label for> avant Test1 et les  </label> après (regexp ?)

		// $expected = array(
	 //    	array('div' => array('class' => 'form-group')),
	 //    		array('label' => array('class' => 'control-label col-md-'.$this->BsForm->getLeft())), 'My radio buttons', '/label',
	 //    		array('div' => array('class' => 'col-md-'.$this->BsForm->getRight())),
	 //    			array('div' => array('class' => 'radio')),
	 //    				'<label',
		//     				array('input' => array('type' => 'hidden', 'name', 'value' => '', 'id')),
		// 		    		array('input' => array('type' => 'radio', 'name', 'value' => 'first', 'id')),
		// 	    			'Test1',
		// 	    		'/label',
		// 	    	'/div',
		// 	    	array('div' => array('class' => 'radio')),
	 //    				'<label',
		// 		    		array('input' => array('type' => 'radio', 'name', 'value' => 'second', 'id')),
		// 	    			'Test2',
		// 	    		'/label',
		// 	    	'/div',
	 //    		'/div',
	 //    	'/div'
	 //    );

		// $this->assertTags($result, $expected);
    }

    public function testRadioInline($value='')
    {
    	$radioOptions = array(
    		'first' => 'Test1',
    		'second' => 'Test2',
    	);

		//////////////////
		// RADIO INLINE //
		//////////////////

		$this->BsForm->create('Model', array('class' => 'form-inline'));
		$result = $this->BsForm->radio('Test', $radioOptions);
		$this->BsForm->end();

		$expected = array(
			array('label' => array('class' => 'radio-inline')),
				array('input' => array('type' => 'hidden', 'name', 'value' => '', 'id')),
	    		array('input' => array('type' => 'radio', 'name', 'value' => 'first', 'id')),
    			'Test1',
    		'/label',
			array('label' => array('class' => 'radio-inline')),
	    		array('input' => array('type' => 'radio', 'name', 'value' => 'second', 'id')),
    			'Test2',
    		'/label',
	    );

		$this->assertTags($result, $expected);
    }


    public function testSubmit()
    {
	    ///////////////////
    	// SUBMIT INLINE //
	    ///////////////////

    	$this->BsForm->create('Model', array('class' => 'form-inline'));
	    $result = $this->BsForm->submit();
	    $this->BsForm->end();

	    $expected = array(
	    	array('input' => array('class' => 'btn btn-success', 'type' => 'submit', 'value'))
	    );

		$this->assertTags($result, $expected);


		///////////////////////
		// SUBMIT HORIZONTAL //
		///////////////////////

		$this->BsForm->create('Model', array('action' => 'Action' , 'class' => 'form-horizontal'));
		$result = $this->BsForm->submit();
	    $this->BsForm->end();

	    $expected = array(
	    	array('div' => array('class' => 'form-group')),
	    		array('div' => array('class' => 'col-md-offset-'.$this->BsForm->getLeft().' col-md-'.$this->BsForm->getRight())),
	    			array('input' => array('class' => 'btn btn-success', 'type' => 'submit', 'value')),
		    			array('i' => array('class' => 'fa fa-spinner fa-spin form-submit-wait text-success')),
						'/i',
						'<script',
							'$("#ModelActionForm").submit(function(){$("#ModelActionForm input[type=\'submit\']").prop("disabled" , true);$("#ModelActionForm .form-submit-wait").show();});',
						'/script',
		    		'/div',
	    	'/div'
	    );

		$this->assertTags($result, $expected);

		//////////////////
		// FULL OPTIONS //
		//////////////////

		$this->BsForm->create('Model', array('action' => 'Action' , 'class' => 'form-horizontal'));
		$result = $this->BsForm->submit('Send', array('class' => 'btn-warning', 'id' => 'myId', 'div' => 'otherDiv'));
	    $this->BsForm->end();

	    $expected = array(
	    	array('div' => array('class' => 'form-group')),
	    		array('div' => array('class' => 'col-md-offset-'.$this->BsForm->getLeft().' col-md-'.$this->BsForm->getRight())),
	    			array('div' => array('class' => 'otherDiv')),
	    				array('input' => array('class' => 'btn btn-warning', 'id' => 'myId', 'type' => 'submit', 'value' => 'Send')),
	    			'/div',
	    			array('i' => array('class' => 'fa fa-spinner fa-spin form-submit-wait text-warning')),
						'/i',
						'<script',
							'$("#ModelActionForm").submit(function(){$("#ModelActionForm input[type=\'submit\']").prop("disabled" , true);$("#ModelActionForm .form-submit-wait").show();});',
						'/script',
	    		'/div',
	    	'/div'
	    );

		$this->assertTags($result, $expected);

		///////////////////
		// OTHER OPTIONS //
		///////////////////

		$this->BsForm->create('Model', array('class' => 'form-horizontal'));
		$result = $this->BsForm->submit('Send', array('class' => 'classTest' , 'ux' => false));
	    $this->BsForm->end();

	    $expected = array(
	    	array('div' => array('class' => 'form-group')),
	    		array('div' => array('class' => 'col-md-offset-'.$this->BsForm->getLeft().' col-md-'.$this->BsForm->getRight())),
	    			array('input' => array('class' => 'btn classTest btn-success', 'type' => 'submit', 'value')),
	    		'/div',
	    	'/div'
	    );

		$this->assertTags($result, $expected);
    }

/**
 * End function
 * @return void
 */
    public function testEnd()
    {
    	/////////////////////
    	// WITHOUT OPTIONS //
	    /////////////////////

    	$result = $this->BsForm->end();

		$expected = array('/form');
		$this->assertTags($result, $expected);

		////////////////////
    	// WITHOUT STRING //
	    ////////////////////

		$this->BsForm->create('Model', array('action' => 'Action' , 'class' => 'form-horizontal'));
    	$result = $this->BsForm->end('Update');


		$expected = array(
				array('div' => array('class' => 'form-group')),
					array('div' => array('class' => 'col-md-offset-'.$this->BsForm->getLeft().' col-md-'.$this->BsForm->getRight())),
						array('input' => array('class' => 'btn btn-success', 'type' => 'submit', 'value' => 'Update')),
						array('i' => array('class' => 'fa fa-spinner fa-spin form-submit-wait text-success')),
						'/i',
						'<script',
							'$("#ModelActionForm").submit(function(){$("#ModelActionForm input[type=\'submit\']").prop("disabled" , true);$("#ModelActionForm .form-submit-wait").show();});',
						'/script',
					'/div',
				'/div',
			'/form'
		);
		$this->assertTags($result, $expected);


		//////////////////
		// WITH OPTIONS //
		//////////////////

		$options = array(
		    'label' => 'Update',
		    'div' => array(
		        'class' => 'glass-pill',
		    )
		);

		$this->BsForm->create('Model', array('action' => 'Action' , 'class' => 'form-horizontal'));
		$result = $this->BsForm->end($options);

		$expected = array(
				array('div' => array('class' => 'form-group')),
					array('div' => array('class' => 'col-md-offset-'.$this->BsForm->getLeft().' col-md-'.$this->BsForm->getRight())),
						array('div' => array('class' => 'glass-pill')),
							array('input' => array('class' => 'btn btn-success', 'type' => 'submit', 'value' => 'Update')),
						'/div',
						array('i' => array('class' => 'fa fa-spinner fa-spin form-submit-wait text-success')),
							'/i',
							'<script',
								'$("#ModelActionForm").submit(function(){$("#ModelActionForm input[type=\'submit\']").prop("disabled" , true);$("#ModelActionForm .form-submit-wait").show();});',
							'/script',
					'/div',
				'/div',
			'/form'
		);
		$this->assertTags($result, $expected);
    }

/**
 * Title function
 * @return void
 */
	public function testTitle() {

		/////////////////////
    	// WITHOUT OPTIONS //
	    /////////////////////

		$result = $this->BsForm->title('Title');

		$expected = array(
				array('div' => array('class' => 'row')),
					array('div' => array('class' => 'col-md-'.$this->BsForm->getRight().' col-md-offset-'.$this->BsForm->getLeft())),
							'<h4',
								'Title',
							'/h4',
					'/div',
				'/div'
		);

		$this->assertTags($result, $expected);


		/////////////////////////////////
    	// WITH A SPECIFIC TITLE LEVEL //
	    /////////////////////////////////

	    $result = $this->BsForm->title('Title' , 2);

		$expected = array(
				array('div' => array('class' => 'row')),
					array('div' => array('class' => 'col-md-'.$this->BsForm->getRight().' col-md-offset-'.$this->BsForm->getLeft())),
							'<h2',
								'Title',
							'/h2',
					'/div',
				'/div'
		);

		$this->assertTags($result, $expected);
	}


/**
 * Indications function
 * @return void
 */
	public function testIndications() {

		/////////////////////
    	// WITHOUT OPTIONS //
	    /////////////////////

		$result = $this->BsForm->indications('indications');

		
		$expected = array(
				array('div' => array('class' => 'row')),
					array('div' => array('class' => 'col-md-'.$this->BsForm->getRight().' col-md-offset-'.$this->BsForm->getLeft())),
							'<p',
								'indications',
							'/p',
					'/div',
				'/div'
		);

		$this->assertTags($result, $expected);


		//////////////////////////
    	// WITH A DEFINED CLASS //
	    //////////////////////////

	    $result = $this->BsForm->indications('indications' , 'class-indications');

		$expected = array(
				array('div' => array('class' => 'row')),
					array('div' => array('class' => 'col-md-'.$this->BsForm->getRight().' col-md-offset-'.$this->BsForm->getLeft())),
							array('p' => array('class' => 'class-indications')),
								'indications',
							'/p',
					'/div',
				'/div'
		);

		$this->assertTags($result, $expected);
	}


/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() 
	{
		unset($this->BsForm);

		parent::tearDown();
	}
}
