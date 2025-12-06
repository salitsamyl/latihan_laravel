<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingSetting extends Model
{
    protected $table = 'landing_settings';

    protected $fillable = [
        'key',
        'value',
        'type', // text, json, image, file, dll
        'status'
    ];

    protected $casts = [
        // Otomatis cast semua field 'value' yang type = json menjadi array/object
        'value' => 'json',
    ];

    /**
     * Helper static: ambil value dengan fallback default
     * Usage: LandingSetting::getValue('hero_title', 'Default Title');
     */
    public static function getValue(string $key, $default = null)
    {
        $record = static::where('key', $key)->first();

        if (! $record) {
            return $default;
        }

        // Jika type json, pastikan tetap array/object meski di-cast manual
        if ($record->type === 'json' && is_string($record->value)) {
            $decoded = json_decode($record->value, true);
            return $decoded ?? $default;
        }

        return $record->value ?? $default;
    }

    /**
     * Helper static: simpan atau update setting
     * Usage: LandingSetting::setValue('hero_title', 'Judul Baru');
     *        LandingSetting::setValue('features', ['a', 'b', 'c'], 'json');
     */
    public static function setValue(string $key, $value, string $type = 'text'): bool
    {
        // Jika value berupa array/object → otomatis jadi JSON string
        $val = is_array($value) || is_object($value)
            ? json_encode($value, JSON_UNESCAPED_UNICODE)
            : $value;

        return (bool) static::updateOrCreate(
            ['key' => $key],
            [
                'value' => $val,
                'type'  => $type,
            ]
        );
    }
}
