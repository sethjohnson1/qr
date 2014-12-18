<?php

$cakeDescription = __d('cake_dev', 'QR (aka in-gallery thing)');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js');
		echo $this->Html->script('select2');
		//use the script below for any page scripts
		echo $this->Html->script('sj_intern');
		echo $this->Html->css('select2');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1><?php echo $this->Html->link($cakeDescription, 'http://cakephp.org'); ?></h1>
			<ul>
					<li><?php echo $this->Html->link('FBAuth', array('controller' => 'users', 'action' => 'auth_login','Facebook')); ?></li>
		<li><?php echo $this->Html->link('GAuth', array('controller' => 'users', 'action' => 'auth_login','Google')); ?></li>
		<li><?php echo $this->Html->link('TAuth', array('controller' => 'users', 'action' => 'auth_login','Twitter')); ?></li>
		<li><?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout')); ?></li>
			</ul>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false, 'id' => 'cake-powered')
				);
			?>
			<p>
				<?php echo $cakeVersion; ?>
			</p>
		</div>
	</div>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
