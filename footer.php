    <footer class="site-footer" role="contentinfo">
        <div class="site-footer__inner">
            <div class="footer-logo" aria-hidden="true">
                <svg viewBox="0 0 200 40" xmlns="http://www.w3.org/2000/svg">
                    <rect x="1" y="1" width="198" height="38" rx="10" fill="#0b57d0" opacity=".08" stroke="#0b57d0"/>
                    <text x="100" y="26" text-anchor="middle" font-family="sans-serif" font-weight="700" font-size="16" fill="#0b57d0">FOOTER LOGO</text>
                </svg>
            </div>
        </div>
    </footer>

    <button class="to-top" id="toTop" aria-label="ページ上部へ">↑</button>

    <dialog id="dlgSearch" aria-labelledby="dlgSearchHd">
        <div class="dlg__hd" id="dlgSearchHd">サイト内検索</div>
        <div class="dlg__bd">
            <div class="ipt">
                <input type="search" placeholder="キーワードを入力" aria-label="検索キーワード" />
                <button class="btn" type="button">検索</button>
            </div>
            <p style="margin-top:10px;color:var(--c-muted);font-size:.95em">※ 現在はフロントエンドのみの実装です（後日PHPで接続）。</p>
        </div>
        <div class="dlg__ft">
            <button class="btn btn-secondary" value="cancel">閉じる</button>
        </div>
    </dialog>

    <dialog id="dlgTopics" aria-labelledby="dlgTopicsHd">
        <div class="dlg__hd" id="dlgTopicsHd">テーマから探す</div>
        <div class="dlg__bd">
            <div class="tag-cloud" role="list">
                <span class="tag" role="listitem"># 防災</span>
                <span class="tag" role="listitem"># 歴史</span>
                <span class="tag" role="listitem"># 食文化</span>
                <span class="tag" role="listitem"># 科学</span>
                <span class="tag" role="listitem"># スポーツ</span>
                <span class="tag" role="listitem"># 文化</span>
                <span class="tag" role="listitem"># くらし</span>
                <span class="tag" role="listitem"># 行事</span>
                <span class="tag" role="listitem"># 地域</span>
                <span class="tag" role="listitem"># 乗り物</span>
            </div>
        </div>
        <div class="dlg__ft">
            <button class="btn btn-secondary" value="cancel">閉じる</button>
        </div>
    </dialog>

    <?php wp_footer(); ?>
</body>
</html>