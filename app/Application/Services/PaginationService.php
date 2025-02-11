<?php

namespace App\Application\Services;

class PaginationService {
    public static function generatePaginationNumbers(int $currentPage, int $lastPage, int $delta = 1): array
    {
        $pages = [];

        $pages[] = 1;
        if ($lastPage > 1) {
            $pages[] = $lastPage;
        }

        for ($i = $currentPage - $delta; $i <= $currentPage + $delta; $i++) {
            if ($i > 1 && $i < $lastPage) {
                $pages[] = $i;
            }
        }

        sort($pages);
        $finalPages = [];
        $previous = null;

        foreach ($pages as $page) {
            if ($previous !== null && $page - $previous > 1) {
                $finalPages[] = '...';
            }
            $finalPages[] = $page;
            $previous = $page;
        }

        return $finalPages;
    }
}
