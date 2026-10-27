<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class WaClickLog extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'action_type',
        'item_type',
        'item_id',
        'source_page',
        'ip_hash',
        'user_agent',
        'created_at',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
        ];
    }

    public static function record(string $actionType, ?string $itemType = null, ?int $itemId = null, ?string $sourcePage = null, ?Request $request = null): ?self
    {
        // Cek apakah analitik diaktifkan di settings
        if (! setting('analytics.enable_wa_logging', true)) {
            return null;
        }

        $req = $request ?? request();
        $ip = $req?->ip() ?? '127.0.0.1';
        $ipHash = hash('sha256', $ip . config('app.key'));
        $ua = substr((string) ($req?->userAgent() ?? ''), 0, 255);

        return static::create([
            'action_type' => $actionType,
            'item_type' => $itemType,
            'item_id' => $itemId,
            'source_page' => $sourcePage ?? url()->current(),
            'ip_hash' => $ipHash,
            'user_agent' => $ua,
            'created_at' => now(),
        ]);
    }
}
