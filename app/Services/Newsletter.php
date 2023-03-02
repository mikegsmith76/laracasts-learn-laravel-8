<?php

namespace App\Services;

interface Newsletter
{
    public function subscribe(string $emailAddress, string $listId = null);
}
