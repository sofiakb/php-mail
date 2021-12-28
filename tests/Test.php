<?php


use PHPUnit\Framework\TestCase;

class Test extends TestCase
{
    
    public function testEmail()
    {
        $this->assertTrue(\Sofiakb\Mail\Facades\Mail::create()
                ->setTo('contact.sofiakb@gmail.com')
                ->subject('sofiakb/php-mail')
                ->text('Message de test'));
    }
    
}