<script>
$(document).on("click", ".open-EditDialog", function () {
    var name = $(this).data('name');
    var address = $(this).data('address');
    var state = $(this).data('state');
    var contact_name = $(this).data('contact_name');
    var contact_phonenumber = $(this).data('contact_phonenumber');
    var email= $(this).data('email');
    var uniqueId = $(this).data('unique-id');

    console.log( name);


    $(".modal-body #name").val( name );
    $(".modal-body #address").val( address );
    $(".modal-body #state").val( state ).change();
    $(".modal-body #contact_name").val( contact_name );
    $(".modal-body #contact_phonenumber").val( contact_phonenumber );
    $(".modal-body #email").val( email );
    $(".modal-body #uniqueId").val( uniqueId );
    // As pointed out in comments,
    // it is unnecessary to have to manually call the modal.
    // $('#addBookDialog').modal('show');
});
</script>
