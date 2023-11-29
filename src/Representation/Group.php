<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Attribute\Since;
use Fschmtt\Keycloak\Collection\GroupCollection;
use Fschmtt\Keycloak\Type\Map;

/**
 * @method Map|null getAccess()
 * @method Map|null getAttributes()
 * @method Map|null getClientRoles()
 * @method string|null getId()
 * @method string|null getName()
 * @method string|null getPath()
 * @method string[]|null getRealmRoles()
 * @method int|null getSubGroupCount()
 * @method Group[]|null getSubGroups()
 * @method self withAccess(?Map $access)
 * @method self withAttributes(?Map $attributes)
 * @method self withClientRoles(?Map $clientRoles)
 * @method self withId(?string $id)
 * @method self withName(?string $name)
 * @method self withPath(?string $path)
 * @method self withRealmRoles(?array $realmRoles)
 * @method self withSubGroupCount(?int $subGroupCount)
 * @method self withSubGroups(?array $subGroups)
 *
 * @codeCoverageIgnore
 */
class Group extends Representation
{
    public function __construct(
        protected ?Map $access = null,
        protected ?Map $attributes = null,
        protected ?Map $clientRoles = null,
        protected ?string $id = null,
        protected ?string $name = null,
        protected ?string $path = null,
        /** @var string[]|null */
        protected ?array $realmRoles = null,
        #[Since('23.0.0')]
        protected ?int $subGroupCount = null,
        protected ?GroupCollection $subGroups = null,
    ) {
    }
}
