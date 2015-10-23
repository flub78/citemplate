
$(document).ready(function(){
    // notre code ici
	// alert ('hello2');
 
    $( ".date" ).datepicker({changeYear: true, yearRange: "1930:2030"});
    $('.timestamp').datetimepicker();
    $('.timestamp3').datepicker();

});
