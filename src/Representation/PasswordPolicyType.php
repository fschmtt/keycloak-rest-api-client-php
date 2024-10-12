<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

/**
 * @method string|null getConfigType()
 * @method string|null getDefaultValue()
 * @method string|null getDisplayName()
 * @method string|null getId()
 * @method bool|null getMultipleSupported()
 * @method self withConfigType(?string $configType)
 * @method self withDefaultValue(?string $defaultValue)
 * @method self withDisplayName(?string $displayName)
 * @method self withId(?string $name)
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
