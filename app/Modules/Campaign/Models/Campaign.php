<?php
declare(strict_types=1);

namespace App\Modules\Campaign\Models;

use App\Modules\Campaign\Enums\CampaignStatus;
use App\Modules\Segment\Models\Segment;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['segment_id','subject', 'body', 'status', 'scheduled_at', 'sent_at'])]
class Campaign extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $casts = [
        'status' => CampaignStatus::class
    ];

    public function segment(): BelongsTo
    {
        return $this->belongsTo(Segment::class);
    }
}

