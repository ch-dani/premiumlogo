<?php

namespace App\Models;

class CustomRequestCaptcha
{
    public function custom()
    {
        return new \ReCaptcha\RequestMethod\Post();
    }
}