<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Enum\OrganizationInvitationStatus;

/**
 * @method string|null getId()
 * @method self withId(?string $id)
 * @method string|null getOrganizationId()
 * @method self withOrganizationId(?string $organizationId)
 * @method string|null getEmail()
 * @method self withEmail(?string $email)
 * @method string|null getFirstName()
 * @method self withFirstName(?string $firstName)
 * @method string|null getLastName()
 * @method self withLastName(?string $lastName)
 * @method int|null getSentDate()
 * @method self withSentDate(?int $sentDate)
 * @method int|null getExpiresAt()
 * @method self withExpiresAt(?int $expiresAt)
 * @method OrganizationInvitationStatus|null getStatus()
 * @method self withStatus(?OrganizationInvitationStatus $status)
 * @method string|null getInviteLink()
 * @method self withInviteLink(?string $inviteLink)
 *
 * @codeCoverageIgnore
 */
class OrganizationInvitation extends Representation
{
    public function __construct(
        protected ?string $id = null,
        protected ?string $organizationId = null,
        protected ?string $email = null,
        protected ?string $firstName = null,
        protected ?string $lastName = null,
        protected ?int $sentDate = null,
        protected ?int $expiresAt = null,
        protected ?OrganizationInvitationStatus $status = null,
        protected ?string $inviteLink = null,
    ) {}
}
