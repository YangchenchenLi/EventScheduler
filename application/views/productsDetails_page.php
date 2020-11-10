
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <!-- Stripe JavaScript library -->
    <script src="https://js.stripe.com/v2/"></script>
    <!-- jQuery is used only for this example; it isn't required to use Stripe -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    // Set your publishable key
    Stripe.setPublishableKey('<?php echo $this->config->item('stripe_publishable_key'); ?>');

    // Callback to handle the response from stripe
    function stripeResponseHandler(status, response) {
        if (response.error) {
            // Enable the submit button
            $('#payBtn').removeAttr("disabled");
            // Display the errors on the form
            $(".card-errors").html('<p>'+response.error.message+'</p>');
        } else {
            var form$ = $("#paymentFrm");
            // Get token id
            var token = response.id;
            // Insert the token into the form
            form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
            // Submit form to the server
            form$.get(0).submit();
        }
    }

    $(document).ready(function() {
        // On form submit
        $("#paymentFrm").submit(function() {
            // Disable the submit button to prevent repeated clicks
            $('#payBtn').attr("disabled", "disabled");

            // Create single-use token to charge the user
            Stripe.createToken({
                number: $('#card_number').val(),
                exp_month: $('#card_exp_month').val(),
                exp_year: $('#card_exp_year').val(),
                cvc: $('#card_cvc').val()
            }, stripeResponseHandler);

            // Submit from callback
            return false;
        });
    });
</script>

<style type="text/css">
    body{
        background: url("https://cdn.pixabay.com/photo/2020/05/24/15/29/aircraft-5214695_1280.jpg");
    }
    .panel{
        width: 350px;
        height: 500px;
        background-color: rgba(255,255,255,0.6);
        margin: 40px auto;
        padding: 10px;
    }

    .panel-heading{
        background-color: rgba(255,255,255,0.6);
    }

</style>

</head>

<body>


<div class="collapse navbar-collapse">
    <h1>Membership</h1>
    <ul class="nav nav-tabs list-unstyled float-right">
        <!-- if user logged in, show logout button-->
        <?php if($this->session->userdata('logged_in')) : ?>
            <li class="nav-item">
                <a href="<?php echo base_url();?>Profile" style="color:black;">
                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                    <?php
                    echo $this->session->userdata('username');
                    ?>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>Login/logout"  style="color:black;">
                    <i class="fa fa-power-off" aria-hidden="true"></i>
                    Logout </a>
            </li>
        <?php endif; ?>

        <!-- if user didn't log in, show login button-->
        <?php if(!$this->session->userdata('logged_in') && (!$this->session->userdata('user_data'))) : ?>
            <li class="nav-item">
                <a href="<?php echo base_url(); ?>Login" style="color:black;">
                    <i class="fa fa-user fa-lg"></i>
                    Login
                </a>
            </li>
            &nbsp;
            <li class="nav-item">
                <a href="<?php echo base_url(); ?>Register" style="color:black;">
                    <i class="fa fa-user-plus" aria-hidden="true"></i>
                    Sign Up
                </a>
            </li>
        <?php endif; ?>

        <!--log in via Oauth with Google-->
        <?php if ($this->session->userdata('user_data')):?>
            <?php $user_data = $this->session->userdata('user_data');?>
            <li class="nav-item">
                <a href="<?php echo base_url();?>Profile" style="color:black;">
                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                    <?php
                    echo $user_data['username'];
                    ?>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>Login/logout"  style="color:black;">
                    <i class="fa fa-power-off" aria-hidden="true"></i>
                    Logout </a>
            </li>
        <?php endif; ?>
    </ul>
</div>

<!--Nav bar-->
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
    <a class="navbar-brand" href="#">Navbar</a>

    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url(); ?>home">Home &nbsp;&nbsp;</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url ();?>Calendar">
                    Calendar &nbsp;&nbsp;
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url();?>Scroll_pagination">&nbsp;&nbsp;Explore Event&nbsp;&nbsp;</a>
            </li>

            <!--if user logged in, show user profile link-->
            <?php if($this->session->userdata('logged_in')) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url();?>MultipleFile">Gallery &nbsp;</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url();?>Profile">User Profile &nbsp;&nbsp; </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo base_url();?>Products">Membership<span class="sr-only">(current)</span></a>
                </li>
            <?php endif; ?>
        </ul>
        <!--search event-->
        <div class="nav-item">
            <a class="nav-link float-right" href="<?php echo base_url();?>Ajaxsearch" role="button"> <i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search Event</a>
        </div>
    </div>
</nav>





<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title" style="font-size: 24px">Charge <?php echo '$'.$product['price']; ?> with Stripe</h3>

        <!-- Product Info -->
        <p><b>Item Name:</b> <?php echo $product['name']; ?></p>
        <p><b>Price:</b> <?php echo '$'.$product['price'].' '.$product['currency']; ?></p>
    </div>
    <div class="panel-body">
        <!-- Display errors returned by createToken -->
        <div class="card-errors"></div>

        <!-- Payment form -->
        <form action="" method="POST" id="paymentFrm">
            <div class="form-group">
                <label>NAME</label>
                <input style="width: 270px;" type="text" name="name" id="name" placeholder="Enter name" required="" autofocus="">
            </div>
            <div class="form-group">
                <label>EMAIL</label>
                <input style="width: 270px;" type="email" name="email" id="email" placeholder="Enter email" required="">
            </div>
            <div class="form-group">
                <label>CARD NUMBER</label>
                <input style="width: 200px;" type="text" name="card_number" id="card_number" placeholder="1234 1234 1234 1234" autocomplete="off" required="">
            </div>
            <div class="row">
                <div class="left col-8">
                    <div class="form-group">
                        <label>EXPIRY DATE</label>
                        <div class="row">
                            <div class="col-2">
                                <input style="width: 40px;" type="text" name="card_exp_month" id="card_exp_month" placeholder="MM" required="">
                            </div>
                            &nbsp;  &nbsp;
                            <div class="col-4">
                                <input style="width: 80px;" type="text" name="card_exp_year" id="card_exp_year" placeholder="YYYY" required="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="right col-4">
                    <div class="form-group">
                        <label>CVC CODE</label>
                        <div class="row">
                        <input  class="col-9" type="text" name="card_cvc" id="card_cvc" placeholder="CVC" autocomplete="off" required="">
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
            <button type="submit" class="btn btn-success btn-lg btn-block" id="payBtn">Submit Payment</button>
        </form>
    </div>
</div>


