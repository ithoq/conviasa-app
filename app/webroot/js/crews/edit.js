$('#CrewSemestralDate').datepicker({
    format: "dd/mm/yyyy",
    startDate: "today",
    todayBtn: true,
    language: "es",
    multidate: false,
    autoclose: true,
    todayHighlight: true
}).on('changeDate', function(e) {
    // Revalidate the date field
    $('#CrewEditForm').formValidation('revalidateField', 'data[Crew][semestral_date]');
});

$('#CrewAnnualDate').datepicker({
    format: "dd/mm/yyyy",
    startDate: "today",
    todayBtn: true,
    language: "es",
    multidate: false,
    autoclose: true,
    todayHighlight: true
}).on('changeDate', function(e) {
    // Revalidate the date field
    $('#CrewEditForm').formValidation('revalidateField', 'data[Crew][annual_date]');
});


$(document).ready(function() {
    //Inicio de Validación del form
    $('#CrewEditForm').formValidation({
        framework: 'bootstrap',
        locale: 'es_ES'
    })
});

