# 飲食店予約アプリ  
店舗情報の一覧と予約管理機能
![image](https://github.com/soboro7728/case1/assets/49304045/03ba43a2-e935-450f-bb54-8485a9d5690c)

## ログインテスト用アカウント  
メールアドレス  user@user.user  
パスワード  password

## 機能一覧
- ログイン機能
- 会員登録
- 店舗一覧
  
- 店舗詳細
店舗詳細情報　ユーザーによる予約機能  
- マイページ　　
予約変更機能　 お気に入り店舗一覧
**１　出勤は一日に1回のみです。**  
**２　日を跨いだ時点で翌日の出勤動作に切り替わります。**  
**３　休憩は1日に何度でも可能です。**  
- 日付別勤怠情報取得  
**１ページあたりの表示件数は５件です。**

## 使用技術  
- PHP8.3.0
- Laravel8.83.27
- MySQL8.0.26

## テーブル設計  
![スクリーンショット 2024-04-01 041031](https://github.com/soboro7728/case1/assets/49304045/093ed5ba-bc2e-4c19-bda3-91f9db16b245)


## ER図
![スクリーンショット 2024-04-01 041742](https://github.com/soboro7728/case1/assets/49304045/efc5f22e-cc1a-45b0-97c1-98458b34c17d)



## 環境構築
  ### Dockerビルド  
  1.git@github.com:soboro7728/case1.git  
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
   
    php artisan migrate  
  
