$('#CrewSemestralDate').datepicker({
    format: "dd/mm/yyyy",
    startDate: "01/01/1900",
    todayBtn: true,
    language: "es",
    multidate: false,
    autoclose: true,
    todayHighlight: true
}).on('changeDate', function(e) {
    // Revalidate the date field
    $('#CrewAddForm').formValidation('revalidateField', 'data[Crew][semestral_date]');
});

$('#CrewAnnualDate').datepicker({
    format: "dd/mm/yyyy",
    startDate: "01/01/1900",
    todayBtn: true,
    language: "es",
    multidate: false,
    autoclose: true,
    todayHighlight: true
}).on('changeDate', function(e) {
    // Revalidate the date field
    $('#CrewAddForm').formValidation('revalidateField', 'data[Crew][annual_date]');
});


$(document).ready(function() {
    //Inicio de Validación del form
    $('#CrewAddForm').formValidation({
        framework: 'bootstrap',
        locale: 'es_ES'
    })
});

