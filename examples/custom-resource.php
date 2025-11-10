<?php

declare(strict_types=1);

use Fschmtt\Keycloak\Builder;
use Fschmtt\Keycloak\OAuth\GrantType;

/**
 * @method string|null getId()
 * @method self withId(?string $id)
 * @method string getName()
 * @method self|null withName(?string $name)
 */
class MyCustomRepresentation extends \Fschmtt\Keycloak\Representation\Representation
{
    public function __construct(
        protected ?string $id = null,
        protected ?string $name = null,
    ) {}
}

class MyCustomResource extends \Fschmtt\Keycloak\Resource\Resource
{
    public function myCustomEndpoint(): MyCustomRepresentation
    {
        return $this->queryExecutor->executeQuery(
            new \Fschmtt\Keycloak\Http\Query(
                '/my-custom-endpoint',
                MyCustomRepresentation::class,
            ),
        );
    }
}

$keycloak = (new Builder())
    ->withBaseUrl($_SERVER['KEYCLOAK_BASE_URL'] ?? 'http://keycloak:8080')
    ->withGrantType(GrantType::password('admin', 'admin'))
    ->build();

/** @var MyCustomResource $myCustomResource */
$myCustomResource = $keycloak->resource(MyCustomResource::class);
$myCustomRepresentation = $myCustomResource->myCustomEndpoint();
