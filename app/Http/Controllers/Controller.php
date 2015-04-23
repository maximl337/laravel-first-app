<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

    protected   $user,
                $signedIn;
    /**
     * Create a new Controller instance
     */
    function __construct()
    {
        $this->user = $this->signedIn = Auth::user();
    }

}
