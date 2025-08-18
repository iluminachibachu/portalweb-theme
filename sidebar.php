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
                    'numberposts' => 5,
                    'post_status' => 'publish'
                ]);
                
                if ($recent_posts) {
                    foreach ($recent_posts as $post) {
                        $post_date = get_the_time('n/j', $post['ID']);
                        echo '<li><a href="' . get_permalink($post['ID']) . '">';
                        echo '<span style="color:var(--c-muted);font-size:0.9em;">' . esc_html($post_date) . '</span> ';
                        echo esc_html($post['post_title']);
                        echo '</a></li>';
                    }
                    wp_reset_postdata();
                } else {
                ?>
                    <li><a href="#"><span style="color:var(--c-muted);font-size:0.9em;">8/18</span> お知らせ：サイトを公開しました</a></li>
                    <li><a href="#"><span style="color:var(--c-muted);font-size:0.9em;">8/15</span> 9月の記念日を追加しました</a></li>
                    <li><a href="#"><span style="color:var(--c-muted);font-size:0.9em;">8/10</span> 特集：季節の行事</a></li>
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
    
    <section class="card section">
        <h2 class="section__hd">広告</h2>
        <div class="section__bd ad">
            <div class="box">Ad 300×250</div>
            <div class="box">Ad 300×250</div>
        </div>
    </section>
</aside>