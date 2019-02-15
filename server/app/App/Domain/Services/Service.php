<?php
namespace App\App\Domain\Services;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
abstract class Service 
{
    use AuthorizesRequests;
    abstract public function handle();
}
