<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Search Event</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
              integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />

        <style type="text/css">
            body{
                margin: 10px 10px 10px 10px;
                background: url(https://cdn.pixabay.com/photo/2019/05/19/23/47/clouds-4215608_1280.jpg) no-repeat;
                background-size:cover;
            }

            .container{

                background-color: rgba(255,255,255,0.2);
            }

        </style>
        <script>
            $(document).ready(function () {
                load_data();

                function load_data(query) {
                    $.ajax({
                        url:"<?php echo base_url();?>Ajaxsearch/fetch",
                        method:"POST",
                        data:{
                            query: query
                        },
                        success:function (data) {
                            $('#result').html(data);
                        }
                    })
                }

                $('#search_text').keyup(function () {
                    var search = $(this).val();

                    if(search != ''){
                        load_data(search);
                    }else {
                        load_data();
                    }
                });
            });

        </script>
    </head>

    <body>
        <div class="container">
            <br />
            <br />
            <br />
            <h2 align="center">Search Event</h2><br />
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Search</span>
                    <input type="text" name="search_text" id="search_text" placeholder="Search by Event Details" class="form-control" />
                </div>
            </div>
            <br />
            <div id="result"></div>
        </div>
        <div style="clear:both"></div>
        <br />
        <br />
        <br />
        <br />
        <div>
            <a href="<?php echo base_url ();?>home" class="btn btn-lg btn-primary float-right" role="button">
                Back
            </a>
        </div>
    </body>
</html>

