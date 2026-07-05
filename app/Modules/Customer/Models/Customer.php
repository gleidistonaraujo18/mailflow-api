<?php
declare(strict_types=1);

namespace App\Modules\Customer\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'email'])]
class Customer extends Model
{
    use HasUuids;
    protected $keyType = 'string';
    public $incrementing = false;
}
