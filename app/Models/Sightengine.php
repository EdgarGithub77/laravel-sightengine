<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sightengine extends Model
{
    use HasFactory;

    const API_MODELS = 'nudity-2.0,wad,properties,celebrities,offensive,faces,scam,text-content,face-attributes,gore,text,qr-content';

    /**
     * @var string
     */
    protected $table = 'sightengines';

    /**
     * @var string[]
     */
    protected $fillable = [
        'sightengine_data',
    ];

    /**
     * @param $value
     */
    public function setSightengineDataAttribute($value)
    {
        $this->attributes['sightengine_data'] = json_encode($value);
    }
}
