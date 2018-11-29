<?php
/**
 * Created by PhpStorm.
 * User: raylison100
 * Date: 26/11/18
 * Time: 12:21
 */

namespace App\Services;


use App\Mail\LeadsSended;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    public function submit($leads)
    {
        Mail::to('raylison100@gmail.com')->send(new LeadsSended($leads));
    }

}