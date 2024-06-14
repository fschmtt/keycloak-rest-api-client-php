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

$serializer = new Serializer([
    new BackedEnumNormalizer(),
    new \Fschmtt\Keycloak\Serializer\CollectionDenormalizer($propertyNormalizer),
    new \Fschmtt\Keycloak\Serializer\AttributeNormalizer($propertyNormalizer, '18.0.0'),
    $propertyNormalizer
], [
    new JsonEncoder(),
],
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

$response = $httpClient->request('GET', '/admin/realms/master');

$json = $response->getBody()->getContents();

$realm = $serializer->deserialize($json, \Fschmtt\Keycloak\Representation\Realm::class, 'json');

var_dump($serializer->serialize($realm, 'json'));

var_dump($serializer->deserialize(['foo' => 'bar'],));
