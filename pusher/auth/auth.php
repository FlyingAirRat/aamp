<?php
$options = array(
    'cluster' => 'ap3',
    'useTLS' => true
);

$pusher = new Pusher\Pusher(
    '7e35ec0a379bddf815bb',
    '7cc5d44fd41e08a19672',
    '1427171',
    $options
);

// You need to define this function for your application, but for testing purposes, it always returns true

function user_is_authenticated()
{

    return true;
}

if (user_is_authenticated()) {
    echo $pusher->socket_auth($_POST['channel_name'], $_POST['socket_id']);
} else {
    header('', true, 403);
    echo "Forbidden";
}
