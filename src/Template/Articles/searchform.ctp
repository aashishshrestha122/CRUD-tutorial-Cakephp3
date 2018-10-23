<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="<?php echo $this->Url->build('/webroot/js/date.js') ?>"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<div class="articles form large-9 medium-8 columns content">
    <?= $this->Form->create('', ['url' => ['action' => 'search']]) ?>
    <fieldset>
        <?php
            // echo $this->Form->control('title');
            // echo $this->Form->control('start date',['id' => 'datepicker', 'autocomplete' => 'off']);
            // echo $this->Form->control('end date',['id' => 'picker', 'autocomplete' => 'off']);
            echo $this->Form->select('category_id', $categories,['id' => 'category', 'empty' =>'(choose category)']);
        ?>
        
    </fieldset>
    <!-- <?= $this->Form->button(__('Search')) ?> -->
    <?= $this->Form->end() ?>
    <div id="div1">
        <table id="table">
            
        </table>
    </div>
</div>

  
  <script>

        // $("#datepicker").datepicker({  
        //         dateFormat: "yy-mm-dd"  
        //         }); 
        // $("#picker").datepicker({
        //         dateFormat: "yy-mm-dd"
        // }); 
 
        // $("form").submit(function(event){
        //     var start= $("#datepicker").datepicker("getDate");
        //     var end= $("#picker").datepicker("getDate");
        //     if (start > end) {
        //         alert('Date is invalid');
        //         event.preventDefault();
        //     }
        //     else {
        //         return true;
        //     }
        // });

        $("#category").change(function(event){
            if($(this).val() == "" )
            {
                
            }
            else
            {
                var id = ($(this).val());
            }
            var formURL = "<?php echo $this->Url->build('/articles/aa/');?>"+id;
            // console.log(formURL);
            $.ajax({
                url: formURL,
                type: 'GET',
                dataType: 'json',
                success:function(response){
                    console.log(response);
                    $.each( response, function( key, value ) {
                        $.each( value, function( k, v ) {
                         var a = k + ": " + v ;.
                         $('#table').html(a);
                            
                        });
                    });
                }
            });
        });
        // $('#').html('awerawerwaer');
</script>



 