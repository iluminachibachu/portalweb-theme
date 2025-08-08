# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

この「Portal Web Theme」は、モダンなPHP 8の機能を学習しながら開発するWordPressテーマです。PHP 3時代以降の進化を実践的に学べる構成になっています。

## WordPress環境セットアップ

```bash
# ローカル開発環境（例：Local by Flywheel、MAMP、Docker等を使用）
# テーマを wp-content/themes/portalweb にコピー

# WordPress管理画面でテーマを有効化
# 外観 > テーマ > Portal Web Theme を選択
```

## 開発コマンド

```bash
# PHPの構文チェック
php -l functions.php

# WordPress Coding Standardsチェック（要phpcs）
phpcs --standard=WordPress .

# 権限の修正（必要に応じて）
chmod 644 *.php
chmod 755 assets/
```

## テーマ構造

### 必須ファイル
- `style.css` - テーマ情報とスタイル定義
- `index.php` - メインテンプレート（フォールバック）
- `functions.php` - テーマ機能とフック

### 重要テンプレート
- `header.php` - ヘッダー部分
- `footer.php` - フッター部分  
- `single.php` - 個別投稿表示
- `sidebar.php` - サイドバー

### ディレクトリ構造
```
/assets/
  /css/     - 追加スタイルシート
  /js/      - JavaScript ファイル
  /images/  - 画像ファイル
/inc/       - 機能別PHPファイル
/template-parts/ - 再利用可能テンプレート部品
```

## モダンPHP機能の学習ポイント

### PHP 8で使用している機能
1. **タイプヒント・戻り値型宣言**: `function setup(): void`
2. **コンストラクタプロモーション**: `__construct(private readonly string $name)`
3. **nullable型**: `?string`, `string|null`
4. **配列スプレッド演算子**: `[...$array1, ...$array2]`
5. **クラスとオブジェクト指向**: カスタマイザークラス例
6. **セキュリティベストプラクティス**: エスケープ、サニタイズ

### WordPressフック活用
- `after_setup_theme` - テーマ初期設定
- `wp_enqueue_scripts` - CSS/JS読み込み
- `init` - 初期化処理
- `widgets_init` - ウィジェットエリア登録

## カスタマイズガイド

### 新機能追加の流れ
1. `functions.php` に機能を追加
2. 必要に応じて新しいテンプレートファイル作成
3. `style.css` にスタイル追加
4. WordPressの標準的なフックとフィルターを使用

### セキュリティ考慮事項
- 直接アクセス防止: `if (!defined('ABSPATH')) exit;`
- データエスケープ: `esc_url()`, `esc_html()` 等を使用
- サニタイズ: ユーザー入力の適切な処理
- 権限チェック: `current_user_can()` で権限確認

## WordPressテーマ開発のベストプラクティス

1. **テンプレート階層**を理解する
2. **wp_head()** と **wp_footer()** を忘れずに配置
3. **get_template_part()** で再利用性を高める
4. **WordPress Coding Standards** に従う
5. **国際化対応**（i18n）を考慮する

## デバッグとトラブルシューティング

### 開発時のデバッグ
- `WP_DEBUG` を true に設定
- functions.php の開発環境用デバッグ機能を活用
- ブラウザの開発者ツールでHTML構造確認

### よくある問題
- 白い画面: PHP構文エラーをチェック
- スタイル反映されない: キャッシュクリア、ファイルパス確認
- 機能が動かない: フック名、権限、優先度を確認