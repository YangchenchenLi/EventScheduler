<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Search Event</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
              integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />

    </head>

    <body>
    <?php

    session_start();

    if (isset($_SESSION['views'])){
        $_SESSION['views'] =  $_SESSION['views'] + 1;
    }else{
        $_SESSION['views'] = 1;
    }
    echo "Views=". $_SESSION['views']."</br>";


    if (isset($_SESSION['views2'])){
        $_SESSION['views2'] =  $_SESSION['views2'] + 1;
    }else{
        $_SESSION['views2'] = 1;
    }
    echo "Views2=". $_SESSION['views2']."</br>";
    ?>

    </body>
</html>