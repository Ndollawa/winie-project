<script type="text/javascript">
    var supplierTransactionId = '<?php echo $transactionId; ?>' ;
    //$transactionId  was passed to the page from controller


    //Display Table
    fetchRecords(supplierTransactionId);
    $(window).on('load', function() {
      //  allProduct();
    })



    function allProduct(){
         $.ajax({
           url: '/supplierTransaction/allProductDropdown/',
           type: 'get',
           dataType: 'json',
           success: function(response){

             var len = 0;
             if(response['data'] != null){
               len = response['data'].length;
             }

             if(len > 0){
               // Read data and create <option >
               for(var i=0; i<len; i++){

                 var id = response['data'][i].id;
                 var name = response['data'][i].name;

                 var option = "<option value='"+id+"'>"+name+"</option>";

                 $("#product_id").append(option);
               }
             }

           }
        });
    }

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
                            '<td align="center">  <button class="btn btn-danger" id="deleteAction" data-id="'+id+'" data-transaction_id="'+transaction_id+'" > Delete </button> </td>' +

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

                        $('#cost_price').val(data.cost_price);
                        $('#retail_price').val(data.retail_price);
                        $('#wholesale_price').val(data.wholesale_price);
                        $('#sales_rep_price').val(data.sales_rep_price);
                        $('#product_id2').val(data.product_id);

                        document.getElementById("productTitle").textContent=data.product_name;

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
    function createSubTransaction() {

        var product_id = $('#product_id').val();
        var amount = $('#amount').val();
        var warehouse_id = $('#warehouse_id').val();
        var quantity = $('#quantity').val();
        var batch_number = $('#batch_number').val();
        var expiry = $('#expiry').val();
        var trans_id = $('#transId').val();

        var purchaseAmount = quantity * amount;

        let _url     = '/createSubTransaction';
      var _token   = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: _url,
            type: "POST",
            data: {
                supplier_transaction_id: trans_id,
                product_id: product_id,
                quantity_bought: quantity,
                expiry_date: expiry,
                warehouse_id: warehouse_id,
                batch_number: batch_number,
                purchase_amount: purchaseAmount,
                _token: _token,
            },
            success: function(response) {
                if(response.code == 200) {
                    clearFields();
                    fetchRecords(supplierTransactionId);
                    swal({
                        title: "Notification!",
                        text: response.message,
                        icon: "success",
                        button: "close",
                    });
                }
            },
            error: function(response) {
                swal({
                    title: "Notification!",
                    text: "An Error Occured",
                    icon: "error",
                    button: "close",
                });
            }
        });
    }

</script>
