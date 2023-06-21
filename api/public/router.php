<?php

chdir(__DIR__);

set_exception_handler([$exceptionHandler, 'handleException']);
set_error_handler([$exceptionHandler, 'handleError']);


$filePath = realpath(ltrim($_SERVER["REQUEST_URI"], '/'));
if ($filePath && is_dir($filePath)) {
    $indexFiles = ['index.php', 'index.html'];
    foreach ($indexFiles as $indexFile) {
        $indexFilePath = realpath($filePath . DIRECTORY_SEPARATOR . $indexFile);
        if ($indexFilePath !== false) {
            $filePath = $indexFilePath;
            break;
        }
    }
}

if ($filePath && is_file($filePath)) {
    $baseDir = __DIR__ . DIRECTORY_SEPARATOR;
    $routerFile = $baseDir . 'router.php';
    if (
        strpos($filePath, $baseDir) === 0 &&
        $filePath !== $routerFile &&
        substr(basename($filePath), 0, 1) !== '.'
    ) {
        if (strtolower(substr($filePath, -4)) === '.php') {
            include_once $filePath;
        } else {
            return false;
        }
    } else {
        // Not authorized file
        http_response_code(404);
        echo '404 Not Found';
    }
} else {
    include_once __DIR__ . DIRECTORY_SEPARATOR . 'index.php';
}
