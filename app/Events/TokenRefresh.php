<?php

namespace App\Events;

use App\Token;

class SessionRefresh
{
    /**
     * Session attributes.
     *
     * @var string
     */
    public $session;

    public function __construct(Token $session)
    {
        $this->session = $session;
    }
}