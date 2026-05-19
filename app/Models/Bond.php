<?php

namespace App\Models;

use App\Notifications\AlertWinner;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bond extends Model
{
    protected $fillable = ['bondNumber', 'bondSeries', 'buying_date'];

    protected $casts = [
        'buying_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function updateStatus()
    {
        // 1. Get all current winning numbers
        $winningMap = DB::table('draws')
            ->pluck('prizePosition', 'drawNumber')
            ->toArray();

        $winningNumbers = array_keys($winningMap);

        // 2. Reset status for bonds that no longer match any draw (e.g., number was changed)
        self::query()
            ->where('isPrizeWon', true)
            ->whereNotIn('bondNumber', $winningNumbers)
            ->update(['isPrizeWon' => false]);

        // 3. Find bonds matching winning numbers that aren't yet marked as winners
        $newWinners = self::query()
            ->whereIn('bondNumber', $winningNumbers)
            ->where(function ($query) {
                $query->where('isPrizeWon', false)
                    ->orWhereNull('isPrizeWon');
            })
            ->with('user')
            ->get();

        if ($newWinners->isNotEmpty()) {
            // 4. Update database status
            self::whereIn('id', $newWinners->pluck('id'))->update(['isPrizeWon' => true]);

            // 5. Notify each user
            foreach ($newWinners as $bond) {
                $position = $winningMap[$bond->bondNumber] ?? 'Winner';

                if ($bond->user) {
                    $bond->user->notify(new AlertWinner($bond, $position));
                }
            }
        }

        return $newWinners->count();
    }
}
