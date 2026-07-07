<?php
declare(strict_types=1);

namespace App\Modules\Campaign\Enums;

enum CampaignStatus: string
{
    case Draft      = 'draft';
    case Scheduled  = 'scheduled';
    case Processing = 'processing';
    case Sent       = 'sent';
    case Failed     = 'failed';
}
