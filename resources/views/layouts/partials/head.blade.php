<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title>Mark's URG Shopiify Portal</title>

    <BASE href="http://{!! $_SERVER['HTTP_HOST'] !!}/">

    <meta id="token" name="token" value="{!! csrf_token() !!}" />

    <!-- CSS -->
    <!<link rel="stylesheet" href="css/libraries.css"/>
    <link rel="stylesheet" href="css/foundation.css"/>
    <link rel="stylesheet" href="css/app.css"/>


    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,300italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
    @yield('styles')
    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

</head>