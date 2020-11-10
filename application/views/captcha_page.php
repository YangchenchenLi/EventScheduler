
<title>Captcha Page</title>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- captcha refresh code -->
<script>
    $(document).ready(function(){
        $('.refreshCaptcha').on('click', function(){
            $.get('<?php echo base_url().'captcha/refresh'; ?>', function(data){
                $('#captImg').html(data);
            });
        });
    });
</script>
</head>

<body>
    <div>
        <p id="captImg"><?php echo $captchaImg; ?></p>
        <p>Can't read the image? click <a href="javascript:void(0);" class="refreshCaptcha">here</a> to refresh.</p>
        <form action="<?php echo base_url();?>Captcha" method="post">
            Enter the code :
            <input type="text" name="captcha" placeholder="Case Sensitive" value=""/>
            <input type="submit" name="submit" value="CHECK"/>
        </form>
    </div>