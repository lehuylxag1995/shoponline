<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface CustomerRepositoryInterface
{
    /**
     *
     * Thêm 1 bản ghi trả về Id bản ghi vừa thêm
     * @param array $req
     * @return int $id
     */
    public function CreatedReturnId($req);

    /**
     * Lấy model customer bằng Id
     *
     * @param int $idCustomer
     * @return model
     */
    public function getCustomerById($idCustomer);
}
