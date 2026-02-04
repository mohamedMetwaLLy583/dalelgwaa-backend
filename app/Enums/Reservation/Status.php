<?php

namespace App\Enums\Reservation;

enum Status : string
{
    case Pending = 'pending';

    case Completed = 'completed';

    case Cancelled = 'cancelled';

}
