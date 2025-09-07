# Laravel-test-MOGITATE

## 環境構築
**Dockerビルド**
1. `git clone <リポジトリURL>`
2. DockerDesktopを起動
3. `docker-compose up -d --build`

**Laravel環境構築**
1. `docker-compose exec php bash`
2. `composer install`
3. `.env.example` を `.env` にリネーム、または新しく `.env` 作成
4. .envに以下の環境変数を追加
--text
  DB_CONNECTION=mysql
  DB_HOST=mysql
  DB_PORT=3306
  DB_DATABASE=laravel_db
  DB_USERNAME=laravel_user
  DB_PASSWORD=laravel_pass

5. アプリケーションキーの作成
--bash
php artisan key:generate

6. マイグレーションの実行
--bash
php artisan migrate

7. シーディングの実行
--bash
php artisan db:seed

8. ストレージングの作成
php artisan storage:link


## 使用技術(実行環境)
- PHP8.1.3
- Laravel8.83.29
- MySQL8.0.26

## ER図
![alt](src/mogitate.png)

## URL
- 開発環境：http://localhost/products
- phpMyAdmin:：http://localhost:8080/