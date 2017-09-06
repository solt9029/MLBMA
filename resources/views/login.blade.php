<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>MLBMA</title>
    <link rel="shortcut icon" href="/img/logo.png"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="apple-touch-icon" href="/img/home.jpg" />
      <style>
html {
    height: 100%;
}
body {
    background:linear-gradient(45deg,rgba(100,100,30,0.7), rgba(80,80,20, 0.7)), url(http://uru-lab.com/wp-content/uploads/2015/02/%E6%9C%AC.png);
    background-position: center center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
    background-color: #464646;
    text-align: center;
    color: #fff;
    width: 100%;
    height: 100%;
    display: table;
}
.btn{
    font-size: 24px;
    width:300px;
    margin-top:50px;
    border: 1px solid #cafaea;
    color: #cafaea;
    border-radius: 3px;
    font-weight: 700;
    line-height: normal;
    text-decoration: none;
    text-align: center;
}
h1 {
    font-size: 100px;
}
section {
    display: table-cell;
    vertical-align: middle;
}
.description {
    margin-top: 50px;
    font-size: 20px;
}
    </style>
</head>
<body>
    <section>
        <h1>MLBMA</h1>
        <div class="description">
            <p>Meiji Library Books Management Application.</p>
            <p>明治大学図書館（中野キャンパス）の書籍の貸出状況を確認できる書籍管理アプリケーション。</p>
        </div>
        <a href="/auth/twitter" class="btn">Twitterでログイン</a>
    </section>
    <script src="/js/app.js"></script>
</body>
</html>