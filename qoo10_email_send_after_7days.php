<?php
date_default_timezone_set('Asia/Seoul');

// DB 연결
require "/var/www/html8443/mallapi/db_info.php";
$db_conn = mysqli_connect($db_host, $db_user, $db_pwd, $db_category, $db_port);
if (mysqli_connect_errno()) {
    die("DB 연결 실패: " . mysqli_connect_error());
}

// 로그 함수
function log_write2($log_data, $file_name)
{
    $log_dir = '/var/www/html8443/mallapi/qoo10/logs/review/';
    $log_txt = "\r\n";
    $log_txt .= '(' . date("Y-m-d H:i:s") . ')' . "\r\n";
    $log_txt .= $log_data;

    $log_file = fopen($log_dir . $file_name, 'a');
    fwrite($log_file, $log_txt . "\r\n\r\n");
    fclose($log_file);
}

// 1. 7일 전 날짜 계산
$seven_days_ago = date('Y-m-d', strtotime('-7 days'));

// 2. 대상 고객 조회
$sql = "
    SELECT * 
    FROM tb_esim_order_item_sk_red
    WHERE shop = 15
      AND email_send = 0
      AND DATE(send_api_time) = '$seven_days_ago'
";
$result = mysqli_query($db_conn, $sql);

if (!$result) {
    $error_msg = "Query Failed: " . mysqli_error($db_conn);
    log_write2($error_msg, 'qoo10_email_send.log');
    die($error_msg);
}

// 3. 이메일 발송 루프
while ($row = mysqli_fetch_assoc($result)) {
    $seq             = $row['seq'];
    $order_item_code = $row['order_item_code'];
    $buyer_email     = $row['buy_user_email'];
    $name            = $row['buy_user_name'];
    $esim_day        = $row['esim_day'];


    // 템플릿 include (이메일 제목, 헤더, 본문 설정됨)
    include "/var/www/html/mobile_app/mgr/email_contents/qoo10_email_contents_review_7days_jp.php";

    // 이메일 발송
    $result_send = mail($buyer_email, $email_subject, $email_contents, $email_headers);

    if ($result_send) {
        $update = "UPDATE tb_esim_order_item_sk_red SET email_send = 1 WHERE seq = $seq";
        mysqli_query($db_conn, $update);

        $log_msg = " 성공적 이메일 발송 : $buyer_email | 주문 번호: $order_item_code";
    } else {
        $log_msg = " 이메일 발송 실패 : $buyer_email | 주문 번호: $order_item_code";
    }

    // 로그 남기기
    $log_filename = "qoo10_email_send_" . date('Ymd') . ".log";
    log_write2($log_msg, $log_filename);
}
?>
