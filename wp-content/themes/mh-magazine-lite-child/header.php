<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<?php if (is_singular() && pings_open(get_queried_object())) : ?>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php endif; ?>
<?php wp_head(); ?>
</head>
<!-- Bắt đầu chèn ảnh banner -->
<!-- banner top -->
<div id='ads-top' style="margin: 0 auto;width: 100% !important;max-width: 1180px !important;max-height: 120px !important;">
    <div style='margin:0; padding:0;max-width:100%;max-height:120px;top:0;'>
        <a href='http://localhost/forum-cms/' target='_blank'>
            <img border='0' src='http://localhost/forum-cms/wp-content/uploads/2021/08/banner-top.jpg' width='100%'/>
        </a>
    </div>
</div>
<!-- banner trai -->
<div id='ads-left'>
    <div style='margin:0 0 5px 0; padding:0;width:200px;position:fixed; left:0; top:0;'>
        <a href='http://localhost/forum-cms/' target='_blank'>
            <img border='0' height='665' src='http://localhost/forum-cms/wp-content/uploads/2021/08/banner_left.png' width='200'/>
        </a>
    </div>
</div>
<!-- banner phai -->
<div id='ads-right'>
    <div style='margin:0 0 5px 0; padding:0;width:200px;position:fixed; right:0; top:0;'>
        <a href='http://localhost/forum-cms/' target='_blank'>
            <img border='0' height='665' src='http://localhost/forum-cms/wp-content/uploads/2021/08/banner_right.jpeg' width='200'/>
        </a>
    </div>
</div>
<!-- Kết thúc chèn ảnh banner -->
<body id="mh-mobile" <?php body_class(); ?> itemscope="itemscope" itemtype="https://schema.org/WebPage">
<?php wp_body_open(); ?>
<?php mh_before_header();
get_template_part('content', 'header');
mh_after_header(); ?>
<!-- TradingView Widget BEGIN -->
<div class="tradingview-widget-container">
    <div class="tradingview-widget-container__widget"></div>
    <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
        {
            "symbols": [
            {
                "proName": "FOREXCOM:SPXUSD",
                "title": "Chỉ số S&P 500"
            },
            {
                "proName": "FOREXCOM:NSXUSD",
                "title": "Nasdaq 100"
            },
            {
                "proName": "FX_IDC:EURUSD",
                "title": "EUR/USD"
            },
            {
                "proName": "BITSTAMP:BTCUSD",
                "title": "BTC/USD"
            },
            {
                "proName": "BITSTAMP:ETHUSD",
                "title": "ETH/USD"
            }
        ],
            "showSymbolLogo": false,
            "colorTheme": "light",
            "isTransparent": false,
            "displayMode": "adaptive",
            "locale": "vi_VN"
        }
    </script>
</div>
<!-- TradingView Widget END -->
