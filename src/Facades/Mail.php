<?php
/**
 * php-mail
 * This file contains Mail class.
 *
 * Created by PhpStorm on 27/12/2021 at 17:11
 *
 * @author Sofiakb <contact.sofiakb@gmail.com>
 * @package Sofiakb\Mail\Facades
 * @file Sofiakb\Mail\Facades\Mail
 */

namespace Sofiakb\Mail\Facades;

use Sofiakb\Mail\Mailer;
use Sofiakb\Mail\Message;
use Ssf\Support\Env;

/**
 * Class Mail
 * Cette classe contient la logique pour envoyer
 * un email.
 * Dans l'ordre, il faut :
 * - Créer l'objet avec @see Mail::create()
 * - Utiliser la méthode souhaité dans @see Mailer
 *  - @see Mailer::text() qui permet d'envoyer un e-mail texte
 *  - @see Mailer::html() qui permet d'envoyer un e-mail html
 *
 * @package Sofiakb\Mail\Facades
 * @author Sofiakb <contact.sofiakb@gmail.com>
 *
 * @see Mailer
 */
class Mail
{
    /**
     * @param null $from
     * @param null $to
     * @return Mailer
     */
    public static function create($to = null, $from = null): Mailer
    {
        $message = new Message();
        $message->setTo($to ?? Env::get('MAIL_TO'))
            ->setFrom($from ?? Env::get('MAIL_FROM') ?? Env::get('MAIL_USER'));
        return (new Mailer())->message($message);
    }
}