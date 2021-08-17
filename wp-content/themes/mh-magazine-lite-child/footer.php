<?php mh_before_footer(); ?>
<?php mh_magazine_lite_footer_widgets(); ?>
<div class="mh-copyright-wrap">
    <div class="mh-container mh-container-inner mh-clearfix">
        <p class="mh-copyright"><?php printf(esc_html__('Copyright &copy; %1$s | Diễn đàn đầu tư', 'mh-magazine-lite'), date("Y")) ?></p>
    </div>
</div>
<?php mh_after_footer(); ?>
<?php wp_footer(); ?>
<script type="text/javascript">
    (function ($) {
        $(document).ready(function () {
            var provinceOptions = '';
            let datas = [{"matt": "Z01", "name": "Thành phố Hà Nội"}, {
                "matt": "Z79",
                "name": "Thành phố Hồ Chí Minh"
            }, {"matt": "Z31", "name": "Thành phố Hải Phòng"}, {
                "matt": "Z48",
                "name": "Thành phố Đà Nẵng"
            }, {"matt": "Z92", "name": "Thành phố Cần Thơ"}, {"matt": "Z89", "name": "Tỉnh An Giang"}, {
                "matt": "Z77",
                "name": "Tỉnh Bà Rịa - Vũng Tàu"
            }, {"matt": "Z24", "name": "Tỉnh Bắc Giang"}, {"matt": "Z06", "name": "Tỉnh Bắc Kạn"}, {
                "matt": "Z95",
                "name": "Tỉnh Bạc Liêu"
            }, {"matt": "Z27", "name": "Tỉnh Bắc Ninh"}, {"matt": "Z83", "name": "Tỉnh Bến Tre"}, {
                "matt": "Z52",
                "name": "Tỉnh Bình Định"
            }, {"matt": "Z74", "name": "Tỉnh Bình Dương"}, {"matt": "Z70", "name": "Tỉnh Bình Phước"}, {
                "matt": "Z60",
                "name": "Tỉnh Bình Thuận"
            }, {"matt": "Z96", "name": "Tỉnh Cà Mau"}, {"matt": "Z04", "name": "Tỉnh Cao Bằng"}, {
                "matt": "Z66",
                "name": "Tỉnh Đắk Lắk"
            }, {"matt": "Z67", "name": "Tỉnh Đắk Nông"}, {"matt": "Z11", "name": "Tỉnh Điện Biên"}, {
                "matt": "Z75",
                "name": "Tỉnh Đồng Nai"
            }, {"matt": "Z87", "name": "Tỉnh Đồng Tháp"}, {"matt": "Z64", "name": "Tỉnh Gia Lai"}, {
                "matt": "Z02",
                "name": "Tỉnh Hà Giang"
            }, {"matt": "Z35", "name": "Tỉnh Hà Nam"}, {"matt": "Z42", "name": "Tỉnh Hà Tĩnh"}, {
                "matt": "Z30",
                "name": "Tỉnh Hải Dương"
            }, {"matt": "Z93", "name": "Tỉnh Hậu Giang"}, {"matt": "Z17", "name": "Tỉnh Hoà Bình"}, {
                "matt": "Z33",
                "name": "Tỉnh Hưng Yên"
            }, {"matt": "Z56", "name": "Tỉnh Khánh Hòa"}, {"matt": "Z91", "name": "Tỉnh Kiên Giang"}, {
                "matt": "Z62",
                "name": "Tỉnh Kon Tum"
            }, {"matt": "Z12", "name": "Tỉnh Lai Châu"}, {"matt": "Z68", "name": "Tỉnh Lâm Đồng"}, {
                "matt": "Z20",
                "name": "Tỉnh Lạng Sơn"
            }, {"matt": "Z10", "name": "Tỉnh Lào Cai"}, {"matt": "Z80", "name": "Tỉnh Long An"}, {
                "matt": "Z36",
                "name": "Tỉnh Nam Định"
            }, {"matt": "Z40", "name": "Tỉnh Nghệ An"}, {"matt": "Z37", "name": "Tỉnh Ninh Bình"}, {
                "matt": "Z58",
                "name": "Tỉnh Ninh Thuận"
            }, {"matt": "Z25", "name": "Tỉnh Phú Thọ"}, {"matt": "Z54", "name": "Tỉnh Phú Yên"}, {
                "matt": "Z44",
                "name": "Tỉnh Quảng Bình"
            }, {"matt": "Z49", "name": "Tỉnh Quảng Nam"}, {"matt": "Z51", "name": "Tỉnh Quảng Ngãi"}, {
                "matt": "Z22",
                "name": "Tỉnh Quảng Ninh"
            }, {"matt": "Z45", "name": "Tỉnh Quảng Trị"}, {"matt": "Z94", "name": "Tỉnh Sóc Trăng"}, {
                "matt": "Z14",
                "name": "Tỉnh Sơn La"
            }, {"matt": "Z72", "name": "Tỉnh Tây Ninh"}, {"matt": "Z34", "name": "Tỉnh Thái Bình"}, {
                "matt": "Z19",
                "name": "Tỉnh Thái Nguyên"
            }, {"matt": "Z38", "name": "Tỉnh Thanh Hóa"}, {
                "matt": "Z46",
                "name": "Tỉnh Thừa Thiên Huế"
            }, {"matt": "Z82", "name": "Tỉnh Tiền Giang"}, {"matt": "Z84", "name": "Tỉnh Trà Vinh"}, {
                "matt": "Z08",
                "name": "Tỉnh Tuyên Quang"
            }, {"matt": "Z86", "name": "Tỉnh Vĩnh Long"}, {"matt": "Z26", "name": "Tỉnh Vĩnh Phúc"}, {
                "matt": "Z15",
                "name": "Tỉnh Yên Bái"
            }]
            provinceOptions += '<option value="">Chọn Tỉnh thành</option>';
            $.each(datas, function (key, province) {
                provinceOptions += '<option matt="' + province.matt + '" value="' + province.name + '">' + province.name + '</option>';
            });
            $('#input_1_7').html(provinceOptions);
        });
    })(jQuery)
</script>
</body>
</html>