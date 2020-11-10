

    <title>File Upload</title>

    <!-- Dropzone CSS & JS -->
    <link rel="stylesheet" type='text/css' href="<?php echo base_url();?>resources/css/dropzone.css">
    <script type="text/javascript" href="<?php echo base_url(); ?>resources/js/dropzone.js"></script>

    <!-- Dropzone CDN -->
    <link href='https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.css' type='text/css' rel='stylesheet'>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js' type='text/javascript'></script>


    <style type="text/css">

        body{
            margin: 10px 10px 10px 10px;
            background: url(https://cdn.pixabay.com/photo/2019/05/19/23/47/clouds-4215608_1280.jpg) no-repeat;
            background-size:cover;
            height:100%;
        }
        .input-group{
            margin:0 auto;
        }

        form{
            margin: 10px auto;
            border: #2f2f2f 2px solid;

        }

        h2{
            display: block;
            text-align: center;
            margin-top:50px ;
        }
        .upload{
            padding: 10px;
        }

        .content{
            width: 960px;
            padding: 5px;
            margin: 100px auto;
            background-color: rgba(255,255,255,0.2);
        }
        .content span{
            width: 250px;
        }
        .dz-message{
            text-align: center;
            font-size: 28px;
        }

        .content form{
            width: 500px;
        }

        .success{
            background-color: #2cc36b;
            color: white;
        }

        .usage{
            display: block;
            width: 100%;
            background-color: #2e8ece;
            color: white;
        }

    </style>


    <script type="text/javascript">
        window.onload = function () {
            var btn = document.getElementById('watermark');
            var form = document.getElementById('form');
            var submit = document.getElementById('submit');
            btn.onclick = function () {
                var input = document.createElement("input");
                input.type = "text";
                input.name = "text";
                input.placeholder = "text for watermark";
                input.maxlength = 50;
                form.insertBefore(input, submit);
            };
        };
        // drag and drop
        // Add restrictions
        Dropzone.options.fileupload = {
            acceptedFiles: 'image/*',
            maxFilesize: 5 // MB
        };


    </script>
</head>
<body>

<h2>Upload your profile image</h2>

<?php echo $error;?>


<div class='content'>
    <!-- Dropzone -->
    <form action="<?= base_url();?>Upload/do_upload" class="dropzone" id="fileupload">
    </form>
    <P>-----------------------------------------------------------------------------------------------------------------------------------</P>
    <div class="input-group">
<!--        'class="dropzone" id="fileupload"'-->
        <?php echo form_open_multipart('Upload/do_upload');?>
            <div class="upload" id="form">
                <input type='file'  name='userfile' size='20' /><br><br>

                <!-- add watermark image-->
                <?php if($wm != '') : ?>
                    <p class="success"><?php echo $success?></p>
                    <img id="profile_img" src="<?php echo $wm['watermark_img'];?>" alt = "upload image"/>
                <?php endif; ?>
                <!--add image without watermark-->
                <?php if($no_wm != '') : ?>
                    <p class="success"><?php echo $success?></p>
                    <img id="profile_img" src="<?php echo base_url();?>uploads/<?php echo $upload_data['file_name'];?>" alt = "upload image"/>
                <?php endif; ?>
                <br> <br>
                <input id="watermark" type="radio" name="watermark" value="watermark"/>add watermark
                <br><br>
                <input class="btn-primary" id="submit" type='submit'  name='submit' value='upload' />
            </div>
        <?php echo "</form>"?>
    </div>


    <?php if($success != '') : ?>
        <form action="<?= base_url();?>Profile/addFile" method="post">

            <input class="usage" type="submit" class="btn" value="Use this image as profile image.">


            <?php if($no_wm != '') : ?>
                <input type="hidden" name="upload_uid" value="<?php echo $uid; ?>"/>
                <input type="hidden" name="img_no_wa" value="<?php echo $upload_data['file_name']; ?>"/>
            <?php endif; ?>

            <?php if($wm != '') : ?>
                <input type="hidden" name="upload_uid" value="<?php echo $uid; ?>"/>
                <input type="hidden" name="img_wm" value="<?php echo $wm['watermark_image']; ?>"/>
            <?php endif; ?>
        </form>
    <?php endif; ?>

</div>
<!--button back to homepage-->
<a class="btn btn-primary float-right" href="<?php echo base_url ();?>Profile">Back</a>





