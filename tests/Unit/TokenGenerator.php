<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit;

use DateTimeImmutable;
use Lcobucci\JWT\Encoding\ChainedFormatter;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Token;
use Lcobucci\JWT\Token\Builder;

trait TokenGenerator
{
    private function generateToken(DateTimeImmutable $expiresAt): Token
    {
        // @phpstan-ignore-next-line
        $tokenBuilder = (new Builder(new JoseEncoder(), ChainedFormatter::default()));
        $algorithm = new Sha256();
        $signingKey = InMemory::plainText(random_bytes(32));

        return $tokenBuilder
            ->issuedAt(new DateTimeImmutable())
            ->expiresAt($expiresAt)
            ->getToken($algorithm, $signingKey);
    }
}
