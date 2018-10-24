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
        <select id="user">
            <option></option>
        </select>
        
    </fieldset>
    <!-- <?= $this->Form->button(__('Search')) ?> -->
    <?= $this->Form->end() ?>
    <div id="div1">
        <table id="table" border="1">
            <thead>
                <tr>
                <th>Title</th>
                <th>Body</th>
                </tr>
            </thead>
            <tbody id="render-tbody">
                
            </tbody>
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
                $('#user').html('');
                $('#render-tbody').html('');
                var id = ($(this).val());
                console.log();
            }
            var formURL = "<?php echo $this->Url->build('/articles/aa/');?>"+id;
            // console.log(formURL);
            $.ajax({
                url: formURL,
                type: 'GET',
                dataType: 'json',
                success:function(response){
                    // console.log(response);
                    $.each( response.query, function( key, value ) {
                        $('#render-tbody').append("<tr>");
                        $.each( value, function( k, v ) {
                            var a =  v ;
                            if (k == 'title' || k == 'body')
                            {
                                $('#render-tbody').append("<td>"+a+"</td>");
                            }    
                        });
                        $('#render-tbody').append("</tr>");
                    });
                    $.each(response.user, function(key, value){
                        var d = value;
                        // console.log(d);
                        $('#user').append("<option value ="+key+">"+d+"</option");
                    });

                }
            });
        });

        $('#user').change(function(event){

            var name = ($('#user').val());
            // console.log(name);
            var cat =  ($('#category').val());
            // console.log(cat);
            var URL = "<?php echo $this->Url->build('/articles/bb/');?>"+name+'/'+cat;
            // console.log(URL);
            $.ajax({
                url: URL,
                type: 'GET',
                dataType: 'json',
                success: function(response){
                    // console.log(response);
                    $.each(response, function(key,value){
                        $.each(response, function(k,v){
                            var f = v;
                            console.log(f);
                            if (key == 'title' || key == 'body')
                            {
                                $('#user').html('');
                                $('#render-tbody').append("<td>"+f+"</td");
                            }
                        });
                    });
                     // $('#user').html('');
                }
            });
        });
        
</script>



 