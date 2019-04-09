<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Token;

class TokenTransformers extends TransformerAbstract
{
    /**
     * Transform Session.
     *
     * @param Session $session
     */
    public function transform(Token $session)
    {
        return [
            'session_username' => $session->Token_Username,
            'session_password' => $session->Token_Password,
            'generated_at' => $session->created_at->toDateTimeString(),
            'lastused_at' => $session->updated_at->toDateTimeString(),
        ];
    }
}