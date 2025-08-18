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
                <?php while (have_posts()) : the_post(); ?>
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
                <?php endwhile; ?>
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
                <div class="month"><h3 id="cal-hd">2025年9月｜何の日カレンダー</h3></div>
                <div class="dow"><span>日</span><span>月</span><span>火</span><span>水</span><span>木</span><span>金</span><span>土</span></div>
                <div class="grid" role="grid" aria-label="2025年9月のカレンダー">
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