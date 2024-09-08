<script type="text/javascript">
    var warehouseSalesTransactionId = '<?php echo $transactionId; ?>' ;
    var customerType = '<?php echo $customerType; ?>' ;

    $(window).on('load', function() {

        clearFields();

    })

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
                        // $('#amount').val(data.cost_price);

                        $('#qty_available').val( "" );
                        switch ( customerType ){
                            case "retailer" :
                                $('#price').val( data.retail_price );
                                break;
                            case "wholesaler" :
                                $('#price').val( data.wholesale_price );
                                break;
                            case "salesrep" :
                                $('#price').val( data.sales_rep_price );
                                break;

                        }

                    }

                });

            }else{



            }

        });


    });

    function allProduct(){
        $.ajax({
            url: '/allProducts',
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

    function showQuantity(){
        $("#batch_expiry").change(function () {
            var quantity = $("this").find(':selected').data('batch_quantity');

            console.log('quantity: '+quantity);

            $('#qty_available').val( quantity );
        });
    }

    function getSubTotal(){
        var price = $("#price").val();
        var quantity = $("#purchase_quantity").val();

        if(quantity == 0){
            $("#subtotal").val( 0);
        }else{

            $("#subtotal").val( price * quantity);
        }

    }

    function getTotal(){

        var discount = $("#discount").val();
        var price = $("#price").val();
        var quantity = $("#purchase_quantity").val();

        if(quantity == 0){
            $("#total").val( 0);
        }else{

            $("#total").val( price * quantity - discount);
        }
    }

    function clearFields(){
        // $('#product_id').empty();
        $('select2').val("");
        $('#manufacturer').val("");
        $('#warehouse_id').val("");
        $('#quantity').val("");
        $('#qty_available').val("");
        $('#batch_number').val("");
        $('#expiry').val("");
        $('#price').val("");
        $('#purchase_quantity').val("");
        $('#total').val("");
        $('#subtotal').val("");
        $("#cash").val('0');
        $("#transfer").val('0');
        $("#pos").val('0');
        $("#cheque").val('0');
        $("#amount").val("");
    }

    function totalPaymentMethods(){
        var cash = $("#cash").val();
        var transfer = $("#transfer").val();
        var pos = $("#pos").val();
        var cheque = $("#cheque").val();

        var total = Number(cash) + Number(transfer) + Number(pos) + Number(cheque);

        document.getElementById("amount").value = total;

        checkPlan();
    }

    $(document).ready(function() {

        $('select[name="product_id"]').on('change', function() {

            $('select[name="batch_expiry"]').empty();

            $('select[name="batch_expiry"]').append('<option value="">- Select Batch -</option>');

            console.log( customerType );

            var productId = $(this).val();
            var retailPrice = $(this).find(':selected').data('retail_price');
            var wholeSalePrice = $(this).find(':selected').data('wholesale_price');
            var salesRepPrice = $(this).find(':selected').data('sales_rep_price');

            console.log( retailPrice );

            //Clear quantity available
            $('#qty_available').val( "" );
            switch ( customerType ){
                case "retailer" :
                    $('#price').val( retailPrice );
                    break;
                case "wholesaler" :
                    $('#price').val( wholeSalePrice );
                    break;
                case "salesrep" :
                    $('#price').val( salesRepPrice );
                    break;

            }

            //console.log(productId);

            if(productId) {

                $.ajax({

                    url: '/warehouse/fetchBatchAndExpiry/'+productId,

                    type: "GET",

                    dataType: "json",

                    success:function(data) {

                        //$('select[name="batch_expiry"]').empty();

                        var len = data.length;
                        for(var i=0; i<len; i++){

                            console.log('test'+data.length);

                            $('select[name="batch_expiry"]').append('<option value="'+ data[i].sub_id +'" data-batch_quantity="'+data[i].quantity+'">'+ data[i].batch_number +' | '+ data[i].expiry_date +'</option>');

                        }

                    }

                });

            }else{

                $('select[name="batch_expiry"]').empty();

            }

        });

        $('select[name="product_id"]').on('click', function() {

            console.log( customerType );

            var productId = $(this).val();
            var retailPrice = $(this).find(':selected').data('retail_price');
            var wholeSalePrice = $(this).find(':selected').data('wholesale_price');
            var salesRepPrice = $(this).find(':selected').data('sales_rep_price');

            console.log( retailPrice );

            //Clear quantity available
            $('#qty_available').val( "" );
            switch ( customerType ){
                case "retailer" :
                    $('#price').val( retailPrice );
                    break;
                case "wholesaler" :
                    $('#price').val( wholeSalePrice );
                    break;
                case "salesrep" :
                    $('#price').val( salesRepPrice );
                    break;

            }

            //console.log(productId);

            if(productId) {

                $.ajax({

                    url: '/warehouse/fetchBatchAndExpiry/'+productId,

                    type: "GET",

                    dataType: "json",

                    success:function(data) {

                        $('select[name="batch_expiry"]').empty();

                        var len = data.length;
                        for(var i=0; i<len; i++){

                            console.log('test'+data.length)

                            $('select[name="batch_expiry"]').append('<option value="'+ data[i].sub_id +'" data-batch_quantity="'+data[i].quantity+'">'+ data[i].batch_number +' | '+ data[i].expiry_date +'</option>');

                        }

                    }

                });

            }else{

                $('select[name="batch_expiry"]').empty();

            }

        });


        $("#batch_expiry").change(function () {
            var quantity = $(this).find(':selected').data('batch_quantity');

            console.log('quantity: '+quantity);

            $('#qty_available').val( quantity );
        });

        $("#batch_expiry").click(function () {
            var quantity = $(this).find(':selected').data('batch_quantity');

            console.log('quantity: '+quantity);

            $('#qty_available').val( quantity );
        });


    });

    //Display Table
    fetchRecords(warehouseSalesTransactionId);

    // function calculateTotal(sumVal){
    //     document.getElementById("val").innerHTML = "Total: " + new Intl.NumberFormat().format(sumVal);
    //     document.getElementById("val1").innerHTML =sumVal;
    //     console.log(sumVal);
    // }

    function calculateTotal(){
        var sum_total_data = 0;

        $("tr #card").each(function(index,value){
            getEachRow = parseFloat($(this).text());
            sum_total_data += getEachRow
        });

        var e = document.getElementById("main-discount");
        var main_discount = e.value;

        var count1 = main_discount / sum_total_data;

        var count2 =  (sum_total_data / 100) * main_discount;

        document.getElementById("val").innerHTML = "Total: " + new Intl.NumberFormat().format(sum_total_data);

        document.getElementById("val1").innerHTML =sum_total_data;
        document.getElementById("val2").innerHTML = "Grand Total: " + new Intl.NumberFormat().format(sum_total_data);
        document.getElementById("val3").innerHTML = "Discounted Total: " + new Intl.NumberFormat().format(parseInt(sum_total_data - count2));
        document.getElementById("val4").innerHTML = new Intl.NumberFormat().format(parseInt(sum_total_data - count2));
        // console.log(sum_total_data);
        // console.log('percentage value: '+main_discount);
        // console.log('The discount: '+count2);
    }

    function calculateByNewPrice(){
        getSubTotal();
        getTotal();
    }

    //Fetch Table data
    function fetchRecords(id){
        $.ajax({
            url: '/fetchWarehouseSalesSubTransaction/'+id,
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
                    let totalDisplay = 0;
                    for(var i=0; i<len; i++){


                        totalDisplay += response[i].total;



                        //console.log(response[i].warehouse_name+'valid');
                        //   var id = response[i].sub_id;
                        var transactionId = response[i].transactionId;
                        var productName = response[i].product_name;
                        var quantity = response[i].quantity;
                        var amount = response[i].amount;
                        var discount = response[i].discount;
                        var total = response[i].total;
                        var batch_number = response[i].batch_number;
                        //var price = response[i].purchase_amount;

                        var tr_str = "<tr>" +
                            "<td align='center'>" + (i+1) + "</td>" +
                            "<td align='center'>" + batch_number + "</td>" +
                            "<td align='center'>" + productName + "</td>" +
                            "<td align='center'><span class='btn btn-danger btn-number' onclick='removeOneItemFromProduct("+transactionId+")'><i class='fa fa-minus '></i></span>&nbsp;&nbsp;&nbsp;" + quantity + " &nbsp;&nbsp;&nbsp;<span class='btn btn-success btn-number' onclick='addOneItemToProduct("+transactionId+")'><i class='fa fa-plus '></i></span></td>" +
                            "<td align='center'>" + amount + "</td>" +
                            "<td align='center'>#" + discount + "</td>" +
                            "<td align='center' id='card'>" + total + "</td>" +
                            '<td align="center">  <button class="btn btn-danger" id="deleteAction" data-id="'+ transactionId + '" > Delete </button> </td>' +

                            "</tr>";

                        $("#example1 tbody").append(tr_str);

                        calculateTotal( );
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

    //fetch csrf token
    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

    $(".btn-submit").click(function(e){

        e.preventDefault();
        createSubTransaction();
    });

    function createSubTransaction() {

        var product_id = $('#product_id').val();
        var batch_id = $('#batch_expiry').val();
        var transactionId = $('#transId').val();
        var qty_available = $('#qty_available').val();
        var price = $('#price').val();
        var discount = $('#discount').val();
        var quantity = $('#purchase_quantity').val();
        var total = $('#total').val();

        if(batch_id == "" || product_id == "" || price == "" || qty_available == "" || discount == "" || batch_id == "0"){

            swal({
                title: "Notification!",
                text: "Please complete the form to process",
                icon: "error",
                button: "close",
            });

            return false;
        }

        if(parseInt(quantity) > parseInt(qty_available)){

            swal({
                title: "Notification!",
                text: "Please ensure the purchase quantity is not more than what is available",
                icon: "error",
                button: "close",
            });

            return false;
        }


        let _url     = '/warehouseSaveSubTransaction';
        var _token   = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: _url,
            type: "POST",
            data: {
                warehouse_sales_transactions_id: transactionId,
                product_id: product_id,
                quantity: quantity,
                batch_id: batch_id,
                transId : transactionId,
                amount : price,
                total : total,
                discount : discount,
                _token: _token,
            },
            success: function(response) {
                if(response.code == 200) {
                    clearFields();
                    fetchRecords(warehouseSalesTransactionId);
                    clearFields();

                    swal({
                        title: "Notification!",
                        text: response.message,
                        icon: "success",
                        button: "close",
                    });
                }else{
                    swal({
                        title: "Notification!",
                        text: response.message,
                        icon: "error",
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


    //plugin bootstrap minus and plus
    $('.btn-number').click(function(e){
        e.preventDefault();

        fieldName = $(this).attr('data-field');
        type      = $(this).attr('data-type');
        var input = $("input[name='"+fieldName+"']");
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            if(type == 'minus') {

                getSubTotal();
                getTotal();

                if(currentVal > input.attr('min')) {
                    input.val(currentVal - 1).change();
                }
                if(parseInt(input.val()) == input.attr('min')) {
                    $(this).attr('disabled', true);
                }

            } else if(type == 'plus') {

                getSubTotal();
                getTotal();
                if(currentVal < input.attr('max')) {
                    input.val(currentVal + 1).change();
                }
                if(parseInt(input.val()) == input.attr('max')) {
                    $(this).attr('disabled', true);
                }

            }
        } else {
            input.val(0);
        }
    });

    //fetch subtotal
    $('.input-number').focusin(function(){
        $(this).data('oldValue', $(this).val());
    });
    $('.input-number').change(function() {

        minValue =  parseInt($(this).attr('min'));
        maxValue =  parseInt($(this).attr('max'));
        valueCurrent = parseInt($(this).val());

        name = $(this).attr('name');
        if(valueCurrent >= minValue) {
            getSubTotal();
            getTotal();
            $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
        } else {
            getSubTotal();
            getTotal();
            alert('Sorry, the minimum value was reached');
            $(this).val($(this).data('oldValue'));
        }
        if(valueCurrent <= maxValue) {
            getSubTotal();
            getTotal();
            $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
        } else {
            getSubTotal();
            getTotal();
            alert('Sorry, the maximum value was reached');
            $(this).val($(this).data('oldValue'));
        }


    });
    $(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
            // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            getSubTotal();
            getTotal();
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            getSubTotal();
            getTotal();
            e.preventDefault();
        }
    });



    //fetch total based on discount
    $(".discount").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
            // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            getTotal();
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            getTotal();
            e.preventDefault();
        }
    });


    //delete button
    $(document).on("click", "#deleteAction", function () {
        var warehouse_sub_sales_id = $(this).data('id');
        var  warehouse_main_sales_id =  warehouseSalesTransactionId;

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
                    url: '/deleteWarehouseSubSalesTransaction/'+warehouse_main_sales_id+'/'+warehouse_sub_sales_id,
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
                            fetchRecords(warehouseSalesTransactionId);
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

    function checkPlan(){
        var amount = $("#amount").val();
        var total = document.getElementById('val1').innerHTML;
        var total1 = document.getElementById('val4').innerHTML;

        console.log(total);

        if(amount == total || amount == total1){
            $('#payment_plan').append($('<option>', {
                value: 1,
                text: 'Complete Payment'
            }));
        }else{
            $("#payment_plan option[value='1']").remove();
        }
    }

    function checkPaymentMethod(){
        var plan = $("#payment_plan :selected").val();

        if(plan == 3){
            $("#amount").val('0');
            $("#payment_method option[value='1']").remove();
            $("#payment_method option[value='2']").remove();
            $("#payment_method option[value='3']").remove();
            $("#payment_method option[value='4']").remove();

        }else{
            $("#payment_method option[value='4']").remove();

            $('#payment_method').append($('<option>', {
                value: 1,
                text: 'Cash'
            }));
            $('#payment_method').append($('<option>', {
                value: 2,
                text: 'Cheque'
            }));
            $('#payment_method').append($('<option>', {
                value: 3,
                text: 'Transfer'
            }));
            $('#payment_method').append($('<option>', {
                value: 4,
                text: 'POS'
            }));


        }
    }


    function removeOneItemFromProduct(id){

        let _url     = '/editProductQuantity/'+id+'/minus';

        $.ajax({
            url: _url,
            type: 'get',
            dataType: 'json',
            success: function(response) {
                if(response.code == 200) {
                    // clearFields();
                    fetchRecords(warehouseSalesTransactionId);


                }else{
                    swal({
                        title: "Notification!",
                        text: response.message,
                        icon: "error",
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

    function addOneItemToProduct(id){

        let _url     = '/editProductQuantity/'+id+'/plus';

        $.ajax({
            url: _url,
            type: 'get',
            dataType: 'json',
            success: function(response) {
                if(response.code == 200) {
                    // clearFields();
                    fetchRecords(warehouseSalesTransactionId);


                }else{
                    swal({
                        title: "Notification!",
                        text: response.message,
                        icon: "error",
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
