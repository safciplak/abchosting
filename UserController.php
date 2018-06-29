<?php

class UserController extends BaseController
{

    public function create()
    {
        $user = new User;
        $fields = ['name', 'balance', 'charge_balance'];
        $values = [uniqid(), 100, 0];
        $_SESSION['userId'] = $user->insert('users', $fields, $values);
    }
}