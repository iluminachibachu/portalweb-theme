<?php
/**
 * 個別投稿テンプレート
 * 
 * @package PortalWeb
 * @since 1.0.0
 */

get_header(); ?>

<main class="site-main">
    <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
            <header class="post-header">
                <h1 class="post-title"><?php the_title(); ?></h1>
                
                <div class="post-meta">
                    <time datetime="<?php echo get_the_date('c'); ?>">
                        <?php echo get_the_date(); ?>
                    </time>
                    <span class="author">
                        著者: <?php the_author_posts_link(); ?>
                    </span>
                    <span class="categories">
                        カテゴリ: <?php the_category(', '); ?>
                    </span>
                    <?php if (has_tag()) : ?>
                        <div class="tags">
                            <?php the_tags('タグ: ', ', ', ''); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </header>

            <?php if (has_post_thumbnail()) : ?>
                <div class="post-thumbnail">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?>

            <div class="post-content">
                <?php the_content(); ?>
            </div>

            <footer class="post-footer">
                <?php
                // ページネーション（複数ページの投稿用）
                wp_link_pages([
                    'before' => '<div class="page-links">ページ: ',
                    'after'  => '</div>',
                ]);
                ?>
            </footer>
        </article>

        <?php
        // 前後の投稿へのナビゲーション
        the_post_navigation([
            'prev_text' => '&laquo; %title',
            'next_text' => '%title &raquo;',
        ]);
        ?>

        <?php
        // コメント表示
        if (comments_open() || get_comments_number()) {
            comments_template();
        }
        ?>
    <?php endwhile; ?>
</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>