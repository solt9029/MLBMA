<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>MLBMA</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="css/app.css"/>
</head>
<body>
    <div class="container">
        <h4>Your name is {{ Auth::user()->name }} </h4>
        <h4>Your twitter handle is {{ Auth::user()->handle }} </h4>
        <img src="{{ Auth::user()->avatar }}" height="200" width="200" />
        <a href="/auth/twitter/logout" role="button">Logout</a>
    </div>
    <div id="app" class="container">
        <router-view></router-view>
    </div>
    <script src="js/app.js"></script>
</body>
</html>