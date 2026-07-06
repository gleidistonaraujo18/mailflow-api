<?php
declare(strict_types=1);

namespace App\Modules\Customer\Models;

use App\Modules\Segment\Models\Segment;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'email'])]
class Customer extends Model
{
    use HasUuids;
    protected $keyType = 'string';
    public $incrementing = false;

    public function segments(): BelongsToMany {
        return $this->belongsToMany(Segment::class, 'customer_segment');
    }

}
