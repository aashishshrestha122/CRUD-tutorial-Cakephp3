<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
    	<?php
    	$role = $this->request->getSession()->read('Auth.User.role');
    	$param = $this->request->getParam('controller');
    	$action = $this->request->getParam('action');
    	// debug($param);
    	// debug($action);die();
    	// debug($role);die();
    	if ($role == 'admin'){
    	?>
	        <li class="heading"><?= __('Actions') ?></li>
	        <li class="heading <?php if($param == 'Users') { echo 'activediv'; }?>"><?= $this->Html->link(__('Users'), ['controller' => 'users', 'action' => 'index']) ?></li>
	        <?php if ($param == 'Users' && $action == 'index') { ?>
	        	<li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?></li>
	    	<?php } ?>
	        <li class="heading <?php if($param == 'Articles' && $action == 'index') { echo 'activediv'; }?>"><?= $this->Html->link(__('Article'), ['controller' => 'articles', 'action' => 'index']) ?></li>
	        <?php if ($param == 'Articles' && $action == 'index') { ?>
	        	<li><?= $this->Html->link(__('New Article'), ['action' => 'add']) ?></li>
	    	<?php } ?>
	        <li class="heading <?php if($param == 'Articles' && $action == 'searchform') { echo 'activediv'; }?>"><?= $this->Html->link(__('Search'),['controller' => 'articles', 'action' => 'searchform']) ?></li>
	        <li class="heading <?php if($param == 'Message') { echo 'activediv'; }?>"><?= $this->Html->link(__('Message'), ['controller' => 'messages', 'action' => 'add']) ?></li>

    	<?php } else{?>

    		<li class="heading"><?= __('Actions') ?></li>
	        <li class="heading <?php if($param == 'Articles' && $action == 'index') { echo 'activediv'; }?>"><?= $this->Html->link(__('Article'), ['controller' => 'articles', 'action' => 'index']) ?></li>
	        <?php if ($param == 'Articles' && $action == 'index') { ?>
	        	<li><?= $this->Html->link(__('New Article'), ['action' => 'add']) ?></li>
	    	<?php } ?>
	        <li class="heading <?php if($param == 'Articles' && $action == 'searchform') { echo 'activediv'; }?>"><?= $this->Html->link(__('Search'),['controller' => 'articles', 'action' => 'searchform']) ?></li>
	        <li class="heading <?php if($param == 'Articles' && $action == 'latest') { echo 'activediv'; }?>"><?= $this->Html->link(__('Latest Articles'),['controller' => 'articles', 'action' => 'latest']) ?></li>
	     <?php } ?>

        
        
    </ul>
</nav>
<style type="text/css">
	.activediv{
		background-color: #dce47e;
	}
</style>