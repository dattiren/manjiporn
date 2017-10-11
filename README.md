# MANJIPorn

## Version
Laravel v5.5.14 (stable at 2017/10/09)

## 2017/10/12
データベース設定

### DBコネクション設定
.env.exampleを.envにコピー

```
cp .env.example .env
```

.envの下記部分を自分のDB用に変更

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=manjiporn
DB_USERNAME=root
#DB_PASSWORD=secret
```

### マイグレーション
マイグレーション前にデータベースを先に作成しておく！  
manjiporn直下で下記コマンドを実行しテーブルを作成  
php artisanコマンドはmanjiporn直下じゃなきゃ動かないよ

```
php artisan migrate
```
