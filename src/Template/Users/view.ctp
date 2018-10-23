<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
 */
?>
<?php //debug($article);die(); ?>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->username) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Photo') ?></th>
            <td><?= $this->Html->Image($user->img) ?></td>
        </tr> 
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>       
        <tr>
            <th scope="row"><?= __('User Created') ?></th>
            <td><?= h($user->created) ?></td>
        </tr>  
        <tr>
            <th scope="row"><?= __('Role') ?></th>
            <td><?= h($user->role) ?></td>
        </tr> 
        <tr>
            <th scope="row"><?= __('Gender') ?></th>
            <td><?= h($user->gender) ?></td>
        </tr> 
        <tr>
            <th scope="row"><?= __('Emails') ?></th>
            <td><?= h($user->email) ?></td>
        </tr> 
        
    </table>
    <div class="row">
        <h4><?= __('Articles') ?></h4>
        <table class = "vertical-table">
            <tr>
                
                   <?php foreach($article as $a){ ?>
                    <li><?= $this->Html->link(__( h($a["title"])), ['controller' => 'Articles', 'action' => 'view', $a['id']]) ?></li>

                   <?php }?>                  
             </tr>
            </tr>
        </table>    
    </div>
</div>
