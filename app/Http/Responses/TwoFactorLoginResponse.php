<?php

namespace App\Http\Responses;

use Inertia\Inertia;
use Laravel\Fortify\Http\Responses\TwoFactorLoginResponse as TwoFactorLoginResponseBase;

class TwoFactorLoginResponse extends TwoFactorLoginResponseBase
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        if ($request->session()->has('url.intended')) {
            return Inertia::location(session('url.intended'));
        }

        return parent::toResponse($request);
    }
}