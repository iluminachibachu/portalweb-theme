<?php
/**
 * サイドバーテンプレート
 * 
 * @package PortalWeb
 * @since 1.0.0
 */
?>

<aside class="sidebar" aria-label="サイドバー">
    <section class="card section">
        <h2 class="section__hd">新着情報</h2>
        <div class="section__bd">
            <ul class="list">
                <?php
                $recent_posts = wp_get_recent_posts([
                    'numberposts' => 3,
                    'post_status' => 'publish'
                ]);
                
                if ($recent_posts) {
                    foreach ($recent_posts as $post) {
                        echo '<li><a href="' . get_permalink($post['ID']) . '">' . esc_html($post['post_title']) . '</a></li>';
                    }
                    wp_reset_postdata();
                } else {
                ?>
                    <li><a href="#">お知らせ：サイトを公開しました</a></li>
                    <li><a href="#">9月の記念日を追加しました</a></li>
                    <li><a href="#">特集：季節の行事</a></li>
                <?php } ?>
            </ul>
        </div>
    </section>
    
    <section class="card section">
        <h2 class="section__hd">関連記事</h2>
        <div class="section__bd">
            <ul class="list">
                <li><a href="#">防災グッズチェックリスト</a></li>
                <li><a href="#">非常時の連絡方法まとめ</a></li>
                <li><a href="#">地域の避難情報リンク集</a></li>
            </ul>
        </div>
    </section>
    
    <?php if (is_active_sidebar('sidebar-1')) : ?>
        <?php dynamic_sidebar('sidebar-1'); ?>
    <?php else : ?>
        <section class="card section">
            <h2 class="section__hd">広告</h2>
            <div class="section__bd ad">
                <div class="box">Ad 300×250</div>
                <div class="box">Ad 300×250</div>
            </div>
        </section>
    <?php endif; ?>
</aside>