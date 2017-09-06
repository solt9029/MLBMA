<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>MLBMA</title>
    <link rel="shortcut icon" href="/img/logo.png"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" href="/img/home.jpg" />
      <style>
    body {
  /* 画像ファイルの指定 */
  background-image: url(http://uru-lab.com/wp-content/uploads/2015/02/%E6%9C%AC.png);
   
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
}
  </style>
</head>
<body>
    <a href="/auth/twitter">login</a>
</body>
</html>