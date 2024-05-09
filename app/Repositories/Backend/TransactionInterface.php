<?php

namespace App\Repositories\Backend;

use Illuminate\Http\Request;

interface TransactionInterface
{
    /**
     * deposit
     *
     * Check if an user is authenticated or not by request
     *
     * @return bool -> true if authenticated, false if not
     */
    public function deposit(Request $request);

    /**
     * withdrawal
     *
     * Register a User By Request Form
     *
     * @return obj $user object
     */
    public function withdrawal(Request $request,$fee);

}
