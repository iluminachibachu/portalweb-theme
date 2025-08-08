<?php
/**
 * メインテンプレートファイル
 * 
 * @package PortalWeb
 * @since 1.0.0
 */

get_header(); ?>

<main class="site-main">
    <!-- カレンダーを挿入 -->
    <div class="calendar-container">
        <?php echo portalweb_display_calendar(); ?>
    </div>
    
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
                <header class="post-header">
                    <h2 class="post-title">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h2>
                    <div class="post-meta">
                        投稿日: <?php echo get_the_date(); ?> | 
                        著者: <?php the_author(); ?> |
                        カテゴリ: <?php the_category(', '); ?>
                    </div>
                </header>
                
                <div class="post-content">
                    <?php the_excerpt(); ?>
                </div>
                
                <footer class="post-footer">
                    <a href="<?php the_permalink(); ?>" class="read-more">
                        続きを読む
                    </a>
                </footer>
            </article>
        <?php endwhile; ?>
        
        <?php 
        // ページネーション（モダンな方法）
        the_posts_pagination([
            'prev_text' => '&laquo; 前のページ',
            'next_text' => '次のページ &raquo;',
        ]);
        ?>
        
    <?php else : ?>
        <div class="no-posts">
            <h2>記事が見つかりません</h2>
            <p>申し訳ありませんが、お探しの記事は見つかりませんでした。</p>
        </div>
    <?php endif; ?>
</main>

<?php get_footer(); ?>