<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Shop Homepage - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->

    <!-- Custom CSS -->
    <link href="css/shop-homepage.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <header>
    <nav id="header-nav" class="navbar navbar-default">
<?php 
if (isset($_SESSION['username'])) {
    $user = $_SESSION['username'];
    $query = query("SELECT * FROM users WHERE username = '$user' ");
    confirm($query);
    $row = fetch_array($query);
    if ($row['category']=="Admin") {
        require(TEMPLATE_FRONT . DS . "admin_top.php");
    }
    else{
        require(TEMPLATE_FRONT . DS . "top_nav.php");
    }

}
else{
    require(TEMPLATE_FRONT . DS . "default_top.php");
}
?>
   

    
        
    </nav>
   </header>