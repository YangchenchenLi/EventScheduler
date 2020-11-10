<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>

    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/solid.css">

        <title>User Profile</title>

        <style type="text/css">
            *{
                margin:0;
                padding:0;
            }
            body{
                margin: 10px 10px 10px 10px;
                background: url(https://cdn.pixabay.com/photo/2019/05/19/23/47/clouds-4215608_1280.jpg) no-repeat;
                background-size:cover;
                height:100%;           
            }


            p{
                color: white;
                display:block;
                text-align:center;
            }

            .table{
                width: 960px;
                margin: 50px auto;
                background-color: rgba(255,255,255,0.2);
                text-align: center;
            }

            .change{
                color:purple;
            }

            .change:hover{
                cursor: pointer;
                text-decoration: underline;
            }

            #profile_img{
                display: block;
                width: 100px;
                height: 100px;
                border-radius:50%;
                margin: 0 auto;
            }
            #profile_a{
                display: block;
               text-align: center;
                color: purple;
            }
        </style>

        <script type="text/javascript">
            $(document).ready(function () {

                $('.content').click(function () {
                    //get the id name of each td
                    id = $(this).attr('id');
                    // if there is on input filed, add input filed.
                    if (typeof ($(this).find('.new_input').val()) === "undefined"
                            // user can't change username and email and birthday input should be date format.
                        && ($(this).attr('id') !== "username" && $(this).attr('id') !== "email" && $(this).attr('id') !== "birthday")){
                        // create an input filed
                        new_input = "<input type='text' class='new_input' name = '"+id+"''>";
                        // append input filed
                        $(this).append(new_input);
                        // get the previous content
                        content = $(this).text();
                        // put the previous content into the input filed
                        $(this).find('.new_input').val(content.trim());

                        // remove the provious one
                        $(this).find('.pre_content').remove();

                    }

                    if (typeof ($(this).find('.new_input').val()) === "undefined"
                        // birthday input should be date format.
                        && $(this).attr('id') === "birthday"){
                        // create an input filed
                        new_input = "<input type='date' class='new_input' name = '"+id+"''>";
                        // append input filed
                        $(this).append(new_input);
                        // get the previous content
                        content = $(this).text();
                        // put the previous content into the input filed
                        $(this).find('.new_input').val(content.trim());
                        // remove the provious one
                        $(this).find('.pre_content').remove();
                    }
                });

            });
        </script>

    </head>

    <body>

    <div class="collapse navbar-collapse">
        <h1>User Profile</h1>
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
                        <a class="nav-link active" href="<?php echo base_url();?>Profile">User Profile &nbsp;&nbsp; </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url();?>Products">Membership<span class="sr-only">(current)</span></a>
                    </li>
                <?php endif; ?>
            </ul>
            <!--search event-->
            <div class="nav-item">
                <a class="nav-link float-right" href="<?php echo base_url();?>Ajaxsearch" role="button"> <i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search Event</a>
            </div>
        </div>
    </nav>





        <p>(Username and Email can't be changed)</p>

        <!-- if no uploaded file, use default-->
        <?php if($profile_img === '' || !file_exists('uploads/'.$profile_img)): ?>
            <div class="profile">
                <img id="profile_img" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" alt="profile"/>
            </div>
        <?php endif; ?>

        <!--if uploaded, use new file-->
        <?php if($profile_img !== '' && file_exists('uploads/'.$profile_img)): ?>
                <img id="profile_img" src="uploads/<?php echo $profile_img;?>"
                     alt="no water mark profile"/>
        <?php endif; ?>

        <a id="profile_a" href="<?php echo base_url();?>Upload"> (change profile) </a>


        <?php if($this->session->userdata('logged_in')) : ?>
        <form action="<?php echo base_url();?>Profile/changeProfile" method="post">
            <table class="table">
                <tbody>
                <tr>
                    <td>User Name</td>
                    <td class="content" id="username">
                        <?php echo $username;?>
                    </td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td class="content" id="email">
                        <?php echo $email;?>
                    </td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td class="content change" id="phone" title="click to change">
                        <span class="pre_content"><?php echo $phone;?></span>
                    </td>
                </tr>

                <tr>
                    <td>Resident Address</td>
                    <td class="content change" id="address" title="click to change">
                        <span class="pre_content"><?php echo $address;?></span>
                    </td>
                </tr>

                <tr>
                    <td>Birthday</td>
                    <td class="content change" id="birthday" title="click to change">
                        <span class="pre_content"><?php echo $birthday;?></span>
                    </td>
                </tr>

                <tr>
                    <td>

                    </td>
                    <td>
                        <input type = "submit" class="btn btn-outline-success float-right btn-light" id="save" value = "save"/>
                    </td>

                </tr>

                </tbody>

            </table>
        </form>
        <?php endif; ?>


        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script type="text/javascript" href="<?php echo base_url(); ?>resources/js/jquery.js"></script>
        <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous">
        </script>
    </body>
</html>