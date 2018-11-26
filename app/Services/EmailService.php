<?php
/**
 * Created by PhpStorm.
 * User: raylison100
 * Date: 26/11/18
 * Time: 12:21
 */

namespace App\Services;


use App\Mail\LeedsSended;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    public function submit()
    {
        Mail::to('raylison100@gmail.com')->send(new LeedsSended());
    }

}