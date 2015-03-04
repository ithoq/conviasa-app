<?php
App::uses('AbstractPasswordHasher', 'Controller/Component/Auth');

class CustomPasswordHasher extends AbstractPasswordHasher {

/**
 * [hash description]
 * @param  [type] $password [description]
 * @return [type]           [description]
 */
	public function hash($password) {
		return $password;
	}

/**
 * [check description]
 * @param  [type] $password       [description]
 * @param  [type] $hashedPassword [description]
 * @return [type]                 [description]
 */
	public function check($password, $hashedPassword) {
		return $password === $this->hash($hashedPassword);
	}
}