# 飲食店予約アプリ  
店舗情報の一覧と予約管理機能
![スクリーンショット 2024-07-13 225623](https://github.com/user-attachments/assets/1803c306-ae16-4291-a053-f7f55dcb163c)


## ログインテスト用アカウント  
メールアドレス  user@user.user  
パスワード  password

## 機能一覧
### 基本機能
- ログイン機能
- 会員登録
- 店舗一覧  
店舗一覧　検索機能　レビュー表示
- 店舗詳細  
店舗の詳細と予約登録
- 店舗詳細情報  
ユーザーによる予約機能  
- マイページ  
予約変更機能　 お気に入り店舗一覧　レビューの投稿  
### 追加機能
**１　店舗代表者向け機能**  

ログインテスト用アカウント  
メールアドレス  shop@shop.shop  
パスワード  password  
url http://localhost/shopadmin/login

- 店舗情報更新  
店舗情報の更新
- 予約一覧  
予約の一覧  
- メール送信   
お気に入りユーザーに一斉メールを送信　
リマインダーメール（予約当日の10時に送信）

**2　管理者向け機能**  

ログインテスト用アカウント  
メールアドレス  admin@admin.admin  
パスワード  password  
URl http://localhost/admin/login

- 店舗情報登録  
店舗情報の基礎情報の登録
- 予約一覧  
店舗代表者の登録


## 使用技術  
- PHP8.3.0
- Laravel8.83.27
- MySQL8.0.26

## テーブル設計  
![table](https://github.com/user-attachments/assets/3652d6a8-e9ba-4db5-9df6-b73c01426277)


## ER図
![case2](https://github.com/user-attachments/assets/939cb2a5-18e7-46c1-ad09-51f2a5c7f96c)




## 環境構築
  ### Dockerビルド  
  1.git@github.com:soboro7728/case2.git  
  2.DockerDesktopアプリを立ち上げる  
  3.docker-compose up -d --build  
  ### Laravel環境構築
   1.docker-compose exec php bash  
   2.composer install  
   3.「.env.example」ファイルを 「.env」ファイルに命名を変更。または、新しく.envファイルを作成  
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
