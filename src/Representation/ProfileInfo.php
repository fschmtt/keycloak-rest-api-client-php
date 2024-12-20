<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

/**
 * @method string[]|null getDisabledFeatures()
 * @method self withDisabledFeatures(?string[] $value)
 *
 * @method string[]|null getExperimentalFeatures()
 * @method self withExperimentalFeatures(?string[] $value)
 *
 * @method string|null getName()
 * @method self withName(?string $value)
 *
 * @method string[]|null getPreviewFeatures()
 * @method self withPreviewFeatures(?string[] $value)
 *
 * @codeCoverageIgnore
 */
class ProfileInfo extends Representation
{
    public function __construct(
        /** @var string[]|null */
        protected ?array $disabledFeatures = null,
        /** @var string[]|null */
        protected ?array $experimentalFeatures = null,
        protected ?string $name = null,
        /** @var string[]|null */
        protected ?array $previewFeatures = null,
    ) {}
}
