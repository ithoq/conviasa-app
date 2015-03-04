<?php 

class ConvertidorDeCaracteres {

/**
 * Convierte una cadena de caracteres a minusculas
 * Principalmente usado para hacer minusculas el nombre de usuario cuando se crea
 * en el registro
 * 
 * @param String $cadena Usuario o cadena de caracteres
 * @return String La Cadena de Caracteres completamente en minusculas
 */
	public static function convertirAMinusculas($cadena) {
		return strtolower($cadena);
	}
}