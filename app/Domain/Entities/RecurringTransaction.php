<?php

namespace App\Domain\Entities;

use DateTimeImmutable;

class RecurringTransaction
{
    public function __construct(
        public string $id,
        public string $bankAccountId,
        public float $amount,
        public string $description,
        public ?string $categoryId,
        public DateTimeImmutable $startAt,
        public ?DateTimeImmutable $endAt,
        public string $frequency, // 'daily', 'weekly', 'monthly'
        public ?DateTimeImmutable $lastProcessedAt, // Date de la dernière exécution
        public DateTimeImmutable $nextProcessedAt
    ) {}

    public function markAsProcessed(): void
    {
        $now = new DateTimeImmutable;
        $this->lastProcessedAt = $now;
        $this->nextProcessedAt = $this->calculateNextProcessedAt($now);
    }

    private function calculateNextProcessedAt(DateTimeImmutable $now): DateTimeImmutable
    {
        $interval = match ($this->frequency) {
            'daily' => '+1 day',
            'weekly' => '+1 week',
            'monthly' => '+1 month',
            'yearly' => '+1 year',
        };

        return $now->modify($interval);
    }
}
