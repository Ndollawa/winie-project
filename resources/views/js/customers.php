<script>
    $(document).on("click", ".open-EditDialog", function () {
        var name = $(this).data('name');
        var address = $(this).data('address');
        var phonenumber = $(this).data('phonenumber');
        var role = $(this).data('type');
        var uniqueId = $(this).data('unique-id');

        console.log(role);


        $(".modal-body #name").val( name );
        $(".modal-body #address").val( address );
        $(".modal-body #phonenumber").val( phonenumber );
        $(".modal-body #role").val( role ).change();
        $(".modal-body #uniqueId").val( uniqueId );
        // As pointed out in comments,
        // it is unnecessary to have to manually call the modal.
        // $('#addBookDialog').modal('show');
    });
</script>
