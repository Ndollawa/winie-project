<script>
$(document).on("click", ".open-EditDialog", function () {

    var t_date = $(this).data('date');
    var details = $(this).data('details');
    var way_bill_number = $(this).data('way_bill_number');
    var payment_plan = $(this).data('payment_plan');
    var payment_method = $(this).data('payment_method');
    var invoice_number = $(this).data('invoice_number');
    var supplier_id = $(this).data('supplier_id');
    var amount_paid = $(this).data('amount_paid');
    var uniqueId = $(this).data('unique-id');


    $(".modal-body #date").val( t_date );
    $(".modal-body #details").val( details );
    $(".modal-body #invoice_number").val( invoice_number );
    $(".modal-body #way_bill_number").val( way_bill_number );
    $(".modal-body #payment_plan").val( payment_plan ).change();
    $(".modal-body #payment_method").val( payment_method ).change();
    $(".modal-body #supplier_id").val( supplier_id ).change();
    $(".modal-body #amount_paid").val( amount_paid );
    $(".modal-body #uniqueId").val( uniqueId );
    // As pointed out in comments,
    // it is unnecessary to have to manually call the modal.
    // $('#addBookDialog').modal('show');
});
</script>
