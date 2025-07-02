<?php
// 이 파일은 리뷰 이벤트 안내 이메일 콘텐츠를 생성합니다.
// 사전에 아래 변수가 정의되어 있어야 합니다:
// $order_item_code, $name, $product_name

$email_subject = "[Korea SIM] Qoo10レビュー投稿でポイントGET！";
$email_headers = "From: Korea SIM <cs@koreaesim.com>\r\n";
$email_headers .= "Content-type: text/html; charset=utf-8\r\n";

$email_contents = <<<HTML
<div style="font-family: Arial, sans-serif; line-height:1.6; color:#333; max-width:600px; margin:0 auto;">

  <!-- 헤더 -->
  <h2 style="text-align:center; color:#e50000;">Korea SIM カスタマーサポート</h2>
  <p style="text-align:center; font-size:0.9em; color:#777;">
    平素よりKorea SIMをご愛顧いただき、誠にありがとうございます。
  </p>
  <hr style="border:none; border-top:2px solid #f8d7da; margin:20px 0;">

  <!-- Qoo10 구매 안내 -->
  <p style="margin:0 0 10px 0;">
    <strong>Qoo10</strong>にて当店の商品<strong>（注文番号：{$order_item_code}）</strong>を
    ご購入いただき、重ねて御礼申し上げます。
  </p>

  <p><strong>{$name}様</strong></p>

  <!-- 상품명 -->
  <p style="margin:0 0 20px 0; color:#555;">
    ご購入商品：<em>{$esim_day}</em>
  </p>

  <!-- 핵심 박스 -->
  <div style="background:#fff5f5; padding:15px; border-radius:5px; margin-bottom:20px;">
    <p style="margin-top:0; font-weight:bold; color:#e50000;">
      🎁 期間限定レビューイベント開催中！
    </p>
    <p style="margin:0;">ご使用感はいかがでしょうか？</p>
    <hr style="border:none; border-top:1px dashed #f5c6cb; margin:15px 0;">
    <p style="margin:0;">
      <span style="color:#e50000; font-weight:bold;">レビュー投稿で100Qポイント</span>プレゼント！<br>
      さらに<span style="color:#e50000; font-weight:bold;">ショップフォローで10%OFFクーポン</span>も進呈！
    </p>
  </div>

  <!-- CTA 버튼 -->
  <p style="text-align:center; margin-bottom:30px;">
    <a href="https://www.qoo10.jp/shop/KoreaSIM" style="display:inline-block; background:#e50000; color:#fff;
       text-decoration:none; padding:12px 20px; border-radius:4px;">
       レビュー＆フォローはこちら
    </a>
  </p>

  <hr style="border:none; border-top:2px solid #f8d7da; margin:20px 0;">

  <!-- 푸터 -->
  <p style="font-size:0.9em; color:#777;">
    ご不明点はお気軽にお問い合わせください。<br>
    今後とも <strong>Korea SIM</strong> をよろしくお願いいたします。
  </p>
  <p style="font-size:0.8em; color:#aaa; text-align:center; margin:30px 0 0;">
    Korea SIM カスタマーサポート｜cs@prepia.co.kr
  </p>

</div>
HTML;
?>
