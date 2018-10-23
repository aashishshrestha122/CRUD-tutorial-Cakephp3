<body>
<?= $this->Flash->render() ?>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script> 
<link rel="stylesheet" href="<?php echo $this->Url->build('/webroot/css/layout.css') ?>">
<div class="loginpanel" align="center">
  <?= $this->Form->create() ?>
  <div class="txt">
    Enter your email: 
    <input id="email" name= "email" type="email" placeholder="email" />
  </div>
  <div class="buttons">
    <input type="submit" value="Next" />
  </div>
  <?= $this->Form->end() ?>
</div>
</body>
