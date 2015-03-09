$('#TrainDate').datepicker({
    format: "dd/mm/yyyy",
    startDate: "today",
    todayBtn: true,
    language: "es",
    multidate: false,
    autoclose: true,
    todayHighlight: true
}).on('changeDate', function(e) {
    // Revalidate the date field
    $('#TrainEditForm').formValidation('revalidateField', 'data[Train][date]');
});

$(document).ready(function() {
    //Inicio de Validación del form
    $('#TrainEditForm').formValidation({
        framework: 'bootstrap',
        locale: 'es_ES'
    })
});