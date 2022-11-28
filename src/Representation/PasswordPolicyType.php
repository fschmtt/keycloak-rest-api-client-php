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
    protected ?string $configType;

    protected ?string $defaultValue;

    protected ?string $displayName;

    protected ?string $id;

    protected ?bool $multipleSupported;
}
