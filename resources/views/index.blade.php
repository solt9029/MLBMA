<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>MLBMA</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="css/app.css"/>
</head>
<body>
    <div id="app">
        <router-view></router-view>
    </div>
    <script src="js/app.js"></script>
</body>
</html>