<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>Sample Bank</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>

    <!-- Bootstrap core CSS     -->
    <link href="../../bankAssets/css/bootstrap.min.css" rel="stylesheet"/>

    <!-- Animation library for notifications   -->
    <link href="../../bankAssets/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="../../bankAssets/css/paper-dashboard.css" rel="stylesheet"/>

    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="../../bankAssets/css/themify-icons.css" rel="stylesheet">

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-background-color="white" data-active-color="danger">
        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="#" class="simple-text">
                    Sample Bank
                </a>
            </div>
        </div>
    </div>
    <div class="main-panel-about">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active">
                        <a href="{site_url('Register')}" class="navbar-brand">
                            <i class="ti-lock"></i>
                            <p >Register</p>
                        </a>
                    </li>
                    <li class="active">
                        <a href="{site_url('Login')}" class="navbar-brand">
                            <i class="ti-user"></i>
                            <p>Login</p>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="about-content">

                                <div class="typo-line">
                                    <h1>Welcome to Sample Bank</h1><br><br>
                                </div>
                                <div class="typo-line a-about">
                                    <p class="category">Summary</p>
                                    <ul>
                                        <li>
                                            <a href="#about">About</a>
                                        </li>
                                        <li>
                                            <a href="#how-does-it-work">How does it work</a>
                                        </li>
                                    </ul>
                                </div><br>
                                <div class="typo-line" id="about">
                                    <p class="category">About</p>
                                    <h5>On this platform you can check your credit card information and balance.</h5>
                                </div><br>
                                    <div class="typo-line" id="how-does-it-work">
                                        <p class="category">How does it work?</p>
                                        <ul>
                                            <li>
                                                <h5>Sign up using the registration form. After the form is submitted, you can log in your bank account.</h5>
                                            </li>
                                            <li>
                                                <h5>After signing in, the user can add the card data: card number, expiration month and day and cvv. For didactic purposes, you can update your card data.</h5>
                                            </li>
                                            <li>
                                                <h5>The communication between the Sample Store and the Sample Bank is made through an API.</h5>
                                            </li>
                                        </ul>
                                    </div><br>


                                <div class="typo-line">
                                    <p class="category">Muted Text</p>
                                    <p class="text-muted">
                                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet.
                                    </p>
                                </div>
                                <div class="typo-line">
                                    <!--
                                     there are also "text-info", "text-success", "text-warning", "text-danger" clases for the text
                                     -->
                                    <p class="category">Coloured Text</p>
                                    <p class="text-primary">
                                        Text Primary - Light Bootstrap Table Heading and complex bootstrap dashboard you've ever seen on the internet.
                                    </p>
                                    <p class="text-info">
                                        Text Info - Light Bootstrap Table Heading and complex bootstrap dashboard you've ever seen on the internet.
                                    </p>
                                    <p class="text-success">
                                        Text Success - Light Bootstrap Table Heading and complex bootstrap dashboard you've ever seen on the internet.
                                    </p>
                                    <p class="text-warning">
                                        Text Warning - Light Bootstrap Table Heading and complex bootstrap dashboard you've ever seen on the internet.
                                    </p>
                                    <p class="text-danger">
                                        Text Danger - Light Bootstrap Table Heading and complex bootstrap dashboard you've ever seen on the internet.
                                    </p>
                                </div>

                                <div class="typo-line">
                                    <h2><p class="category">Small Tag</p>Header with small subtitle <br><small>".small" is a tag for the headers</small> </h2>
                                </div>


                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


</body>

<!--   Core JS Files   -->
<script src="../../bankAssets/js/jquery-1.10.2.js" type="text/javascript"></script>
<script src="../../bankAssets/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Notifications Plugin    -->
<script src="../../bankAssets/js/bootstrap-notify.js"></script>

</html>
