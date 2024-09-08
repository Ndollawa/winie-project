<script>
$(document).on("click", ".open-EditDialog", function () {
    var name = $(this).data('name');
    var description = $(this).data('description');
    var category_id = $(this).data('category');
    var manufacturer_id = $(this).data('manufacturer');
    var generic_name = $(this).data('generic_name');
    var unit_id = $(this).data('unit_id');
    var physician_description = $(this).data('physician_description');
    var alert_level = $(this).data('alert_level');
    var cost_price = $(this).data('cost_price');
    var retail_price = $(this).data('retail_price');
    var wholesale_price = $(this).data('wholesale_price');
    var sales_rep_price = $(this).data('sales_rep_price');
    var supplier_id = $(this).data('supplier_id');
    var prescription_only = $(this).data('prescription_only');
    var uniqueId = $(this).data('unique-id');

    console.log( name);


    $(".modal-body #name").val( name );
    $(".modal-body #description").val( description );
    $(".modal-body #category_id").val( category_id ).change();
    $(".modal-body #supplier_id").val( supplier_id ).change();
    $(".modal-body #manufacturer_id").val( manufacturer_id ).change();
    $(".modal-body #generic_name").val( generic_name ).change();
    $(".modal-body #unit_id").val( unit_id ).change();
    $(".modal-body #physician_description").val( physician_description );
    $(".modal-body #alert_level").val( alert_level );
    $(".modal-body #cost_price").val( cost_price );
    $(".modal-body #retail_price").val( retail_price );
    $(".modal-body #wholesale_price").val( wholesale_price );
    $(".modal-body #sales_rep_price").val( sales_rep_price );
    $(".modal-body #prescription_only").val( prescription_only ).change();
    $(".modal-body #uniqueId").val( uniqueId );
    // As pointed out in comments,
    // it is unnecessary to have to manually call the modal.
    // $('#addBookDialog').modal('show');
});

$(document).on("click", ".open-DeleteDialog", function () {
    var name = $(this).data('name');

    var uniqueId = $(this).data('unique-id');

    console.log( name);


    $(".modal-body #name").val( name );

    $(".modal-body #uniqueId").val( uniqueId );
    // As pointed out in comments,
    // it is unnecessary to have to manually call the modal.
    // $('#addBookDialog').modal('show');
});
</script>
