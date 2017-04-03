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
            <ul class="nav">
                <li class="active">
                    <a href="#">
                        <i class="ti-user"></i>
                        <p>User Profile</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active">
                        <a href="{site_url('Logout')}">
                            <i class="ti-close"></i>
                            <p><b>Logout</b></p>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-3">
                        <div class="card card-user">
                            <div class="image">
                                <img src="../../bankAssets/img/card.jpg" alt="..."/>
                            </div>
                            <div class="author">
                                <img class="avatar border-white" src="../../bankAssets/img/faces/user.png" alt="..."/>
                                <h4 class="title">{$username}<br/>
                                </h4>
                            </div>
                            <br>
                            <hr>
                            <div class="text-center">
                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1">
                                        <h5>{$noOfCreditCards}<br/>
                                            <small>Card</small>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-success text-center">
                                            <i class="ti-wallet"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>Total Sold</p>
                                            {$totalSold}
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr>
                                    <div class="stats">
                                        Currency: {$soldCurrency}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-7">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Credit Card</h4>
                            </div>
                            <div class="content">
                                {form_open(base_url('UserAccount/addCreditCard'))}
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <label>Card number</label>
                                            <input type="text" class="form-control border-input" placeholder="Card No" id="cardno" name="cardno" value="{if $noOfCreditCards != 0}{$cardData['CardNumber']}{/if}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Expiration Month</label>
                                            <input type="text" class="form-control border-input" placeholder="Expiration Month" id="expirationMonth"
                                                   name="expirationMonth" value="{if $noOfCreditCards != 0}{$cardData['ExpirationMonth']}{/if}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Expiration Year</label>
                                            <input type="text" class="form-control border-input" placeholder="Expiration Year" id="expirationYear"
                                                   name="expirationYear" value="{if $noOfCreditCards != 0}{$cardData['ExpirationYear']}{/if}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Cvv</label>
                                            <input type="text" class="form-control border-input" placeholder="Cvv" id="cvv" name="cvv" value="{if $noOfCreditCards != 0}{$cardData['Cvv']}{/if}">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-info btn-fill btn-wd">{if $noOfCreditCards == 0}Add credit card{else}Update card data{/if}
                                    </button>
                                </div>
                                <div class="clearfix"></div>
                                {form_close()}
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
