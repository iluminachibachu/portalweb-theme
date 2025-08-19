<?php
/**
 * メインテンプレートファイル
 * 
 * @package PortalWeb
 * @since 1.0.0
 */

get_header(); ?>

<main id="main" role="main">
    <div class="grid-main">
        <!-- Left column (article + calendar) -->
        <div class="stack">
            <?php if (have_posts()) : ?>
                <?php 
                // 最新の記事を1つだけ取得
                the_post(); 
                ?>
                <article class="article card" aria-labelledby="art-hd-<?php the_ID(); ?>">
                    <header class="card__hd" id="art-hd-<?php the_ID(); ?>">
                        <?php echo get_the_date('n月j日'); ?> <?php the_title(); ?>
                    </header>
                    <div class="card__bd">
                        <h2><?php the_title(); ?></h2>
                        <p class="meta"><?php the_category(', '); ?></p>
                        <div><?php the_content(); ?></div>
                    </div>
                </article>
            <?php else : ?>
                <article class="article card" aria-labelledby="art-hd">
                    <header class="card__hd" id="art-hd">9月1日 今日は何の日？</header>
                    <div class="card__bd">
                        <h2>防災の日</h2>
                        <p class="meta">日本の記念日</p>
                        <p>1923年の関東大震災を教訓として、9月1日は防災意識を高める日とされています。日常の備え（家具の固定、非常食・飲料水、安否確認の手段など）を見直すきっかけに。</p>
                    </div>
                </article>
            <?php endif; ?>

            <!-- Calendar block -->
            <section class="calendar card" aria-labelledby="cal-hd">
                <?php 
                $current_year = date('Y');
                $current_month = date('n');
                $month_names = [
                    1 => '1月', 2 => '2月', 3 => '3月', 4 => '4月',
                    5 => '5月', 6 => '6月', 7 => '7月', 8 => '8月', 
                    9 => '9月', 10 => '10月', 11 => '11月', 12 => '12月'
                ];
                ?>
                <div class="month">
                    <h3 id="cal-hd"><?php echo esc_html($current_year . '年' . $month_names[$current_month] . '｜何の日カレンダー'); ?></h3>
                </div>
                <div class="month-nav">
                    <div class="month-row">
                        <?php for ($i = 1; $i <= 6; $i++) : ?>
                            <h3 class="month-num<?php echo ($i == $current_month) ? ' active' : ''; ?>"><?php echo $i; ?>月</h3>
                        <?php endfor; ?>
                    </div>
                    <div class="month-row">
                        <?php for ($i = 7; $i <= 12; $i++) : ?>
                            <h3 class="month-num<?php echo ($i == $current_month) ? ' active' : ''; ?>"><?php echo $i; ?>月</h3>
                        <?php endfor; ?>
                    </div>
                </div>
                <div class="grid" role="grid" aria-label="<?php echo esc_attr($current_year . '年' . $month_names[$current_month] . 'のカレンダー'); ?>">
                    <?php echo portalweb_display_calendar(); ?>
                </div>
            </section>
        
            <!-- ボタン（左カラム内に移動） -->
            <div class="bottom-row" aria-label="左カラムの操作">
                <button class="btn" id="btnSearch" aria-haspopup="dialog" aria-controls="dlgSearch">🔍 検索</button>
                <button class="btn" id="btnTopics" aria-haspopup="dialog" aria-controls="dlgTopics">🏷️ テーマから探す</button>
            </div>
        </div>

        <!-- Right column (sidebar) -->
        <?php get_sidebar(); ?>
    </div>
</main>

<?php get_footer(); ?>