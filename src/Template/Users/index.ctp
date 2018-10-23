<?php
// debug($users); die();
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article[]|\Cake\Collection\CollectionInterface $articles
 */
?>


<div class="articles index large-9 medium-8 columns content">
    <h3><?= __('Users') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <!-- <th scope="col"><?= $this->Paginator->sort('id') ?></th> -->
                 <th scope="col"><?= $this->Paginator->sort('S.N');?></th>
                <th scope="col"><?= $this->Paginator->sort('Username') ?></th>
                 <th scope="col"><?= $this->Paginator->sort('Roles') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Action') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($users)) { foreach ($users as $key => $user): ?>
             <?php  //debug($users);die(); ?>
            <tr>
                <td><?php echo $key+1; ?></td>                  
                 <td><?= h($user->username) ?></td>
                 <td><?= h($user->role) ?></td>
                 <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
                    
            </tr>
            <?php endforeach; } ?>
        </tbody>
    </table>
    <?php echo $this->element('pagination') ?>
    
   



