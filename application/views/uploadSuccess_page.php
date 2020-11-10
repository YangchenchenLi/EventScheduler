<title>Success Message</title>


<style type="text/css">
    *{
        margin:0;
        padding:0;
    }
    body{
        background: url(https://cdn.pixabay.com/photo/2019/05/19/23/47/clouds-4215608_1280.jpg) no-repeat;
        background-size:cover;
        height:100%;
    }

    h3{
        display: block;
        text-align: center;
        margin-top:50px ;
        background-color: #2cc36b;
    }

    ul{
        background-color: rgba(255,255,255,0.2);
    }

    li{
        display: block;
        text-align: center;
    }

    p{
        display: block;
        text-align: center;
    }

    #profile_img{
        display: block;
        margin: 0 auto;
    }

    img{
        background-color: rgba(255,255,255,0.2);
    }


</style>
</head>
<body>



<form action="<?= base_url();?>Profile/addFile" method="post">
    <input type="submit" class="btn" value="Use this image as profile image.">

    <?php if($no_wm != '') : ?>
        <input type="hidden" name="upload_uid" value="<?php echo $uid; ?>"/>
        <input type="hidden" name="img_no_wa" value="<?php echo $upload_data['file_name']; ?>"/>
    <?php endif; ?>

    <?php if($wm != '') : ?>
        <input type="hidden" name="upload_uid" value="<?php echo $uid; ?>"/>
        <input type="hidden" name="img_wm" value="<?php echo $wm['watermark_image']; ?>"/>
    <?php endif; ?>
</form>





<p><?php echo anchor('Profile', 'Back to Profile'); ?></p>


