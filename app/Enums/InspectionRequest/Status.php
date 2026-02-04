<?php

namespace App\Enums\InspectionRequest;

enum Status : string
{
    case Pending = 'pending';

    case Completed = 'completed';

    case Cancelled = 'cancelled';

}
