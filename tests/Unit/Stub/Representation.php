<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Stub;

use Fschmtt\Keycloak\Attribute\Since;
use Fschmtt\Keycloak\Attribute\Until;

class Representation extends \Fschmtt\Keycloak\Representation\Representation
{
    #[Since('20.0.0')]
    protected ?string $since2000 = null;

    #[Until('14.0.0')]
    protected ?string $until1400 = null;

    #[Since('15.0.0'), Until('18.0.0')]
    protected ?string $since1500Until1800 = null;
}
