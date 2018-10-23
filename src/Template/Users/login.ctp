<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
 <style type="text/css">
	.error {
	    background: red;
    	text-align: center;
	}
</style>
<body>
<?= $this->Flash->render() ?>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script> 
<link rel="stylesheet" href="<?php echo $this->Url->build('/webroot/css/layout.css') ?>">
<div class="loginpanel" align="center">
  <?= $this->Form->create() ?>
  <div class="txt">
    <input id="user" name= "username" type="text" placeholder="Username" />
    <label for="user" class="entypo-user"></label>
  </div>
  <div class="txt">
    <input id="pwd" name="password" type="password" placeholder="Password" />
    <label for="pwd" class="entypo-lock"></label>
  </div>
  <div class="buttons">
    <input type="submit" value="Login" />
    <span>
      <!-- <a href="<?php echo $this->Url->build('/users/add') ?>" class="entypo-user-add register">Register</a> -->
     <a><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Register</button>

    </span>
  </div>
  <div>
    <span>
    <a href = "<?php echo $this->Url->build('/users/forgot_password') ?>" class = "entypo-user" target= "_blank">Forgot Password ? </a>
  </span>
  </div>
  <?= $this->Form->end() ?>
</div>

 
  <!-- Trigger the modal with a button -->
  
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Register Form</h4>
        </div>
        <div class="modal-body">
            <?= $this->Form->create('',['id' => 'register', 'type' => 'file']) ?>
              <div class="txt">
                  <label for="user" class="entypo-user"></label>
                  <input id="userreg" name= "username" type="text" placeholder="Username" />
              </div>
              <div class="txt">
                  <label for="email" class="entypo-chat"></label>
                  <input id="email" name="email" type="email" placeholder="Email" class="entypo-lock">
              </div>
              <div class="txt">
                  <label for="pwd" class="entypo-lock"></label>
                  <input id="pwdreg" name="password" type="password" placeholder="Password" /><br><br>
              </div>
              <div class="txt">
                  <label for ="pwd" class="entypo-lock"></label>
                  <input type="password" name="confirmpassword" id = "pwdregg" placeholder="Confirm Password" /><br><br>
              </div>
               <div class="txt">
                  <?= $this->Form->control('gender', [
                    'options' => ['male' => 'male', 'female' => 'female', 'other' => 'other']
                ])
                ?><br> 
                <div class="txt">
                    <label for="age" class="entypo-record"></label>
                    <input id="age" name="age" type="text" placeholder="Age">
                </div><br>
                <div>
                    <?php echo $this->Form->input('img', ['type' => 'file', 'class' => 'photo-custom', 'required' => false]);?>
                </div>
              </div><br>                  
              <div class="txt">
                  <?= $this->Form->control('role', [
                  'options' => ['admin' => 'Admin', 'author' => 'Author']
                  ]) ?>
               </div><br><br>
             
              <?= $this->Form->button(__('Submit')); ?>
              <?= $this->Form->end() ?>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div> 
    </div>
  </div>
  



</body>
<script>
    $('#register').validate({
        rules:{
            password: {
              minlength: 5
            },
            confirmpassword: {
                equalTo: "#pwdreg"
            }

        }
    })
</script>

<script type="text/javascript">
    $("#register").submit(function(event){
        event.preventDefault();
        var data = new FormData($(this)[0]);
        var formURL = "<?php echo $this->Url->build('/users/add');?>";
        $.ajax({
            url: formURL,
            type: 'POST',
            data:  data,
            dataType: 'json',
            success: function(response) {
                if (response == "success") {
                    alert('The data has been saved successfully.');
                }
                else {
                    alert('The data could not be saved. Please try again.');
                }
            },
            contentType: false,
            processData:false,
        });
    });    

     $(document).ready(function(){
        $('#userreg').on('focusout',function(){
            var username = $('#userreg').val();
            // console.log(username);
            var url = "<?php echo $this->Url->build('/users/focusout/'); ?>"+username;
            // console.log(url);
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(response){
                    if(response == "failure"){
                        document.getElementById('userreg').value = " ";
                        alert("Username is already taken. Please enter another username.")
                    }else{

                    }
                }
            });
        });

        $('#email').on('focusout', function(){
            var email = $('#email').val();
            // console.log(email);
            var url = "<?php echo $this->Url->build('/users/email/'); ?>"+email;
            console.log(url);
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success:function(response){
                    if (response == "failure"){
                        document.getElementById('email').value = " ";
                        alert("Please enter a unique email");
                    }else{}
                }
            });
        });

     });           
</script>