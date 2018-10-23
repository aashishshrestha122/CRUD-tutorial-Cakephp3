<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
 */
?>
<div class="articles form large-5 medium-8 columns content">
    <?= $this->Form->create($user,['id' => 'register', 'type' => 'file']) ?>
    <fieldset>
        <legend><?= __('Edit Profile') ?></legend>
        <?php
            echo $this->Form->control('username');
            // echo $this->Form->control('gender');
            echo $this->Form->control('gender', [
                    'options' => ['male' => 'male', 'female' => 'female', 'other' => 'other']
                ]);
            echo $this->Form->control('age');
            // echo $this->Form->control('img');
            echo $this->Form->input('img', ['type' => 'file', 'class' => 'photo-custom', 'required' => false]);?>
            
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
