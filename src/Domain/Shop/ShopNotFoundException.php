<?php
declare(strict_types=1);

namespace App\Domain\Shop;

use App\Domain\DomainException\DomainRecordNotFoundException;

class ShopNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The shop you requested does not exist.';
}
