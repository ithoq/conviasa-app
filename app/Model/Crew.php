<?php
App::uses('AppModel', 'Model');

/**
 * User Model
 *
 * @property MarketRate $MarketRate
 * @property PurchaseOrder $PurchaseOrder
 * @property DeliveryNote $DeliveryNote
 * @property Customer $Customer
 */
class Crew extends AppModel {

/**
 * Se declaran constantes y cada una de ellas recibe los
 * enum que están en la Base de datos para describir los Roles
 */
	const CAPITAN = 'cap';
	const PRIMER_OFICIAL = 'cop';
	const INSTRUCTOR = 'tri';

/**
 * Se declara un arreglo que tiene asociados
 * las constantes declaradas con los enums de los roles
 * con los alias que se le asignan para una visualización comoda
 * en la vista*
 */
	public $enum = array(
		'role' =>
			array(
			'' => 'Escoja Una Opción',
			self::CAPITAN => 'Capitán',
			self::PRIMER_OFICIAL => 'Primer Oficial',
			self::INSTRUCTOR => 'Instructor',
		)
	);

	public $validationDomain = 'validation_errors';

/**
 * Campos virtuales para comodidad en momento de hacer consultas
 * @var array
 */
	public $virtualFields = array(
		'name' => 'CONCAT(Crew.first_name, " ", Crew.last_name)'
	);

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'El id es obligatorio',
				'allowEmpty' => false,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'El id tiene que ser un número',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'positive' => array(
				'rule' => array('isPositive'),
				'message' => 'Tiene que ser un número positivo',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)
		),
		'first_name' => array(
			'notEmpty' => array(
				'rule' => array('notempty'),
				'message' => 'El campo de nombre no puede estar vacio',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'maxLength' => array(
				'rule' => array('maxLength', 45),
				'message' => 'Ha superado el número de caracteres permitidos (45)',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'last_name' => array(
			'notEmpty' => array(
				'rule' => array('notempty'),
				'message' => 'El campo de apellido no puede estar vacio',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'maxLength' => array(
				'rule' => array('maxLength', 45),
				'message' => 'Ha superado el número de caracteres permitidos (45)',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'role' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'El cargo es requerido',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'maxLength' => array(
				'rule' => array('maxLength', 45),
				'message' => 'Ha superado el número de caracteres permitidos (45)',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'semestral_date' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'La fecha es requerida',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'validate_semestral_date' => array(
				'rule' => array('validateSemestralDate'),
				'message' => 'Recuerde que la fecha de simulador no puede ser mayor a 7 meses',
				// 'allowEmpty' => false,
				// 'required' => true,
				//'last' => false, // Stop validation after this rule
				'on' => 'update', // Limit validation to 'create' or 'update' operations
			)
		),
		'annual_date' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'La fecha es requerida',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				'on' => 'update', // Limit validation to 'create' or 'update' operations
			),
			'validate_annual_date' => array(
				'rule' => array('validateAnnualDate'),
				'message' => 'Recuerde que la fecha de simulador no puede ser mayor a 1 año',
				// 'allowEmpty' => false,
				// 'required' => true,
				//'last' => false, // Stop validation after this rule
				'on' => 'update', // Limit validation to 'create' or 'update' operations
			)
		),
	);

/**
 * [validateSemestralDate description]
 * @return [type] [description]
 */
	public function validateSemestralDate() {
		$currentCrew = $this->find('first', array(
			'conditions' => array(
				'Id' => $this->data['Crew']['id'])));
		$futureDate = date('Y-m-d', strtotime("+7 months", strtotime($currentCrew['Crew']['semestral_date'])));
		if (strtotime($this->data['Crew']['semestral_date']) >= strtotime($futureDate)) {
			return false;
		} else {
			return true;
		}
	}

/**
 * [validateAnnualDate description]
 * @return [type] [description]
 */
	public function validateAnnualDate() {
		$currentCrew = $this->find('first', array(
			'conditions' => array(
				'Id' => $this->data['Crew']['id'])));
		$futureDate = date('Y-m-d', strtotime("+12 months", strtotime($currentCrew['Crew']['annual_date'])));
		if (strtotime($this->data['Crew']['annual_date']) >= strtotime($futureDate)) {
			return false;
		} else {
			return true;
		}
	}
}