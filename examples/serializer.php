<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client as GuzzleClient;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\BackedEnumNormalizer;
use Symfony\Component\Serializer\Serializer;

$classMetadataFactory = new \Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory(
    new \Symfony\Component\Serializer\Mapping\Loader\AttributeLoader(),
);

$metadataAwareNameConverter = new \Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter($classMetadataFactory);

$propertyNormalizer = new \Symfony\Component\Serializer\Normalizer\PropertyNormalizer($classMetadataFactory, $metadataAwareNameConverter);

$serializer = new Serializer(
    [new BackedEnumNormalizer(), new \Fschmtt\Keycloak\Serializer\CollectionDenormalizer($propertyNormalizer), $propertyNormalizer],
    [new JsonEncoder()],
);

$tokenStorage = new \Fschmtt\Keycloak\OAuth\TokenStorage\InMemory();

$httpClient = new \Fschmtt\Keycloak\Http\Client(
    new \Fschmtt\Keycloak\Keycloak(
        $_SERVER['KEYCLOAK_BASE_URL'] ?? 'http://keycloak:8080',
        'admin',
        'admin',
        $tokenStorage
    ),
    new GuzzleClient(),
    $tokenStorage,
);

$response = $httpClient->request('GET', '/admin/realms/master/clients/9d46e473-01b6-41e0-8dee-0077bea00514/authz/resource-server/resource');

$json = $response->getBody()->getContents();

$resourceServer = $serializer->deserialize($json, \Fschmtt\Keycloak\Collection\ResourceCollection::class, 'json');

var_dump($resourceServer);

var_dump($serializer->serialize($resourceServer, 'json'));


