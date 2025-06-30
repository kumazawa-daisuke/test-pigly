# Pigly
## 環境構築
### Dockerビルド
1. git clone リンク
2. DockerDesktopアプリを立ち上げる
3. docker-compose up -d --build
### Laravel環境構築
1. docker-compose exec php bash
2. composer install
3. 「.env.example」ファイルを「.env」ファイルに命名を変更。または新しく.envファイルを作成
4. .envに以下の環境変数を追加

DB_CONNECTION=mysql  
DB_HOST=mysql  
DB_PORT=3306  
DB_DATABASE=laravel_db  
DB_USERNAME=laravel_user  
DB_PASSWORD=laravel_pass  

5.アプリケーションキーの作成  
php artisan key:generate  
6.マイグレーションの実行  
php artisan migrate  
7.シーディングの実行  
php artisan db:seed  

##サンプル用ログインアドレス・パスワード  
メールアドレス:test@example.com  
パスワード:password123

## 使用技術(実行環境)
・PHP7.4.9  
・Laravel8.83.8  
・MySQL8.0.26  

## ER図
![E-Rpigly](https://github.com/user-attachments/assets/8b81db12-411f-49ab-a1f1-daf24577d433)

## URL
・開発環境：http://localhost/
・phpMyAdmin:http://localhost:8080/
