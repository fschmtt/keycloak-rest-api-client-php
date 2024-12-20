<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

/**
 * @method string|null getConfigType()
 * @method self withConfigType(?string $configType)
 *
 * @method string|null getDefaultValue()
 * @method self withDefaultValue(?string $defaultValue)
 *
 * @method string|null getDisplayName()
 * @method self withDisplayName(?string $displayName)
 *
 * @method string|null getId()
 * @method self withId(?string $name)
 *
 * @method bool|null getMultipleSupported()
 * @method self withMultipleSupported(?bool $multipleSupported)
 *
 * @codeCoverageIgnore
 */
class PasswordPolicyType extends Representation
{
    public function __construct(
        protected ?string $configType = null,
        protected ?string $defaultValue = null,
        protected ?string $displayName = null,
        protected ?string $id = null,
        protected ?bool $multipleSupported = null,
    ) {}
}
