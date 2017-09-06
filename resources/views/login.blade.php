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
    /* 画像ファイルの指定 */
    background:linear-gradient(45deg,rgba(100,100,30,0.7), rgba(80,80,20, 0.7)), url(http://uru-lab.com/wp-content/uploads/2015/02/%E6%9C%AC.png);
    /* 画像を常に天地左右の中央に配置 */
    background-position: center center;
    /* 画像をタイル状に繰り返し表示しない */
    background-repeat: no-repeat;
    /* コンテンツの高さが画像の高さより大きい時、動かないように固定 */
    background-attachment: fixed;
    /* 表示するコンテナの大きさに基づいて、背景画像を調整 */
    background-size: cover;
    /* 背景画像が読み込まれる前に表示される背景のカラー */
    background-color: #464646;

    text-align: center;
    color: #fff;
    width: 100%;
    height: 100%;
    display: table;
}
.btn{
    width:180px;
    margin:15px;
}
h1 {
    font-size: 70px;
}
section {
    display: table-cell;
    vertical-align: middle;
}
    </style>
</head>
<body>
    <section>
        <h1>MLBMA</h1>
        <a href="/auth/twitter" class="btn btn-info btn-lg">Twitterでログイン</a>
    </section>
    <script src="/js/app.js"></script>
</body>
</html>