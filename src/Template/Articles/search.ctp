<?php
// debug($articles->hydrate(false)->toList()); die();
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article[]|\Cake\Collection\CollectionInterface $articles
 */
?>
<div class="articles index large-9 medium-8 columns content">
    <h3><?= __('Articles') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('S.N') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
                <?php if ($this->request->session()->read('Auth.User.role') == 'admin') {
                ?>
                <th scope="col"><?= $this->Paginator->sort('Username') ?></th>
                <?php } ?>
                <th scope="col"><?= $this->Paginator->sort('Category') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($articles)) { foreach ($articles as $key => $article): ?>
             <?php // debug($article);die(); ?>
            <tr>
                 <td><?php echo $key+1; ?></td>
                <td><?= h($article->title) ?></td>
                <td><?= h($article->created) ?></td>
                <td><?= h($article->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $article->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $article->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $article->id], ['confirm' => __('Are you sure you want to delete # {0}?', $article->id)]) ?>
                    <?php  
                    if ($this->request->session()->read('Auth.User.role') == 'admin'){
                    if (!empty($article->user)) { ?>
                       <td><?= h($article->user->username) ?></td>
                    <?php } 
                    else{ ?>
                        <td>not available</td>
                    <?php }
                    }
                    ?>
                    <td><?= h($article->category->title) ?></td>

                </td>
            </tr>
            <?php endforeach; } ?>
        </tbody>
    </table>
</div>


