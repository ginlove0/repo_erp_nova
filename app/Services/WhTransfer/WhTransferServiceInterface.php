<?php

namespace App\Services\WhTransfer;


interface WhTransferServiceInterface
{
    public function findItemByWhTransfer(int $WhTransferId);
}
