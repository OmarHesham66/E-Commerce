<?php

namespace App\Repository\Cart;


interface IRepositoryCart
{

    public function add();
    public function update();
    public function delete();
    public function empty();
}
