<?php

declare(strict_types = 1);

namespace Donjan\Permission;

use Hyperf\Utils\Collection;

use Donjan\Permission\Commands\CacheReset;

class ConfigProvider
{

    public function __invoke(): array
    {
        $this->publishMigrations();
    
        return [
            'dependencies' => [],
            'commands' => [],
            'annotations' => [
                'scan' => [
                    'paths' => [
                        __DIR__,
                    ],
                ],
            ],
        ];
    }

    private function publishMigrations()
    {
        $sourcePath = __DIR__ . '/../database/migrations';
        $targetPath = BASE_PATH . '/migrations';
    
        if (! is_dir($targetPath)) {
            mkdir($targetPath, 0755, true);
        }
    
        foreach (glob($sourcePath . '/*.php') as $file) {
            $filename = date('Y_m_d_His') . '_' . basename($file);
            copy($file, $targetPath . '/' . $filename);
        }
    }

}
