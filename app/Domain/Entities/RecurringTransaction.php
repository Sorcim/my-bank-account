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

    public function shouldBeProcessed(DateTimeImmutable $now): bool
    {
        // Vérifie si la transaction doit être exécutée aujourd’hui
        if ($this->endAt && $this->endAt < $now) {
            return false; // Fin de la récurrence
        }

        $interval = match ($this->frequency) {
            'daily' => '+1 day',
            'weekly' => '+1 week',
            'monthly' => '+1 month',
            'yearly' => '+1 year',
            default => null
        };

        if (! $interval) {
            return false;
        }

        return $this->lastProcessedAt === null || $this->lastProcessedAt->modify($interval) <= $now;
    }

    public function markAsProcessed(): void
    {
        $this->lastProcessedAt = new DateTimeImmutable;
    }
}
