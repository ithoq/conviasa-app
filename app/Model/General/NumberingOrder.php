<?php 
class NumberingOrder {

/**
 * Método que calcula la numeración de las filas de la tabla
 * según sea el orden de la paginación, descendente o ascendente
 * y según el número de página
 * 
 * @param array $params Los parámetros de la vista
 * @param string $model el nombre del modelo al cual se hará la numeración
 * @return array('counter','isOrderAsc') contador y si es orden ascendente
 */
	public static function setNumberingOrder($params, $model) {
		$isOrderAsc = true;
		$counter = 1;
		$params = $params[$model];
		$page = $params['page'];
		$limit = $params['limit'];
		$count = $params['count'];
		if (!empty($params['order'][$model . '.id'])) {
			$order = $params['order'][$model . '.id'];
			if ($order === 'desc') {
				$pageCount = $params['pageCount'];
				$counter = $count - (($limit) * ($page - 1));
				$isOrderAsc = false;
			} elseif ($order === 'asc') {
				$counter = ($page * $limit) - $limit + 1;
				$isOrderAsc = true;
			}
		} else {
			$page = $params['page'];
			$limit = $params['limit'];
			$counter = ($page * $limit) - $limit + 1;
		}
		return array('counter' => $counter, 'isOrderAsc' => $isOrderAsc);
	}
}