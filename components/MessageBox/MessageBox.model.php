<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

} else {
    $message = ['message' => 'Forbidden page access mode'];
    echo json_encode($message);
}
