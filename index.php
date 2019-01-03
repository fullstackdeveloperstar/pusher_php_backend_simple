<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    header("Access-Control-Allow-Headers: *");
    require __DIR__ . '/vendor/autoload.php';
    $postdata = json_decode(file_get_contents('php://input'), true);
    
    $data['sender'] = $postdata['sender'];
    $data['receiver'] = $postdata['receiver'];
    $data['message'] = $postdata['message'];
    if ($data['message'] == "") {
        exit();
    }

    $options = array(
        'cluster' => 'us2',
        'useTLS' => true
    );

    $pusher = new Pusher\Pusher(
        '64a9f0ddad38c595ba94',
        '5625fd971034d24257c2',
        '676628',
        $options
    );

    $pusher->trigger('my-channel', 'my-event', $data);
    echo json_encode($data);
?>