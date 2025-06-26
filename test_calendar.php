<?php
// カレンダー表示
$min_nen = 1950; // 最小年
$max_nen = 2099; // 最大年

// 対象年入力
while (true) {
    // 対象年の入力を促す
    echo "対象年:({$min_nen}～{$max_nen}) ";
    $in_nen = readline();
    if (!is_numeric($in_nen)) {
        echo "数字を入れて下さい。\n";
        continue;
    }
    $in_nen = (int)$in_nen;
    // 入力値が範囲内かチェック
    if ($in_nen < $min_nen || $in_nen > $max_nen) {
        continue;
    }
    break;
}

// 対象月入力
while (true) {
    // 対象月の入力を促す
    echo "対象月:(1～12) ";
    $in_tuki = readline();
    if (!is_numeric($in_tuki)) {
        echo "数字を入れて下さい。\n";
        continue;
    }
    $in_tuki = (int)$in_tuki;
    // 入力値が範囲内かチェック
    if ($in_tuki < 1 || $in_tuki > 12) {
        continue;
    }
    break;
}

// カレンダー表示
function print_calendar($year, $month) {
    $weekdays = ['日', '月', '火', '水', '木', '金', '土'];
    echo "     {$year}年 {$month}月\n";
    foreach ($weekdays as $w) {
        echo "{$w} ";
    }
    echo "\n";

    $first_day = mktime(0, 0, 0, $month, 1, $year);
    $first_weekday = date('w', $first_day);
    $days_in_month = date('t', $first_day);

    // 空白を出力
    for ($i = 0; $i < $first_weekday; $i++) {
        echo "   ";
    }

    for ($day = 1; $day <= $days_in_month; $day++) {
        printf("%2d ", $day);
        if ((($day + $first_weekday) % 7) == 0) {
            echo "\n";
        }
    }
    echo "\n";
}

print_calendar($in_nen, $in_tuki);
?>