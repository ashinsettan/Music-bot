<?php
require 'vendor/autoload.php';

use danog\MadelineProto\API;
use danog\MadelineProto\Settings\AppInfo;

echo "API ID: ";
$api_id = trim(fgets(STDIN)); // Get API ID input
echo "API HASH: ";
$api_hash = trim(fgets(STDIN)); // Get API HASH input

// Define settings
$settings = [
    'app_info' => [
        'api_id' => (int) $api_id,
        'api_hash' => $api_hash,
        'device_model' => 'MyTelegramBot',
        'system_version' => 'PHP',
        'app_version' => '1.0',
    ],
    'serialization' => [
        'serialization_interval' => 300,
        'cleanup_before_serialization' => true,
    ],
    'logger' => [
        'logger_level' => 0,
    ]
];

// Initialize MadelineProto
try {
    $MadelineProto = new API('session.madeline', $settings);
    $MadelineProto->start(); // Start the session and log in
    echo "Session string: " . $MadelineProto->export_session() . PHP_EOL;
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage() . PHP_EOL;
}
?>
