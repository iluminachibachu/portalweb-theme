<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class('fs-medium'); ?>>
<?php wp_body_open(); ?>

<header class="site-header" role="banner">
    <div class="site-header__inner">
        <div class="brand">
            <h4 class="site-title">
                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                    今日は何の日？
                </a>
            </h4>
            <div class="brand-logo" aria-hidden="true">
                <svg viewBox="0 0 220 48" xmlns="http://www.w3.org/2000/svg">
                    <rect x="1" y="1" width="218" height="46" rx="10" fill="#0b57d0" opacity=".1" stroke="#0b57d0"/>
                    <text x="110" y="30" text-anchor="middle" font-family="sans-serif" font-weight="700" font-size="18" fill="#0b57d0">LOGO</text>
                </svg>
            </div>
        </div>
        <div class="tools">
            <div class="font-size" role="group" aria-label="文字サイズ">
                <button id="fsSmall" aria-pressed="false" title="文字サイズ小">小</button>
                <button id="fsLarge" aria-pressed="false" title="文字サイズ大">大</button>
            </div>
        </div>
    </div>
</header>