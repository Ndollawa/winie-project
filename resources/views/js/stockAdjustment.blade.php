<script>

   function updateSingleStock(id){

       let _url     = '/updateStockAdjustment';
       var _token   = $('meta[name="csrf-token"]').attr('content');
       var quantity = $('#'+id).val();

       $.ajax({
           url: _url,
           type: "POST",
           data: {
               id: id,
               quantity: quantity,
               _token: _token,
           },
           success: function(response) {
               if(response.code == 200) {

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
</script>
