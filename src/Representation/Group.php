<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Attribute\Since;
use Fschmtt\Keycloak\Collection\GroupCollection;
use Fschmtt\Keycloak\Type\Map;

/**
 * @method Map|null getAccess()
 * @method self withAccess(?Map $access)
 *
 * @method Map|null getAttributes()
 * @method self withAttributes(?Map $attributes)
 *
 * @method Map|null getClientRoles()
 * @method self withClientRoles(?Map $clientRoles)
 *
 * @method string|null getId()
 * @method self withId(?string $id)
 *
 * @method string|null getName()
 * @method self withName(?string $name)
 *
 * @method string|null getParentId()
 * @method self withParentId(?string $parentId)
 *
 * @method string|null getPath()
 * @method self withPath(?string $path)
 *
 * @method string[]|null getRealmRoles()
 * @method self withRealmRoles(?string[] $realmRoles)
 *
 * @method int|null getSubGroupCount()
 * @method self withSubGroupCount(?int $subGroupCount)
 *
 * @method GroupCollection|null getSubGroups()
 * @method self withSubGroups(?GroupCollection[] $subGroups)
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
        #[Since('23.0.0')]
        protected ?string $parentId = null,
        protected ?string $path = null,
        /** @var string[]|null */
        protected ?array $realmRoles = null,
        #[Since('23.0.0')]
        protected ?int $subGroupCount = null,
        protected ?GroupCollection $subGroups = null,
    ) {}
}
