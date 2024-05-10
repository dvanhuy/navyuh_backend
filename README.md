cách chạy

vao laradock

docker-compose up -d nginx mysql phpmyadmin redis workspace redis-webui

docker compose exec --user=laradock workspace bash

composer i

npx laravel-echo-server start

note: front end khi dùng laravel echo và socket io 
thì socketio => v 2.14.0

sửa lại maildev trong compose.yml -> :1080 :1025

nhớ vào https://console.cloud.google.com/ tạo Credentials/oauth 2.0
lấy key 