--- cách chạy ứng dụng trong docker --

sau khi clone về 
->cd laradock
->docker-compose up -d

với dev
->docker compose exec --user=laradock workspace bash

-dùng laradock bằng :
    git clone https://github.com/laradock/laradock.git
    clone vào thư mục đang chứ navyuh-backend

-copy env trong /navyuh_backend/environment/laradock.env vào .env của laradock

-thay folder navyuh_backend/environment/laravel-echo-server vào thư mục laravel-echo-server của laradock

-cd vào laradock
    docker-compose up -d nginx mysql phpmyadmin redis workspace laravel-echo-server
    <!-- redis-webui -->

-- để thao tác với laravel trong docker dùng
    - trong folder laradock
    docker compose exec --user=laradock workspace bash
    - bất kỳ thư mục nàoW
    docker exec -it {workspace-container-id} bash


composer i
    
note: front end khi dùng laravel echo và socket io 
thì socketio => v 2.14.0

sửa lại maildev trong compose.yml -> :1080 :1025

nhớ vào https://console.cloud.google.com/ tạo Credentials/oauth 2.0
lấy key 


// tính năng
- Đăng nhập
- Đăng kí
- Đăng nhập bằng google
- Xác nhận tài khoản bằng gmail khi đăng kí
- Quên mật khẩu
- Gửi OTP
- Middleware cho các api backend

--Trang quản lý
-