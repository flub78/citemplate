
$(document).ready(function(){
    // notre code ici
	// alert ('hello2');
 
    $( ".date" ).datepicker({changeYear: true, yearRange: "1930:2030"});
    $('.timestamp').datetimepicker({changeYear: true, yearRange: "1930:2030"});
    $('.epoch').datetimepicker({changeYear: true, yearRange: "1930:2030", timeFormat: 'HH:mm:ss'});
    $('.time').timepicker({timeFormat: 'HH:mm'});
});
