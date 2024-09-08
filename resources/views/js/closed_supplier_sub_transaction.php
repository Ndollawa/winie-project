<script type="text/javascript">
    var supplierTransactionId = '<?php echo $transactionId; ?>' ;
    //$transactionId  was passed to the page from controller

    //Display Table
    fetchRecords(supplierTransactionId);

    //Fetch Table data
    function fetchRecords(id){
        $.ajax({
            url: '/fetchSubTransaction/'+id,
            type: 'get',
            dataType: 'json',
            success: function(response){

                var len = 0;
                $('#example1 tbody').empty(); // Empty <tbody>
                if(response != null){
                    len = response.length;
                }
                // console.log('valid1');

                if(len > 0){
                    for(var i=0; i<len; i++){

                        //console.log(response[i].warehouse_name+'valid');
                        var id = response[i].sub_id;
                        var transaction_id = response[i].transaction_id;
                        var warehouse = response[i].warehouse_name;
                        var warehouse_id = response[i].warehouse_id;
                        var batchNumber = response[i].batch_number;
                        var productName = response[i].product_name;
                        var quantity = response[i].quantity;
                        var expiryDate = response[i].expiry_date;
                        var price = response[i].purchase_amount;

                        var tr_str = "<tr>" +
                            "<td align='center'>" + (i+1) + "</td>" +
                            "<td align='center'>" + warehouse + "</td>" +
                            "<td align='center'>" + batchNumber + "</td>" +
                            "<td align='center'>" + productName + "</td>" +
                            "<td align='center'>" + quantity + "</td>" +
                            "<td align='center'>" + expiryDate + "</td>" +
                            "<td align='center'>" + price + "</td>" +
                            '<td align="center">  <a class="btn btn-info open-EditDialog" href="#addBookDialog" data-toggle="modal"  data-id="'+id+'" data-warehouse_id="'+warehouse+'" data-expiry_date="'+expiryDate+'" data-batch_number="'+batchNumber+'" data-quantity="'+quantity+'" data-transaction_id="'+transaction_id+'"> Edit </a> </td>' +

                            "</tr>";

                        $("#example1 tbody").append(tr_str);
                    }
                }else{
                    var tr_str = "<tr>" +
                        "<td align='center' colspan='4'>No record found.</td>" +
                        "</tr>";

                    $("#example1 tbody").append(tr_str);
                }

            }
        });
    }


    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });


    $(document).ready(function() {

        //Dropdown
        $('select[name="product_id"]').on('change', function() {

            var productId = $(this).val();

            if(productId) {

                $.ajax({

                    url: '/fetchProductInformation/'+productId,

                    type: "GET",

                    dataType: "json",

                    success:function(data) {

                        $('#manufacturer').val(data.manufacturerName);
                        $('#qty_available').val(data.quantity);
                        $('#amount').val(data.cost_price);

                    }

                });

            }else{



            }

        });


    });



    //delete button
    $(document).on("click", "#deleteAction", function () {
        var sub_id = $(this).data('id');
        var supplier_transaction_id = $(this).data('transaction_id');

        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            buttons: [
                'No, cancel it!',
                'Yes, I am sure!'
            ],
        }).then(function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: '/deleteSubTransaction/'+sub_id+'/'+supplier_transaction_id,
                    type: 'GET',
                    success: function(response)
                    {
                        //get response
                        const obj = JSON.parse(response);
                        if(obj.status == 'failed'){
                            swal({
                                title: "Notification!",
                                text: " Unable to delete",
                                icon: "error",
                                button: "close",
                            });
                        }else{
                            fetchRecords(supplierTransactionId);
                            swal({
                                title: "Notification!",
                                text: " Success",
                                icon: "success",
                                button: "close",
                            });
                        }

                        //console.log('Success '+ obj.status);
                    },error: function (response) {
                        swal({
                            title: "Notification!",
                            text: " Unable to delete",
                            icon: "error",
                            button: "close",
                        });
                    }
                });
            } else {
                swal("Cancelled", "Your file is safe :)", "error");
            }
        })



    });



    $(".btn-submit").click(function(e){

        e.preventDefault();
        createSubTransaction();
    });

    function clearFields(){
        // $('#product_id').empty();
        $('select').val('');
        $('#manufacturer').val("");
        $('#warehouse_id').val("");
        $('#quantity').val("");
        $('#qty_available').val("");
        $('#batch_number').val("");
        $('#expiry').val("");
    }

    //submit form data
    $(document).on("click", ".open-EditDialog", function () {
        var id = $(this).data('id');
        var transaction_id = $(this).data('transaction_id');
        var quantity = $(this).data('quantity');
        var warehouse = $(this).data('warehouse_id');
        var expiry_date = $(this).data('expiry_date');
        var batch_number = $(this).data('batch_number');

        console.log( warehouse);


        $(".modal-body #quantity").val( quantity );
        $(".modal-body #expiry_date").val( expiry_date );
        $(".modal-body #warehouse_id").val( warehouse );
        $(".modal-body #batch_number").val( batch_number );
        $(".modal-body #id").val( id );
        $(".modal-body #transaction_id").val( transaction_id );
        // $(".modal-body #uniqueId").val( uniqueId );
        // As pointed out in comments,
        // it is unnecessary to have to manually call the modal.
        // $('#addBookDialog').modal('show');
    });

</script>
