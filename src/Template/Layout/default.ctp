
<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('style.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><a href=""><?= $this->fetch('title') ?></a></h1>
            </li>
        </ul>
        <div class="top-bar-section">
            <ul class="right">

                <?php 
                if ($this->request->getSession()->read('Auth')) { ?>
                    <?php $id = $this->request->getSession()->read('Auth.User.id'); ?>
                    <li><a href = '<?php echo $this->Url->build("/users/changePassword/").$id; ?>'>Change Password</a></li>
                     <li><img src="<?php echo $this->Url->build("/webroot/img/").$this->request->getSession()->read('Auth.User.img')?>"></li>
                    <li><a href = '<?php echo $this->Url->build("/users/edit/").$id; ?>'><?php echo $this->request->getSession()->read('Auth.User.username')  ?></a></li>
                    <li><a href = '<?php echo $this->Url->build("/users/logout"); ?>'>Log Out</a></li>

                <?php }else{ ?>
                    <li><a href = '<?php echo $this->Url->build("/users/add"); ?>'>Register</a></li>
                <?php } ?>
            </ul>
        </div>
    </nav>
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?php echo $this->element('side_menu') ?>
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
<style type="text/css">
    img{
        height: 27px !important;
        width: 40px !important;
        margin-top: 11px !important;
        border-radius: 200px !important;
    }
</style>
    
</body>
</html>
