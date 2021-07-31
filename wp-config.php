<?php
/**
 * Cấu hình cơ bản cho WordPress
 *
 * Trong quá trình cài đặt, file "wp-config.php" sẽ được tạo dựa trên nội dung 
 * mẫu của file này. Bạn không bắt buộc phải sử dụng giao diện web để cài đặt, 
 * chỉ cần lưu file này lại với tên "wp-config.php" và điền các thông tin cần thiết.
 *
 * File này chứa các thiết lập sau:
 *
 * * Thiết lập MySQL
 * * Các khóa bí mật
 * * Tiền tố cho các bảng database
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Thiết lập MySQL - Bạn có thể lấy các thông tin này từ host/server ** //
/** Tên database MySQL */
define( 'DB_NAME', 'freelancer_forum_wp' );

/** Username của database */
define( 'DB_USER', 'root' );

/** Mật khẩu của database */
define( 'DB_PASSWORD', 'root' );

/** Hostname của database */
define( 'DB_HOST', 'localhost:3308' );

/** Database charset sử dụng để tạo bảng database. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Kiểu database collate. Đừng thay đổi nếu không hiểu rõ. */
define('DB_COLLATE', '');

/**#@+
 * Khóa xác thực và salt.
 *
 * Thay đổi các giá trị dưới đây thành các khóa không trùng nhau!
 * Bạn có thể tạo ra các khóa này bằng công cụ
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Bạn có thể thay đổi chúng bất cứ lúc nào để vô hiệu hóa tất cả
 * các cookie hiện có. Điều này sẽ buộc tất cả người dùng phải đăng nhập lại.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'N$3fcc`n<q tiiB.;q{14alP?#S6#Lkp>;LXH2#[y}f 6XDKg y)hwc_*lV#d!`+' );
define( 'SECURE_AUTH_KEY',  'w}SoiP)R<I YMb.Fx*9uQ_BVoa~5T]*5-j<8K~GfsxINPS.:Wor_1#,U*q0H~Sm(' );
define( 'LOGGED_IN_KEY',    '@9!34PZ=cq]jzy.Z%tmcSPm|=N)znV^bLgGoa@QK)??5HA:u^|z2nXdqfR5R_!-#' );
define( 'NONCE_KEY',        ']Fk|fQeviujd{xn_,jFd>m([``l|)T_ImbpgN>8{n={c4Iwdo/zM,f=W*o fC]h:' );
define( 'AUTH_SALT',        'X%u&L&R42M^khCK?iT}@/]daC3%gQdZN3QeHo$#nLIk6`w AQkskxqyHRh?j/J)+' );
define( 'SECURE_AUTH_SALT', '-E5S$m=wcu/M_R&Lc&I%u[-@b4P.QBoMqCVW5Z3KtDt*Br5*%35!Jn8CIUhJ8wC%' );
define( 'LOGGED_IN_SALT',   'Q|JlppN=jx&62X pdACmRP)$^!j3Y9(V5$LS5YUKTqA8%xQ`fEpcD-IE 3ePj|D-' );
define( 'NONCE_SALT',       'z,G=- [/$ah5#tPl[~N4gMYtYX]/I|{)fU3R0FOnR7u*-:Z-GQZR-nrsb&{3(Sbr' );

/**#@-*/

/**
 * Tiền tố cho bảng database.
 *
 * Đặt tiền tố cho bảng giúp bạn có thể cài nhiều site WordPress vào cùng một database.
 * Chỉ sử dụng số, ký tự và dấu gạch dưới!
 */
$table_prefix = 'wp_';

/**
 * Dành cho developer: Chế độ debug.
 *
 * Thay đổi hằng số này thành true sẽ làm hiện lên các thông báo trong quá trình phát triển.
 * Chúng tôi khuyến cáo các developer sử dụng WP_DEBUG trong quá trình phát triển plugin và theme.
 *
 * Để có thông tin về các hằng số khác có thể sử dụng khi debug, hãy xem tại Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);
define ('WP_INSTALLING', false);
/* Đó là tất cả thiết lập, ngưng sửa từ phần này trở xuống. Chúc bạn viết blog vui vẻ. */

/** Đường dẫn tuyệt đối đến thư mục cài đặt WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Thiết lập biến và include file. */
require_once(ABSPATH . 'wp-settings.php');
