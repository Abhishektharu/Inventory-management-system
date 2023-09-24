<script>
    $(document).ready(function () {
    $("#saveStatus").click(function () {
        // Create an array to store data for all products
        var productDataArray = [];

        // Loop through each product and get its data
        for (var i = 1; i <= 10; i++) {
            var productId = "product" + i;
            var productName = $("#" + productId + "Name").val();
            var productSupplier = $("#" + productId + "Supplier").val();
            var productStatus = $("#" + productId + "Status").val();

            var productData = {
                product_name: productName,
                product_supplier: productSupplier,
                product_status: productStatus
            };

            productDataArray.push(productData);
        }

        // Send data to the PHP server via AJAX
        $.ajax({
            url: "process.php", // Replace with your PHP script URL
            method: "POST",
            data: { productData: productDataArray }, // Send the array as a single POST parameter
            success: function (response) {
                // Handle the response from the server (if needed)
                console.log(response);
                $("#myModal").modal("hide"); // Close the modal
            }
        });
    });
});

</script>