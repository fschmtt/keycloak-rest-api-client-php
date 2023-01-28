<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\Import\NoUnusedImportsFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function(ECSConfig $config): void {
    $config->sets([
        SetList::PSR_12,
        SetList::ARRAY,
        SetList::STRICT,
        SetList::PHPUNIT,
    ]);

    $config->rules([
        NoUnusedImportsFixer::class,
    ]);

    $config->paths([
        'src',
        'tests',
        'examples',
    ]);

    $config->parallel();
};
