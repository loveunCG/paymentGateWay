<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// BotDetect PHP Captcha configuration options
// more details here: https://captcha.com/doc/php/captcha-options.html
// ----------------------------------------------------------------------------

$config = array(
    /*
    |--------------------------------------------------------------------------
    | Captcha configuration for basic page
    |--------------------------------------------------------------------------
    */
    'ExampleCaptcha' => array(
        'UserInputID' => 'CaptchaCode',
        'ImageWidth' => 200,
        'ImageHeight' => 42.8,
        'SoundEnabled'=> false,
        'CodeLength' => CaptchaRandomization::GetRandomCodeLength(4, 4),
        'ImageStyle' => ImageStyle::Graffiti,
    ),

    /*
    |--------------------------------------------------------------------------
    | Captcha configuration for contact page
    |--------------------------------------------------------------------------
    */
    'ContactCaptcha' => array(
        'UserInputID' => 'CaptchaCode',
        'CodeLength' => CaptchaRandomization::GetRandomCodeLength(4, 6),
        'ImageStyle' => ImageStyle::AncientMosaic,
    ),

    // Add more your Captcha configuration here...
);
