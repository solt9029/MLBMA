<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>MLBMA</title>
    <link rel="shortcut icon" href="/img/favicon.jpg"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="css/app.css"/>
</head>
<body>
    <div id="app">
        <a href="/auth/twitter" role="button">Login with Twitter</a>
    </div>
    <script src="js/app.js"></script>
</body>
</html>