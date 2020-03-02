<?php


namespace App\Services\Supplier;


interface SupplierServiceInterface
{
    public function createEmail();

    public function createAddress();

    public function createNote();

    public function createPayment();

    public function create();

}