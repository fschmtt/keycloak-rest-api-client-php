<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Resource;

use Fschmtt\Keycloak\Http\Client;
use Fschmtt\Keycloak\Http\CommandExecutor;
use Fschmtt\Keycloak\Http\CustomCommand;
use Fschmtt\Keycloak\Http\CustomQuery;
use Fschmtt\Keycloak\Http\QueryExecutor;
use Psr\Http\Message\ResponseInterface;

class Custom extends Resource
{
    public function __construct(
        CommandExecutor $commandExecutor,
        QueryExecutor $queryExecutor,
        private readonly Client $client,
    ) {
        parent::__construct($commandExecutor, $queryExecutor);
    }

    public function query(CustomQuery $query): mixed
    {
        return $this->queryExecutor->executeQuery($query);
    }

    public function command(CustomCommand $command): void
    {
        $this->commandExecutor->executeCommand($command);
    }

    /**
     * @param array<string, mixed> $options
     */
    public function request(string $method, string $path, array $options = []): ResponseInterface
    {
        return $this->client->request($method, $path, $options);
    }
}
