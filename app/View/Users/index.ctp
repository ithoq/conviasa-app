<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<h1><?php echo __('Usuarios'); ?></h1>
		</div>
		<?php echo $this->Session->flash(); ?>	
	</div><!-- end col md 12 -->
	<div class="col-xs-10">
		<p>
		<?php 
			$this->Html->addCrumb(__('Usuarios'));
			echo $this->Html->getCrumbs(' > ', __('Inicio'));
		?>
		</p>
	</div>
	<div class="col-xs-2">
		<?php echo $this->Html->link(__('Registrar Usuario'), array(
			'controller' => 'users',
			'action' => 'add'),
			array(
				'class' => 'pull-right btn btn-success btn-sm'));
		?>
	</div>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
      	<i class="fa fa-user"></i> - 
        <?php echo __('Lista de usuarios') ?>
      </div>
      <!-- /.panel-heading -->
      <div class="panel-body">
        <div class="dataTable_wrapper">
          <table class="table table-striped table-bordered" id="users">
          	<?php  ?>
            <thead>
            <?php echo $this->Html->tableHeaders(array(
							__('Usuario'),
							__('Nombre'),
							__('Apellido'),
							__('Email'),
							__('Grupo'),
							__('Posición'),
							__('Acción')));
						?>
            </thead>
            <tfoot>
            <?php echo $this->Html->tableHeaders(array(
							__('Usuario'),
							__('Nombre'),
							__('Apellido'),
							__('Email'),
							__('Grupo'),
							__('Posición'),
							__('Acción')));
						?>
            </tfoot>
            <tbody>
						<?php 
						foreach ($users as $key => $user) :
							$form =
							$this->BsForm->create('User', array('action' => 'delete/' . $user['User']['id'], 'id' => 'UserDelete' . $user['User']['id'])) .
							__('<p>¿Seguro que desea eliminar el usuario <b>%s</b>?</p>', $user['User']['name']) .
							$this->BsForm->end();
							echo $this->Html->tableCells(array(
								$user['User']['username'],
								$user['User']['first_name'],
								$user['User']['last_name'],
								$user['User']['email'],
								$user['User']['role_enum'],
								$user['User']['position'],
								$this->Bs->btn(__('Ver'), array(
									'controller' => 'users',
									'action' => 'view',
									$user['User']['id']),
									array(
										'size' => 'xs',
										'tag' => 'a',
										'type' => 'primary')) . ' ' .
								$this->Bs->btn(__('Editar'), array(
									'controller' => 'users',
									'action' => 'edit',
									$user['User']['id']),
									array(
										'size' => 'xs',
										'tag' => 'a',
										'type' => 'warning')) . ' ' .
								$this->Bs->modal(
								__('Eliminar Usuario'),
								$form, array('form' => true),
								array(
								'close' => array(
									'name' => __('Cancelar'),
									'class' => 'btn-primary'),
								'open' => array(
									'name' => __('Eliminar'),
									'class' => 'btn-danger btn-xs'),
								'confirm' => array(
									'name' => __('Eliminar'),
									'class' => 'btn-danger'))))); ?>
						<?php
						endforeach;
						?>
            </tbody>
          </table>
        </div>
      </div>
      <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
  </div>
  <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<?php $this->append('script'); ?>
<?php echo $this->Html->script('/js/users/index'); ?>
<?php $this->end();