<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('ConvertidorDeCaracteres', 'Model/General');
/**
 * User Model
 *
 * @property MarketRate $MarketRate
 * @property PurchaseOrder $PurchaseOrder
 * @property DeliveryNote $DeliveryNote
 * @property Customer $Customer
 */
class User extends AppModel {

/**
 * Se declaran constantes y cada una de ellas recibe los
 * enum que están en la Base de datos para describir los Roles
 */
	const ADMIN = 'admin';
	const USER = 'user';

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
			self::ADMIN => 'Administrador',
			self::USER => 'Usuario',
		)
	);

	public $validationDomain = 'validation_errors';

/**
 * Campos virtuales para comodidad en momento de hacer consultas
 * @var array
 */
	public $virtualFields = array(
		'name' => 'CONCAT(User.first_name, " ", User.last_name)'
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
		'username' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Debe introducir un nombre de Usuario',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'between_5_15' => array(
				'rule' => array('between', 5, 15), //La regla between recibe la cantidad de caracteres mínimos y máximos permitidos
				'message' => 'Nombre de usuario tiene que ser entre 5 y 15 caracteres',
				//'allowEmpty' => false,
				//'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'unique' => array(
				'rule' => array('isUnique'),
				'message' => 'Nombre de usuario ya se encuentra registrado en el sistema',
				//'allowEmpty' => false,
				//'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'alphanumeric' => array(
				'rule' => array('alphanumeric'),
				'message' => 'No se permiten caracteres especiales',
				//'allowEmpty' => false,
				//'required' => true,
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
		'position' => array(
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
		'email' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'El email es un campo requerido',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'email' => array(
				'rule' => array('email'),
				'message' => 'Formato de email invalido',
				//'allowEmpty' => false,
				//'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'unique' => array(
				'rule' => array('isUnique'),
				'message' => 'Correo electrónico ya existente en el sistema',
				//'allowEmpty' => false,
				//'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'maxLength' => array(
				'rule' => array('maxLength', 70),
				'message' => 'Ha superado el número de caracteres permitidos (70)',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Debe ingresar una contraseña',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'between_5_255' => array(
				'rule' => array('between', 5, 255),
				'message' => 'La Contraseña debe ser mayor a 5 caracteres y menor que 255',
				//'allowEmpty' => false,
				//'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'Match passwords' => array(
				'rule' => 'matchPasswords',
				'message' => 'Contraseñas ingresadas no coinciden'
			)
		),
		'password_confirmation' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Por favor confirme su contraseña',
				'allowEmpty' => false,
				'required' => true
			)
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'MarketRate' => array(
			'className' => 'MarketRate',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'PurchaseOrder' => array(
			'className' => 'PurchaseOrder',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'DeliveryNote' => array(
			'className' => 'DeliveryNote',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Customer' => array(
			'className' => 'Customer',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Provider' => array(
			'className' => 'Provider',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
	);

/**
 * Función Callback que se ejecuta
 * Antes de que el usuario sea almacenado en la
 * base de datos, aquí también se hacer el hasg del password
 * 
 * @param array $options opciones posibles
 * @return boolean True si el usuario fue guardador exitosamente, false: si no fue almacenado
 */
	public function beforeSave($options = array()) {
		//Se Convierte el nombre de usuario ingresado a minusculas
		$this->data['User']['username'] = ConvertidorDeCaracteres::convertirAMinusculas($this->data['User']['username']);
		//Si el password no es vacio se procede a hacer hash
		//Si el password es vacio se hace unset, esto es el caso de edición para
		//no sobrescribir el password con una cadena en blanco
		if (!empty($this->data['User']['password'])) {
			//Se Hace un hash del password ingresado por el usuario
			$passwordHasher = new SimplePasswordHasher();
			$this->data['User']['password'] = $passwordHasher->hash($this->data['User']['password']);
			return true;
		} else {
			unset($this->data['User']['password']);
			return true;
		}
		return false;
	}

/**
 * Método que compara el password y el password confirmation
 * para asegurarse que el password ingresado es el deseado por el usuario
 * 
 * @return bool True: si los passwords son iguales False: si no lo son
 */
	public function matchPasswords() {
		//Si el Password es igual al password confirmaion
		if ($this->data['User']['password'] === $this->data['User']['password_confirmation']) {
			return true;
		} elseif ($this->data['User']['password_confirmation'] !== '') {
			$this->invalidate('password_confirmation', 'Contraseñas ingresadas no coinciden');
			return false;
		} else {
			return false;
		}
	}

/**
 * Método que modifica el tipo de validación en el password
 * Solo se hace en la edición cuando el admnistrador no desee 
 * cambiar el password establecido
 * 
 * @return void
 */
	public function modificarValidacion() {
		$this->validate['password']['notempty']['allowEmpty'] = true; //El password puede ser Vacio
		$this->validate['password']['between_5_255']['allowEmpty'] = true; //el password puede ser vacio pero entre 5 a 30 caracteres
		$this->validate['password_confirmation']['notempty']['allowEmpty'] = true; // la confirmacion de password puede ser vacio
	}
}
