Cài đặt: 
-Git: https://git-scm.com/
-Composer: https://getcomposer.org/
-WampServer: https://sourceforge.net/projects/wampserver/
-Cài đặt Visual Studio Code: https://code.visualstudio.com/

Hướng Dẫn tải và cài đặt và chạy project
-Chọn vị trí muốn tải project về và mở CMD lên
-Chạy lần lượt các lệnh:
git clone "https://github.com/Hzinh02/Hzinh02-HuuVinh_ThaiTuan-DoAnCN.git"
cd HuuVinh_ThaiTuan-DoAnCN
cp .env.example .env
-Mở WampServer lên truy cập vào localhost/phpmyadmin
-Thêm một database mới tên là drinkshop và Export database drinkshop.sql đã tải về trong folder HuuVinh_ThaiTuan-DoAnCN
-Mở project lên và vào file .env sửa các thông số sau và lưu lại:
DB_DATABASE=drinkshop
DB_USERNAME=root
-Tiếp tục quay về CMD và chạy tiếp các lệnh sau: 
composer install
php artisan key:generate
-Để chạy project thì làm các bước sau
vào project -> mở terminal lên -> chạy lệnh php artisan serve -> lấy link và chạy lên
