<?php

namespace App\Events;

use App\Token;

class TokenRefresh
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