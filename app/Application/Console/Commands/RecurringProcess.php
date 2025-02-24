<?php

namespace App\Application\Console\Commands;

use App\Domain\UseCases\RecurringTransaction\ProcessRecurringTransactionUseCase;
use Illuminate\Console\Command;

class RecurringProcess extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:recurring-process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lunch process to pass recurring transaction to transaction';

    public function __construct(private ProcessRecurringTransactionUseCase $processRecurringTransaction)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->processRecurringTransaction->execute();

        return self::SUCCESS;
    }
}
