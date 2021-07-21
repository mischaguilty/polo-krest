<?php

namespace App\Models;

use App\Traits\HasAddress;
use App\Traits\HasPhones;
use App\Traits\HasWorkings;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Office extends Model
{
    use HasFactory;
    use HasAddress;
    use HasPhones;
    use HasWorkings;

    protected $table = 'offices';

    protected $fillable = [
        'company_id',
        'name',
        'description',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
}
