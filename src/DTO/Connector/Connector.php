<?php

declare(strict_types=1);

namespace Talleu\CohereClient\DTO\Connector;

final class Connector
{
    /**
     * @param null|string[] $excludes
     * @param null|array{authorize_url: string, token_url: string, client_id: string, client_secret: string, scope: string} $oauth
     */
    public function __construct(
        public string             $id,
        public string             $name,
        public \DateTimeImmutable $createdAt,
        public \DateTimeImmutable $updatedAt,
        public ?bool               $active,
        public ?bool               $continueOnFailure,
        public ?string            $organizationId,
        public ?string            $description,
        public ?string            $url,
        public ?array             $excludes,
        public ?string            $authType,
        public ?array             $oauth,
        public ?string            $authStatus,
    )
    {
    }

    /**
     * @param null|array{
     *     id: string,
     *     name: string,
     *     created_at: string,
     *     updated_at: string,
     *     organization_id: string,
     *     description: string,
     *     url: string,
     *     excludes: string[],
     *     auth_type: string,
     *     oauth: array{
     *         authorize_url: string,
     *         token_url: string,
     *         client_id: string,
     *         client_secret: string,
     *         scope: string
     *     },
     *     auth_status: string,
     *     active: bool,
     *     continue_on_failure: bool
     * } $data
     */
    public static function create(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            createdAt: new \DateTimeImmutable($data['created_at']),
            updatedAt: new \DateTimeImmutable($data['updated_at']),
            active: $data['active'] ?? null,
            continueOnFailure: $data['continue_on_failure'] ?? null,
            organizationId: $data['organization_id'] ?? null,
            description: $data['description'] ?? null,
            url: $data['url'] ?? null,
            excludes: $data['excludes'] ?? null,
            authType: $data['auth_type'] ?? null,
            oauth: $data['oauth'] ?? null,
            authStatus: $data['auth_status'] ?? null,

        );
    }
}
