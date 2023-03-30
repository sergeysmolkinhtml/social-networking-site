<?php

namespace App\Service;

use App\Models\User;

class TransactionService
{

    public function calculateTaxes($userId): float|int
    {
        $user = User::find($userId);

        if (!$user || $user->is_taxed) {
            return 0;
        }

        $income = Income::where('user_id', $userId)
            ->whereBetween('entry_date', [
                now()->subYear()->startOfYear(),
                now()->subYear()->endOfYear(),
            ])
            ->sum('amount');

        return ($income > 50000)
            ? $income * 0.2
            : $income * 0.15;
    }

}
