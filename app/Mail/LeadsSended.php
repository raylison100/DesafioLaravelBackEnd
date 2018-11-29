<?php

namespace App\Mail;

use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class LeadsSended extends Mailable
{
    use Queueable, SerializesModels;

    public $data_leads;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct($leads)
    {
        $this->data_leads = $leads;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.leads.leadsEmail');
    }
}
