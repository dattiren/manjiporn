# MANJIPorn

## Version
Laravel v5.5.14 (stable at 2017/10/09)

## 2017/10/22

## Usage
1. mysqlへログイン  
`mysql -u root -psecret`

2. データベースの作成  
`create database manjiporn;`

3. .env.exampleから.envを作成  
`cp .env.example .env`

4. .envを自分のDB用に変更(DBコネクション設定を参考に)

4. autoload.phpの作成  
`composer install`

5. App_keyの生成  
`php artisan key:generate`

6. マイグレーション  
`php artisan migrate`

7. 起動  
`php artisan serve`


### DBコネクション設定
.envの下記部分を自分のDB用に変更

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=manjiporn
DB_USERNAME=root
#DB_PASSWORD=secret
```

### 注意事項

php artisanコマンドは**manjiporn直下**じゃなきゃ動かないよ

