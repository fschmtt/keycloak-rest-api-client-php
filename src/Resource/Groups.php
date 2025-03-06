<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Resource;

use Fschmtt\Keycloak\Collection\GroupCollection;
use Fschmtt\Keycloak\Collection\UserCollection;
use Fschmtt\Keycloak\Http\Command;
use Fschmtt\Keycloak\Http\Criteria;
use Fschmtt\Keycloak\Http\Method;
use Fschmtt\Keycloak\Http\Query;
use Fschmtt\Keycloak\Representation\Group;
use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\ResponseInterface;

class Groups extends Resource
{
    public function all(string $realm, ?Criteria $criteria = null): GroupCollection
    {
        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/groups',
                GroupCollection::class,
                [
                    'realm' => $realm,
                ],
                $criteria,
            ),
        );
    }

    public function byPath(string $realm, string $path = ''): Group
    {
        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/group-by-path/{path}',
                Group::class,
                [
                    'realm' => $realm,
                    'path' => $path,
                ],
            ),
        );
    }

    public function children(string $realm, string $groupId, ?Criteria $criteria = null): GroupCollection
    {
        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/groups/{groupId}/children',
                GroupCollection::class,
                [
                    'realm' => $realm,
                    'groupId' => $groupId,
                ],
                $criteria,
            ),
        );
    }

    public function members(string $realm, string $groupId, ?Criteria $criteria = null): UserCollection
    {
        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/groups/{groupId}/members',
                UserCollection::class,
                [
                    'realm' => $realm,
                    'groupId' => $groupId,
                ],
                $criteria,
            ),
        );
    }

    public function get(string $realm, string $groupId): Group
    {
        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/groups/{groupId}',
                Group::class,
                [
                    'realm' => $realm,
                    'groupId' => $groupId,
                ],
            ),
        );
    }

    public function create(string $realm, Group $group): Group
    {
        $response = $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/groups',
                Method::POST,
                [
                    'realm' => $realm,
                ],
                $group,
            ),
        );

        $groupId = $this->getIdFromResponse($response);

        if (null === $groupId) {
            throw new \RuntimeException('Could not extract group id from response');
        }

        return $this->get($realm, $groupId);
    }

    public function createChild(string $realm, Group $group, string $parentGroupId): Group
    {
        $response = $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/groups/{groupId}/children',
                Method::POST,
                [
                    'realm' => $realm,
                    'groupId' => $parentGroupId,
                ],
                $group,
            ),
        );

        $groupId = $this->getIdFromResponse($response);

        if (null === $groupId) {
            throw new \RuntimeException('Could not extract group id from response');
        }

        return $this->get($realm, $groupId);
    }

    public function update(string $realm, string $groupId, Group $updatedGroup): ResponseInterface
    {
        return $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/groups/{groupId}',
                Method::PUT,
                [
                    'realm' => $realm,
                    'groupId' => $groupId,
                ],
                $updatedGroup,
            ),
        );
    }

    public function delete(string $realm, string $groupId): ResponseInterface
    {
        return $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/groups/{groupId}',
                Method::DELETE,
                [
                    'realm' => $realm,
                    'groupId' => $groupId,
                ],
            ),
        );
    }

    public function getIdFromResponse(ResponseInterface $response): ?string
    {
        //Location: http://keycloak:8080/admin/realms/{realm}/groups/1ccce35d-eeac-4eb7-90ec-268abc98c864
        $location = $response->getHeaderLine('Location');

        preg_match('~/groups/(?<id>[a-z0-9\-]+)$~', $location, $matches);

        return $matches['id'] ?? null;
    }
}
