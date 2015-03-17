$(document).ready(function() {
    $('#instructors').DataTable({
    	"aoColumns": [
            null,
            null,
            { "sType": "date-uk" },
            { "sType": "date-uk" }, 
            null,
            null,
        ]});
 });