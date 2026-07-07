<?php

namespace App\Modules\Segment\Models;

use App\Modules\Customer\Models\Customer;
use Database\Factories\SegmentFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'description'])]
class Segment extends Model
{
    use HasUuids, HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    public function customers(): BelongsToMany
    {
        return $this->belongsToMany(Customer::class, 'customer_segment');
    }

    protected static function newFactory(): SegmentFactory
    {
        return SegmentFactory::new();
    }
}
