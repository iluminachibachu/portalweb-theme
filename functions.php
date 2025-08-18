<?php
/**
 * テーマの機能とセットアップ
 * 
 * @package PortalWeb
 * @since 1.0.0
 */

// 直接アクセスを防ぐ（セキュリティのベストプラクティス）
if (!defined('ABSPATH')) {
    exit;
}

/**
 * テーマのセットアップ
 * モダンなPHPの機能を使用：タイプヒント、戻り値の型宣言など
 */
function portalweb_theme_setup(): void 
{
    // テキストドメインを読み込み
    load_theme_textdomain('portalweb', get_template_directory() . '/languages');

    // WordPressの機能サポートを追加
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ]);

    // カスタムロゴサポート
    add_theme_support('custom-logo', [
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ]);

    // メニューの登録
    register_nav_menus([
        'primary' => __('プライマリメニュー', 'portalweb'),
        'footer'  => __('フッターメニュー', 'portalweb'),
    ]);
}
add_action('after_setup_theme', 'portalweb_theme_setup');

/**
 * スタイルとスクリプトの読み込み
 * nullableタイプとstring連結（PHP 8の機能を活用）
 */
function portalweb_enqueue_assets(): void 
{
    // スタイルシートの読み込み
    wp_enqueue_style(
        'portalweb-style',
        get_stylesheet_uri(),
        [],
        wp_get_theme()->get('Version')
    );

    // テーマのJavaScriptの読み込み（存在する場合）
    $script_path = get_template_directory() . '/assets/js/theme.js';
    if (file_exists($script_path)) {
        wp_enqueue_script(
            'portalweb-theme-script',
            get_template_directory_uri() . '/assets/js/theme.js',
            [],
            wp_get_theme()->get('Version'),
            true
        );
    }

    // メインJavaScriptの読み込み（存在する場合）
    $main_script_path = get_template_directory() . '/assets/js/main.js';
    if (file_exists($main_script_path)) {
        wp_enqueue_script(
            'portalweb-script',
            get_template_directory_uri() . '/assets/js/main.js',
            ['portalweb-theme-script'],
            wp_get_theme()->get('Version'),
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'portalweb_enqueue_assets');

/**
 * カスタム投稿タイプの例
 * PHP 8の機能：match式、属性（アトリビュート）の使用例
 */
function portalweb_register_custom_post_types(): void 
{
    $post_types = [
        'portfolio' => [
            'labels' => [
                'name'          => 'ポートフォリオ',
                'singular_name' => 'ポートフォリオ項目',
                'add_new'       => '新規追加',
                'add_new_item'  => '新しいポートフォリオ項目を追加',
            ],
            'public'      => true,
            'has_archive' => true,
            'supports'    => ['title', 'editor', 'thumbnail', 'excerpt'],
            'menu_icon'   => 'dashicons-portfolio',
        ]
    ];

    foreach ($post_types as $post_type => $args) {
        register_post_type($post_type, $args);
    }
}
add_action('init', 'portalweb_register_custom_post_types');

/**
 * ウィジェットエリアの登録
 * 配列のスプレッド演算子を使用（PHP 7.4+）
 */
function portalweb_register_widget_areas(): void 
{
    $widget_areas = [
        [
            'name'          => __('サイドバー', 'portalweb'),
            'id'            => 'sidebar-1',
            'description'   => __('メインサイドバーウィジェットエリア', 'portalweb'),
            'before_widget' => '<div class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ],
        [
            'name'          => __('フッター', 'portalweb'),
            'id'            => 'footer-1',
            'description'   => __('フッターウィジェットエリア', 'portalweb'),
            'before_widget' => '<div class="footer-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="footer-widget-title">',
            'after_title'   => '</h4>',
        ],
    ];

    foreach ($widget_areas as $widget_area) {
        register_sidebar($widget_area);
    }
}
add_action('widgets_init', 'portalweb_register_widget_areas');

/**
 * カスタムクラスの例
 * PHP 8の機能：readonly プロパティ、コンストラクタプロモーション
 */
class PortalWebThemeCustomizer 
{
    public function __construct(
        private readonly string $theme_name = 'portalweb'
    ) {
        add_action('customize_register', [$this, 'register_customizer_settings']);
    }

    public function register_customizer_settings(WP_Customize_Manager $wp_customize): void 
    {
        // カスタマイザーの設定例
        $wp_customize->add_section('portalweb_colors', [
            'title'    => __('テーマカラー', 'portalweb'),
            'priority' => 30,
        ]);

        $wp_customize->add_setting('portalweb_primary_color', [
            'default'           => '#0073aa',
            'sanitize_callback' => 'sanitize_hex_color',
        ]);

        $wp_customize->add_control(
            new WP_Customize_Color_Control($wp_customize, 'portalweb_primary_color', [
                'label'    => __('プライマリカラー', 'portalweb'),
                'section'  => 'portalweb_colors',
                'settings' => 'portalweb_primary_color',
            ])
        );
    }
}

// カスタマイザーを初期化
new PortalWebThemeCustomizer();

/**
 * ユーティリティ関数
 * PHP 8の機能：nullable型、三項演算子の改善
 */
function portalweb_get_excerpt(int $length = 150): string 
{
    return has_excerpt() 
        ? wp_trim_words(get_the_excerpt(), $length) 
        : wp_trim_words(get_the_content(), $length);
}

/**
 * セキュリティヘッダーの追加
 */
function portalweb_add_security_headers(): void 
{
    if (!is_admin()) {
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: SAMEORIGIN');
        header('X-XSS-Protection: 1; mode=block');
    }
}
add_action('init', 'portalweb_add_security_headers');

/**
 * カレンダー表示機能
 * 指定した日の月のカレンダーを表示（新しいデザイン対応）
 */
function portalweb_display_calendar(?int $year = null, ?int $month = null): string 
{
    $current_date = new DateTime();
    $year = $year ?? (int)$current_date->format('Y');
    $month = $month ?? (int)$current_date->format('n');
    
    // 月の最初の日と最後の日を取得
    $first_day = new DateTime("$year-$month-01");
    $last_day = clone $first_day;
    $last_day->modify('last day of this month');
    
    $start_weekday = (int)$first_day->format('w'); // 0=日曜日
    $days_in_month = (int)$last_day->format('j');
    
    // 前月末日を計算
    $prev_month = clone $first_day;
    $prev_month->modify('last day of previous month');
    $prev_month_days = (int)$prev_month->format('j');
    
    $calendar_html = '';
    $current_day = 1;
    $weeks = ceil(($start_weekday + $days_in_month) / 7);
    
    for ($week = 0; $week < $weeks; $week++) {
        for ($weekday = 0; $weekday < 7; $weekday++) {
            if ($week === 0 && $weekday < $start_weekday) {
                // 前月の日付
                $prev_day = $prev_month_days - ($start_weekday - $weekday - 1);
                $calendar_html .= sprintf(
                    '<div class="cell is-outside" role="gridcell" aria-label="%d月%d日"><span class="n" aria-hidden="true">%d</span></div>',
                    $month === 1 ? 12 : $month - 1,
                    $prev_day,
                    $prev_day
                );
            } elseif ($current_day > $days_in_month) {
                // 次月の日付
                $next_day = $current_day - $days_in_month;
                $calendar_html .= sprintf(
                    '<div class="cell is-outside" role="gridcell" aria-label="%d月%d日"><span class="n" aria-hidden="true">%d</span></div>',
                    $month === 12 ? 1 : $month + 1,
                    $next_day,
                    $next_day
                );
                $current_day++;
            } else {
                // 当月の日付
                $classes = ['cell'];
                $label = sprintf('%d月%d日', $month, $current_day);
                $tag = '';
                
                // 今日の日付チェック
                if ($year === (int)date('Y') && $month === (int)date('n') && $current_day === (int)date('j')) {
                    $classes[] = 'is-today';
                }
                
                // 特別な日をチェック（例：防災の日、秋分の日など）
                if ($month === 9) {
                    if ($current_day === 1) {
                        $classes[] = 'is-feature';
                        $tag = '<span class="tag">防災の日</span>';
                        $label .= ' 防災の日';
                    } elseif ($current_day === 23) {
                        $classes[] = 'is-feature';
                        $tag = '<span class="tag">秋分の日</span>';
                        $label .= ' 秋分の日';
                    }
                }
                
                $calendar_html .= sprintf(
                    '<div class="%s" role="gridcell" aria-label="%s"><span class="n">%d</span>%s</div>',
                    esc_attr(implode(' ', $classes)),
                    esc_attr($label),
                    $current_day,
                    $tag
                );
                $current_day++;
            }
        }
    }
    
    return $calendar_html;
}

/**
 * 開発環境での便利な機能
 */
if (defined('WP_DEBUG') && WP_DEBUG) {
    // 開発時のみ：クエリ数とページ読み込み時間を表示
    function portalweb_debug_info(): void 
    {
        if (current_user_can('manage_options')) {
            echo sprintf(
                '<!-- クエリ数: %d, 読み込み時間: %.4f秒 -->',
                get_num_queries(),
                timer_stop()
            );
        }
    }
    add_action('wp_footer', 'portalweb_debug_info');
}