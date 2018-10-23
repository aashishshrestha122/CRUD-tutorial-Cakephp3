<?
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
 */
?>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<div class="articles form large-5 medium-8 columns content">
    <?= $this->Form->create('',['id' => 'myform']) ?>
    <fieldset>
    	<?php
            echo $this->Form->control('old password', ['type' => 'password']);
            echo $this->Form->control('New password', ['name' => 'newpassword','id' => 'newpassword','type' => 'password']);
            echo $this->Form->control('confirm password', ['name' => 'confirm','type' => 'password']);
            ?>
    </fieldset>
    <?= $this->Form->button(__('change')) ?>
    <?= $this->Form->end() ?>
</div>

<script>
    $( "#myform" ).validate({
      rules: {
        newpassword: "required",
        confirm: {
          equalTo: "#newpassword"
        }
      }
    });
</script>