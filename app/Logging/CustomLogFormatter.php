<?php

namespace App\Logging;

use Monolog\Handler\RotatingFileHandler;

class CustomLogFormatter
{
    public function __invoke($logger)
    {
        foreach ($logger->getHandlers() as $handler) {
            if ($handler instanceof RotatingFileHandler) {
                $handler->setFilenameFormat('{date}-{filename}', 'Y-m-d');
                $handler->setMaxFiles(7); // Simpan log selama 7 hari
                $handler->setFilePermission(0644);
                $handler->setBubble(true);
                $handler->setRotationSize(10 * 1024 * 1024); // 10MB
            }
        }
    }
}
