<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		</button>
		<?php echo $this->Html->link(__('ConviasaApp'), array('controller' => 'crews', 'action' => 'index'), array('class' => 'navbar-brand')); ?>
	</div>
	<!-- /.navbar-header -->
	<ul class="nav navbar-top-links navbar-right">
		<!-- /.dropdown -->
		<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">
				<i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
			</a>
			<ul class="dropdown-menu dropdown-user">
				<li> 	
					<a href="<?php echo $this->Html->url(array(
												'controller' => 'users',
												'action' => 'edit',
												$currentUser['id'])) ?>">
						<i class="fa fa-user fa-fw"></i><?php echo __('Editar perfil') ?>
					</a>
				</li>
				<li class="divider"></li>
				<li> 	
					<a href="<?php echo $this->Html->url(array(
												'controller' => 'users',
												'action' => 'logout')) ?>">
						<i class="fa fa-sign-out fa-fw"></i><?php echo __('Cerrar Sesión') ?>
					</a>
				</li>
			</ul>
			<!-- /.dropdown-user -->
		</li>
		<!-- /.dropdown -->
	</ul>
	<!-- /.navbar-top-links -->
	<div class="navbar-default sidebar" role="navigation">
		<div class="sidebar-nav navbar-collapse">
			<ul class="nav" id="side-menu">
			<?php 
			foreach ($mainMenu as $key => $value) { ?>
				<li>
					<a href="<?php echo $this->Html->url($value['url']) ?>">
						<i class="<?php echo $value['icon'] ?> fa-fw"></i>
						<?php echo $value['title'] ?>
					</a>
				</li>			
			<?php 
			}
			?>
			</ul>
		</div>
		<!-- /.sidebar-collapse -->
	</div>
	<!-- /.navbar-static-side -->
</nav>