<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
	echo $this->Bs->html5(__('ConviasaApp') . ': ' . $this->fetch('title'), __('ConviasaApp'), 'es');
	echo $this->Html->meta('icon');

	echo $this->fetch('meta');

	echo $this->Html->css(array(
			'/bower/bootstrap/dist/css/bootstrap.min',
			'/bower/fontawesome/css/font-awesome.min',
			'/bower/formvalidation/dist/css/formValidation.min',
			'/css/bs_addon',
	));
	echo $this->Html->css('/bower/sb-admin-v2/dist/css/sb-admin-2');
	echo $this->fetch('css');
	echo $this->Bs->body();
?>
	<div id="wrapper">
		<?php echo $this->Session->flash(); ?>
		<?php echo $this->fetch('content'); ?>
	</div><!-- #wrapper -->
<?php echo $this->Html->script('/bower/jquery/dist/jquery.min');	?>
<?php echo $this->Html->script('/bower/bootstrap/dist/js/bootstrap.min'); ?>
<?php echo $this->Html->script('/bower/formvalidation/dist/js/formValidation.min'); ?>
<?php echo $this->Html->script('/bower/formvalidation/dist/js/framework/bootstrap.min'); ?>
<?php echo $this->Html->script('/bower/formvalidation/dist/js/language/es_ES'); ?>
<?php echo $this->fetch('script'); ?>
<?php echo $this->end();