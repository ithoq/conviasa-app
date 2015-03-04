var purchaseOrders = [];
var products;
var purchaseOrder;
var index = 0;

/**
 * Clase para orden de compra
 */
function PurchaseOrder() {
    this.date = $('#PurchaseOrderDate').val();
    this.providerId = $('#ProviderId').val();
    this.warehouseId = $('#WarehouseId').val();
    this.productId = $('#ProductId').val();
    this.productName = $('#ProductName').val();
    this.productCode = $('#ProductCode').val();
    this.serial = $('#ItemSerial').val();
    this.quantity = $('#BatchQuantity').val();
    this.expirationDate = $('#ItemExpirationDate').val();
    this.productType = $("input:radio[name='data[PurchaseOrder][ProductType]']:checked").val();
};

$(document).ready(function() {
    //Inicio de Validación del form
    $('#PurchaseOrderAddForm').formValidation({
        framework: 'bootstrap',
        locale: 'es_ES'
    })
});

//al hacer click para agregar otra producto
$('#add').click(function() {
    //Validar en caso de que sea Single permitir que cantidad sea empty
    if ($("input[name='data[PurchaseOrder][ProductType]']:radio:checked").val() == 'single') {
        $('#PurchaseOrderAddForm').formValidation('enableFieldValidators', 'data[Product][code]', false);
    }

    $('#PurchaseOrderAddForm').formValidation('validate');
    if ($('#PurchaseOrderAddForm').data('formValidation').isValid()) {
        products = [];
        purchaseOrder = new PurchaseOrder();
        purchaseOrders.push(purchaseOrder); 
        //Limpiar los campos que pueden volder a ser llenados
        $('#ProductCode').val('');
        $('#ProductName').val('');
        $('#ItemSerial').val('');
        $('#BatchQuantity').val('');
        $('#ItemExpirationDate').val('');
        $("input[name='data[PurchaseOrder][ProductType]']:radio").prop('checked', false);
        //resetear form
        $('#PurchaseOrderAddForm').data('formValidation').resetForm();
        //Deshabilitar los campos para que el usuario no los pueda modificar
        //Ya que una orden de compra tiene que tener esos parámetros fijos
        $('#PurchaseOrderDate').prop('disabled', true);
        $('#ProviderId').prop('disabled', true);
        $('#WarehouseId').prop('disabled', true);
        index++;
        return false;
    }
});

//TODO: FALTA VALIDAR LOS FORMS EN PREV
//NEXT, EL SUBMIT


//al hacer click para resetear el form
$('#reset').click(function() {
    //Si la lista es mayor que uno no se puede limpiar los campos desabilitados
    if (purchaseOrders.length >= 1) {
        $('#ProductCode').val('');
        $('#ProductName').val('');
        $('#ItemSerial').val('');
        $('#BatchQuantity').val('');
        $('#ItemExpirationDate').val('');
        $("input[name='data[PurchaseOrder][ProductType]']:radio").prop('checked', false);
    }
    $('#PurchaseOrderAddForm').data('formValidation').resetForm();
});

$('#prev').click(function() {
    index--;
    $('#next').prop('disabled', false);
    if (index == 0) {
         $('#prev').prop('disabled', true);
         $('#PurchaseOrderDate').prop('disabled', false);
         $('#ProviderId').prop('disabled', false);
         $('#WarehouseId').prop('disabled', false);
    }
    $('#ProductCode').val(purchaseOrders[index].productCode);
    $('#ProductName').val(purchaseOrders[index].productName);
    $('#ItemSerial').val(purchaseOrders[index].serial);
    $('#BatchQuantity').val(purchaseOrders[index].quantity);
    $('#ItemExpirationDate').val(purchaseOrders[index].expirationDate);
});

$('#next').click(function() {
    index++;
    if (index >= purchaseOrders.length) {
       ('#next').prop('disabled', true); 
    }
    $('#ProductCode').val(purchaseOrders[index].productCode);
    $('#ProductName').val(purchaseOrders[index].productName);
    $('#ItemSerial').val(purchaseOrders[index].serial);
    $('#BatchQuantity').val(purchaseOrders[index].quantity);
    $('#ItemExpirationDate').val(purchaseOrders[index].expirationDate);
})

$('#PurchaseOrderDate').datepicker({
    format: "dd/mm/yyyy",
    startDate: "today",
    todayBtn: true,
    language: "es",
    multidate: false,
    autoclose: true,
    todayHighlight: true
}).on('changeDate', function(e) {
    // Revalidate the date field
    $('#PurchaseOrderAddForm').formValidation('revalidateField', 'data[PurchaseOrder][date]');
});

$('#ItemExpirationDate').datepicker({
    format: "dd/mm/yyyy",
    startDate: "today",
    todayBtn: true,
    language: "es",
    multidate: false,
    autoclose: true,
    todayHighlight: true
}).on('changeDate', function(e) {
    // Revalidate the date field
    $('#PurchaseOrderAddForm').formValidation('revalidateField', 'data[Item][expiration_date]');
});

//Validar Cuando se marca un elemento del radio button y activar input de Quantity o desabilitar.
$("input[name='data[PurchaseOrder][ProductType]']:radio").change(function() {
    $('#PurchaseOrderAddForm').formValidation('revalidateField', 'data[PurchaseOrder][ProductType]');

    if ($('#PurchaseOrderProductTypeBatch').is(':checked')) {
        $('#BatchQuantity').prop('disabled', false);
    } else {
        $('#BatchQuantity').prop('disabled', true);
    }
});

//Call back del FormValidation.IO en caso de no existir producto
function validateProductName() {
    if (typeof(products) != 'undefined') {
        for (i = 0; i < products.length; i++) {
            if (products[i].Product.name.toUpperCase() === $('#ProductName').val().toUpperCase()) {
                $('#ProductId').val(products[i].Product.id);
                $('#ProductName').val(products[i].Product.name);
                $('#ProductCode').val(products[i].Product.code);
                return true;
            }
        }
    }
    return false;
}

//Call back del FormValidation.IO en caso de no existir producto
function validateProductCode() {
    if (typeof(products) != 'undefined') {
        for (i = 0; i < products.length; i++) {
            if (products[i].Product.code.toUpperCase() === $('#ProductCode').val().toUpperCase()) {
                $('#ProductId').val(products[i].Product.id);
                $('#ProductName').val(products[i].Product.name);
                $('#ProductCode').val(products[i].Product.code);
                return true;
            }
        }
    }
    return false;
}

//Autocompletar por nombre de producto
$("#ProductName").autocomplete({
    source: "../products/productsByName", //El web service service que llamas
    minLength: 3, //se actia despues de haber escrito dos caracteres
    delay: 200,
    focus: function(event, ui) {
        $('#ProductName').val(ui.item.Product.name);
        return false;
    },
    response: function(event, ui) {
        products = ui.content;
        return false;
    },
    select: function(event, ui) { //Acción que hace cuando se le da enter al resultdo
        $('#ProductName').val(ui.item.Product.name);
        $('#ProductCode').val(ui.item.Product.code);
        $('#ProductId').val(ui.item.Product.id);
        $('#PurchaseOrderAddForm').formValidation('revalidateField', 'data[Product][name]');
        $('#PurchaseOrderAddForm').formValidation('revalidateField', 'data[Product][code]');
        return false;
    }
}).data("ui-autocomplete")._renderItem = function(ul, item) { //Muestra la data
    return $('<li></li>')
        .data("ui-item.autocomplete", item)
        .append('<a>' + item.Product.name + "</a>")
        .appendTo(ul);
};

//Autocompletar por código de producto
$("#ProductCode").autocomplete({
    source: "../products/productsByCode", //El web service service que llamas
    minLength: 2, //se actia despues de haber escrito dos caracteres
    delay: 200,
    focus: function(event, ui) {
        $('#ProductCode').val(ui.item.Product.code);
        return false;
    },
    response: function(event, ui) {
        products = ui.content;
        return false;
    },
    select: function(event, ui) { //Acción que hace cuando se le da enter al resultdo
        $('#ProductName').val(ui.item.Product.name);
        $('#ProductCode').val(ui.item.Product.code);
        $('#ProductId').val(ui.item.Product.id);
        $('#PurchaseOrderAddForm').formValidation('revalidateField', 'data[Product][name]');
        $('#PurchaseOrderAddForm').formValidation('revalidateField', 'data[Product][code]');
        return false;
    }
}).data("ui-autocomplete")._renderItem = function(ul, item) { //Muestra la data
    return $('<li></li>')
        .data("ui-item.autocomplete", item)
        .append('<a>' + item.Product.code + "</a>")
        .appendTo(ul);
};