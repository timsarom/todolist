$(document).ready(function(){
   	$('.check').click(function(){
       if ($(this).val() == 1)
       {
       		var checkbox = 0;
       }
       else
       {
       		var checkbox = 1;
       }

        var id = $(this).attr('id');
        $.ajax({
             url:"index.php",
             type:"POST",
             data: {
             	'checkbox': checkbox,
             	'id': id}
       });

   });
});