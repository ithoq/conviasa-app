<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

	echo $this->Bs->html5(__('MedsolutionsApp') . ': ' . $this->fetch('title'), __('MedsolutionsApp'), 'es');
	echo $this->Html->meta('icon');

	echo $this->fetch('meta');

	echo $this->Html->css(array(
		'/bower/bootstrap/dist/css/bootstrap.min',
		'/bower/metisMenu/dist/metisMenu.min',
		'/bower/fontawesome/css/font-awesome.min',
		'/bower/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap',
		'/bower/datatables-responsive/css/dataTables.responsive',
		'/bower/datatables-plugins/integration/font-awesome/dataTables.fontAwesome',
		'/css/bs_addon',
	));
	echo $this->Html->css('/bower/sb-admin-v2/dist/css/sb-admin-2');
	echo $this->fetch('css');
	echo $this->Bs->body();
?>
<div id="wrapper">
	<!-- por aqu va el menú -->
	<?php echo $this->element('navigation') ?>
	<div id="page-wrapper">
		<div class="row">
			<?php echo $this->fetch('content'); ?>
		</div><!-- /.container-fluid -->
	</div><!-- /#page-wrapper -->
</div><!-- #wrapper -->
<?php echo $this->Html->script('/bower/jquery/dist/jquery.min'); ?>
<?php echo $this->Html->script('/bower/bootstrap/dist/js/bootstrap.min'); ?>
<?php echo $this->Html->script('/bower/metisMenu/dist/metisMenu') ?>
<?php echo $this->Html->script('/bower/formvalidation/dist/js/formValidation.min'); ?>
<?php echo $this->Html->script('/bower/formvalidation/dist/js/framework/bootstrap.min'); ?>
<?php echo $this->Html->script('/bower/formvalidation/dist/js/language/es_ES'); ?>
<?php echo $this->Html->script('/bower/DataTables/media/js/jquery.dataTables.min'); ?>
<?php echo $this->Html->script('/bower/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min') ?>
<?php echo $this->Html->script('/bower/dataTables-responsive/js/dataTables.responsive'); ?>
<?php echo $this->Html->script('/bower/sb-admin-v2/dist/js/sb-admin-2') ?>
<?php echo $this->Html->script('/js/general') ?>
<?php echo $this->fetch('script'); ?>
<?php echo $this->Bs->end();
