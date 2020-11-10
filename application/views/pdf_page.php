
<style type="text/css">
    h1{
        text-align: center;
    }

    .name{
        margin-left: 550px;
    }

</style>


</head>

<body>

<div class="main">
    <?php if(!empty($order)){ ?>
        <!-- Display transaction status -->
        <?php if($order['payment_status'] == 'succeeded'){ ?>
            <h1 class="success">Payment Receipt</h1>
            <p>--------------------------------------------------------------------------------------------------------------------------------------</p>
        <?php }else{ ?>
            <h1 class="error">The transaction was successful! But your payment has been failed!</h1>
        <?php } ?>

        <br>
        <h3>Payment Information</h3>
        <p><b>Reference Number:</b> <?php echo $order['id']; ?></p>
        <p><b>Transaction ID:</b> <?php echo $order['txn_id']; ?></p>
        <p><b>Paid Amount:</b> AU&#36; <?php echo $order['paid_amount']; ?></p>
        <p><b>Payment Status:</b> <?php echo $order['payment_status']; ?></p>

        <br>
        <h3>Product Information</h3>
        <p><b>Name:</b> <?php echo $order['product_name']; ?></p>
        <p><b>Price:</b> AU&#36; <?php echo $order['product_price']; ?></p>
    <?php }else{ ?>
        <h1 class="error">The transaction has failed</h1>
    <?php } ?>

    <br><br><br><br><br><br>
    <p class="name">Event Scheduler &trade;</p>
</div>