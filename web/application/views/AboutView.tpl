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
                                        <li>
                                            <a href="#api-documentation">Api Documentation</a>
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
                                <div class="typo-line" id="api-documentation">
                                    <p class="category">Api Documentation</p>
                                    <h5>The bank provides an v1.0 RESTful API using 2 HTTP verbs: GET and POST</h5>
                                </div><br>
                                <div class="typo-line">
                                    <p class="category">GET endpoint</p>
                                    <h5>GET/balance</h5>
                                </div><br>

                                <div class="typo-line" id="api-balance-request-parameters">
                                    <p class="category">Request parameters</p>
                                </div>

                                <div class="content table-responsive table-full-width">
                                    <table class="table table-striped">
                                        <thead>
                                        <th>Parameter name</th>
                                        <th>Type</th>
                                        <th>Example</th>
                                        <th>Description</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>requestId (mandatory)</td>
                                                <td>unique identifier string - UUID</td>
                                                <td>2da9a98c-4e87-4fe7-a4cb-842768118e09</td>
                                                <td>Communication id</td>
                                            </tr>

                                            <tr>
                                                <td>timestamp (mandatory)</td>
                                                <td>string</td>
                                                <td>2017-04-09 12:00</td>
                                                <td>Time of sending the request</td>
                                            </tr>

                                            <tr>
                                                <td>email (mandatory)</td>
                                                <td>string</td>
                                                <td>workshop@payu.ro</td>
                                                <td>User identifier</td>
                                            </tr>


                                            <tr>
                                                <td>token (mandatory)</td>
                                                <td>unique identifier string - UUID</td>
                                                <td>3af6b23j-4e87-4fe7-a4cb-842768118e09</td>
                                                <td>User token</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>


                                <div class="typo-line" id="api-balance-response-parameters">
                                    <p class="category">Response parameters</p>
                                </div>

                                <div class="content table-responsive table-full-width">
                                    <table class="table table-striped">
                                        <thead>
                                        <th>Response type</th>
                                        <th>meta.status (mandatory)</th>
                                        <th>meta.message (mandatory)</th>
                                        <th>userData.balance (optional)</th>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>SUCCESS</td>
                                            <td>Ok</td>
                                            <td>Operation successful</td>
                                            <td>Current balance of the user with email specified in request</td>
                                        </tr>

                                        <tr>
                                            <td>ERROR</td>
                                            <td>Error</td>
                                            <td>Error message</td>
                                            <td>will not be sent</td>
                                        </tr>

                                        </tbody>
                                    </table>

                                </div>

                                <div class="typo-line" id="api-balance-error-messages">
                                    <p class="category">Response messages</p>
                                </div>

                                <div class="content table-responsive table-full-width">
                                    <table class="table table-striped">
                                        <thead>
                                        <th>Http code</th>
                                        <th>Reason</th>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>200 SUCCESS </td>
                                            <td>Operation successful</td>
                                        </tr>

                                        <tr>
                                            <td>400 BAD REQUEST</td>
                                            <td>No user associated with the sent email</td>
                                        </tr>

                                        <tr>
                                            <td>400 BAD REQUEST</td>
                                            <td>No user associated with the sent token</td>
                                        </tr>

                                        <tr>
                                            <td>400 BAD REQUEST</td>
                                            <td>Authentication failed</td>
                                        </tr>


                                        <tr>
                                            <td>400 BAD REQUEST</td>
                                            <td>Parameter "nameOfTheParameter" is missing (where "nameOfTheParameter" is replaced with actual name of the parameter) </td>
                                        </tr>

                                        </tbody>
                                    </table>

                                </div>

                                <div class="typo-line">
                                    <p class="category">POST endpoint</p>
                                    <h5>POST/pay</h5>
                                </div><br>

                                <div class="typo-line" id="api-balance-request-parameters">
                                    <p class="category">Request parameters</p>
                                </div>

                                <div class="content table-responsive table-full-width">
                                    <table class="table table-striped">
                                        <thead>
                                        <th>Parameter name</th>
                                        <th>Type</th>
                                        <th>Example</th>
                                        <th>Description</th>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>requestId (mandatory)</td>
                                            <td>unique identifier string - UUID</td>
                                            <td>2da9a98c-4e87-4fe7-a4cb-842768118e09</td>
                                            <td>Communication id</td>
                                        </tr>

                                        <tr>
                                            <td>timestamp (mandatory)</td>
                                            <td>string</td>
                                            <td>2017-04-09 12:00</td>
                                            <td>Time of sending the request</td>
                                        </tr>

                                        <tr>
                                            <td>email (mandatory)</td>
                                            <td>string</td>
                                            <td>workshop@payu.ro</td>
                                            <td>User identifier</td>
                                        </tr>


                                        <tr>
                                            <td>token (mandatory)</td>
                                            <td>unique identifier string - UUID</td>
                                            <td>3af6b23j-4e87-4fe7-a4cb-842768118e09</td>
                                            <td>User token</td>
                                        </tr>


                                        <tr>
                                            <td>orderData.amount (mandatory)</td>
                                            <td>double</td>
                                            <td>12.32</td>
                                            <td>Amount of the order</td>
                                        </tr>


                                        <tr>
                                            <td>orderData.currency (mandatory)</td>
                                            <td>string</td>
                                            <td>RON</td>
                                            <td>Currency of the order</td>
                                        </tr>


                                        <tr>
                                            <td>orderData.reference (mandatory)</td>
                                            <td>string</td>
                                            <td>21343243</td>
                                            <td>Order identifier, generated by the store</td>
                                        </tr>

                                        </tbody>
                                    </table>

                                </div>


                                <div class="typo-line" id="api-balance-response-parameters">
                                    <p class="category">Response parameters</p>
                                </div>

                                <div class="content table-responsive table-full-width">
                                    <table class="table table-striped">
                                        <thead>
                                        <th>Response type</th>
                                        <th>meta.status (mandatory)</th>
                                        <th>meta.message (mandatory)</th>
                                        <th>orderData.reference (mandatory)</th>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>SUCCESS</td>
                                            <td>Ok</td>
                                            <td>Operation successful</td>
                                            <td>Order identifier, the one from request</td>
                                        </tr>

                                        <tr>
                                            <td>ERROR</td>
                                            <td>Error</td>
                                            <td>Error message</td>
                                            <td>Order identifier, the one from request</td>
                                        </tr>

                                        </tbody>
                                    </table>

                                </div>

                                <div class="typo-line" id="api-balance-error-messages">
                                    <p class="category">Response messages</p>
                                </div>

                                <div class="content table-responsive table-full-width">
                                    <table class="table table-striped">
                                        <thead>
                                        <th>Http code</th>
                                        <th>Reason</th>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>200 SUCCESS </td>
                                            <td>Operation successful</td>
                                        </tr>

                                        <tr>
                                            <td>400 BAD REQUEST</td>
                                            <td>No user associated with the sent email</td>
                                        </tr>

                                        <tr>
                                            <td>400 BAD REQUEST</td>
                                            <td>No user associated with the sent token</td>
                                        </tr>

                                        <tr>
                                            <td>400 BAD REQUEST</td>
                                            <td>Authentication failed</td>
                                        </tr>

                                        <tr>
                                            <td>400 BAD REQUEST</td>
                                            <td>Insufficient funds</td>
                                        </tr>


                                        <tr>
                                            <td>400 BAD REQUEST</td>
                                            <td>Currency not supported</td>
                                        </tr>

                                        </tbody>
                                    </table>

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
