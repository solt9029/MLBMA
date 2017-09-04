# 目的

LaravelとVueで大学図書館の本の貸出状況を確認することができる本管理アプリです

# 環境構築

## 使用したバージョン一覧

- docker-compose: 1.11.1

- docker: 1.13.1

- php: 5.6.28

- laravel: 5.4.23

- composer: 1.3.2

- node: 7.2.1

- npm: 4.0.5

## 手順

```
cd MLBMA
composer install
npm install
cp .env.example .env
php artisan key:generate
```

.envを編集します  
自分のTWITTER_CLIENT_ID・TWITTER_CLIENT_SECRET・CALLBACK_URLを入力してください  
docker-compose.ymlなどを変更する場合にはDBの設定なども見直してください

```
cd docker.mlbma
docker-compose up -d
docker exec -it dockermlbma_web_1
cd /var/www/html
php artisan migrate
```

これで準備完了です  
[http://docker.app:8005](url)にアクセスする