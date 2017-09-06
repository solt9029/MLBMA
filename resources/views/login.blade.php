<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>MLBMA</title>
    <link rel="shortcut icon" href="/img/logo.png"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="apple-touch-icon" href="/img/home.jpg" />
    <link rel="stylesheet" href="/css/login.css">
</head>
<body>
    <div id="app" class="section">
        <h1 class="title">MLBMA</h1>
        <div class="description">
            <p>Meiji Library Books Management Application.</p>
            <p>明治大学図書館（中野キャンパス）の書籍の貸出状況を確認できる書籍管理アプリケーション。</p>
        </div>
        <a href="/auth/twitter" class="btn">Twitterでログイン</a>
    </div>
    <script src="/js/app.js"></script>
</body>
</html>