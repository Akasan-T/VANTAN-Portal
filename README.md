# VANTAN-Portal

## 概要
**VANTANのPortalシステム**を作成するプロジェクトです。最終的には、各種書類申請や本の貸し出しなど、みんなで作った機能の基盤となるポータルを目指します。

## 技術スタック
- **Backend**: Laravel 12 / PHP（Filament v5）
- **Frontend**: React + Vite
- **DB**: MySQL（`docker-compose.yml`）

## ディレクトリ構成
- **`backend/`**: Laravel アプリ（管理画面・API 等）
- **`frontend/`**: React アプリ
- **`docker-compose.yml`**: 開発用コンテナ（Laravel / Frontend / MySQL）

## 起動方法（Docker 推奨）
### 前提
- Docker Desktop が起動していること

### 1) 起動（初回は build あり）
```bash
docker compose build
docker compose up -d
```

### 2) Laravel 初期化（初回のみ）
```bash
docker compose exec laravel bash -lc "cd /var/www/html && composer install"
docker compose exec laravel bash -lc "cd /var/www/html && cp -n .env.docker.example .env || true"
docker compose exec laravel bash -lc "cd /var/www/html && php artisan key:generate"
docker compose exec laravel bash -lc "cd /var/www/html && php artisan migrate"
```

※ シーダーがある場合は、最後を `php artisan migrate --seed` にしてください。

### 3) アクセス先
- **Laravel**: `http://localhost:8000`
- **React (Vite)**: `http://localhost:5173`

## 起動方法（ローカル）
### Backend（Laravel）
```bash
cd backend
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

### Frontend（React）
```bash
cd frontend
npm install
npm run dev
```

## よくある詰まりポイント
### DB 設定（sqlite と MySQL のズレ）
`backend/.env.example` はデフォルトで `DB_CONNECTION=sqlite` になっていますが、`docker-compose.yml` では MySQL を立てます。  
Docker で動かす場合は `backend/.env.docker.example` を `backend/.env` として使う前提です。

## 補足
- `backend/README.md` と `frontend/README.md` は雛形のままなので、基本はこのルート README の手順に従ってください。