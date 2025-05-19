<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

// Start Laravel
define('LARAVEL_START', microtime(true));
require __DIR__ . '/../vendor/autoload.php';

/** @var Application $app */
$app = require_once __DIR__ . '/../bootstrap/app.php';

// Bootstrap the Laravel app
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
    
    DB::connection()->getPdo();
    $dbName = DB::connection()->getDatabaseName();
    echo "✅ Successfully connected to database: <strong>{$dbName}</strong>";
    Log::info("✅ Successfully connected to database: {$dbName}");
} catch (\Exception $e) {
    echo "❌ Could not connect to the database. Error: " . $e->getMessage();
    Log::error("❌ DB connection error: " . $e->getMessage());
}
