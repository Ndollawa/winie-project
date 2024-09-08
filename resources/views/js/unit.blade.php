<script>
    $(document).on("click", ".open-EditDialog", function () {
        var name = $(this).data('name');
        var uniqueId = $(this).data('unique-id');


        $(".modal-body #name").val( name );
        $(".modal-body #uniqueId").val( uniqueId );
        // As pointed out in comments,
        // it is unnecessary to have to manually call the modal.
        // $('#addBookDialog').modal('show');
    });
</script>
