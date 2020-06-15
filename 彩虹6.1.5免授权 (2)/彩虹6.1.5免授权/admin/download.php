<?php
include('../includes/common.php');

if ($islogin != 1)
    exit("<script>window.location.href='./login.php';</script>");

if ($_GET['act'] == 'kms') {
    $tid = intval($_GET['tid']);

    $where = [];

    if (isset($_GET['use']) && $_GET['use'] == 1)
        $where = ['orderid[!]' => 0];
    else if (isset($_GET['use']) && $_GET['use'] == 0)
        $where = ['orderid' => 0];

    $rs = $DB->select('faka', ['pw', 'km'], ['AND' => array_merge(['tid' => $tid], $where), 'ORDER' => ['kid' => 'ASC']]);

    $data = '';
    foreach ($rs as $res) {
        $data .= ($res['pw'] ? $res['km'] . ' ' . $res['pw'] : $res['km']) . "\r\n";
    }

} else {
    $tid     = intval($_GET['tid']);
    $status  = intval($_GET['status']);
    $sign    = intval($_GET['sign']);
    $orderby = ($_GET['orderby'] == 1) ? 'DESC' : 'ASC';

    $tool = $DB->get('tools', ['value'], ['tid' => $tid]);

    $value = $tool['value'] > 0 ? $tool['value'] : 1;

    $date = date('Y-m-d');
    $data = '';

    $rs = $DB->select('orders', '*', [
        'AND'   => [
            'tid'    => $tid,
            'status' => $status
        ],
        'ORDER' => [
            'addtime' => $orderby
        ],
        'LIMIT' => 1000
    ]);

    foreach ($rs as $row) {
        $data .= $row['input'] . ($row['input2'] ? '----' . $row['input2'] : null) . ($row['input3'] ? '----' . $row['input3'] : null) . ($row['input4'] ? '----' . $row['input4'] : null) . ($row['input5'] ? '----' . $row['input5'] : null) . '----' . $row['value'] * $value . "\r\n";
        if ($sign > 0)
            $DB->update('orders', ['status' => $sign], ['id' => $row['id'], 'LIMIT' => 1]);
    }
}

$file_name = 'output_' . $tid . '_' . $date . '__' . time() . '.txt';
$file_size = strlen($data);
header('Content-Description: File Transfer');
header('Content-Type:application/force-download');
header("Content-Length: {$file_size}");
header("Content-Disposition:attachment; filename={$file_name}");
echo $data;
?>