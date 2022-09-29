<?php

namespace App\Repositories;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\CustomerRepositoryInterface;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function getCustomerById($idCustomer)
    {
        try {
            return Customer::all()->where('id', $idCustomer)->firstOrFail();
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
    public function CreatedReturnId($req)
    {
        try {
            $customer = new Customer();
            $customer->name = $req['name'];
            $customer->phone = $req['phone'];
            $customer->email = $req['email'] ?? null;
            $customer->address = $req['address'];
            $customer->note = $req['note'] ?? null;
            $customer->payment = (int)Str::replace(',', '', $req['payment']);
            $customer->save();
            return $customer->id;
        } catch (Exception $th) {
            dd($th->getMessage());
            return 0;
        }
    }
}
