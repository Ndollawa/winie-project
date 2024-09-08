<script>

    var expiredProducts = <?php echo $expiredProducts; ?>;
    if(expiredProducts !== null){

        $('#expiredProductsModal').modal('show');
    }


    var lowStock = <?php echo $noOfLowStock; ?>;
    if(lowStock !== null){

        $('#lowStockModal').modal('show');
    }

    var noOfShortDatedStock = <?php echo $noOfShortDatedStock; ?>;
    if(noOfShortDatedStock !== null){

        $('#noOfShortDatedStock').modal('show');
    }
</script>
