<?php


namespace Talleu\CohereClient\DTO\FineTuning;

final class Chronology
{
    /**
     * @param Event[] $events
     */
    public function __construct(
        public array   $events,
        public ?string $nextPageToken,
        public ?int    $totalSize
    ) {
    }

    public static function create(array $data): self
    {
        $events = [];
        foreach ($data['events'] as $event) {
            $events[] = Event::create($event);
        }

        return new self(
            events: $events,
            nextPageToken: $data['next_page_token'] ?? null,
            totalSize: $data['total_size'] ?? null
        );
    }
}
