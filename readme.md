### B1: Cấu hình server: ngnix, mysql, php version 7.4
### B2: Pull code in github
```
git clone https://github.com/tungtrandinh/sf-cms.git
```
### B3: import database
- Đăng nhập vào MySQL shell:
```
mysql -u root -p
```
Để tạo database cần thiết, bạn cần thực thi vài câu lệnh. Gõ từng lệnh và nhấn ENTER cho mỗi lệnh. Lưu ý là bạn cần điền thông tin hợp lệ cho placeholders db_name , db_user  và db_user_password :
```
CREATE DATABASE db_name;
GRANT ALL PRIVILEGES ON db_name.* TO 'db_user'@'localhost' IDENTIFIED BY 'db_user_password';
FLUSH PRIVILEGES;
EXIT;
```
Đổi tên wp-config-sample.php thành wp-config.php:
```
cd /var/www/html/
sudo mv wp-config-sample.php wp-config.php
```
* Sửa file cấu hình wp-config.php như sau:
`sudo nano wp-config.php`

```
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'wordpressuser');

/** MySQL database password */
define('DB_PASSWORD', 'password');

/** MySQL hostname */
define('DB_HOST', 'database_server_ip');
```
- Path: `/db/database.sql`
- Tạo mới database
- Import database
- Mở bảng wp_options ở trường `option_name` thay đổi các giá trị `siteurl`, `home` theo domain website
- thay đổi giá trị khác trong bảng `wp_users`
- thay đổi pass user:
    1. mở bảng `wp-users` sau đó chọn edit 1 user
    2. trường `user_pass` chọn `function` là MD5 sau đó điền mật khẩu và `save`
### B4 Cấp quyền truy cập
* Thực hiện cấp quyền truy cập cho người dùng www-data (người dùng truy cập web server qua trình duyệt)
```
cd /var/www/html/
sudo chown -R www-data:www-data *
```
### B5: Run website
### cấu hình gửi email
* làm theo hướng dẫn của link: [cấu hình gửi mail bằng gmail](https://kb.hostvn.net/huong-dan-thiet-lap-smtp-cua-gmail-cho-wordpress-voi-plugins-wp-mail-smtp-by-wpforms_346.html)
hoặc [cấu hình gửi mail smtp](https://blog.vinahost.vn/cau-hinh-gui-mail-trong-wordpress-su-dung-plugin-wp-mail-smtp)

Thanks You!!!