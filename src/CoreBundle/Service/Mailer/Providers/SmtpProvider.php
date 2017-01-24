<?php

namespace CoreBundle\Service\Mailer\Providers;

use CoreBundle\Service\Mailer\MailContext;

/**
 * Class SmtpProvider
 * @package CoreBundle\Service\Mailer\Providers
 */
class SmtpProvider extends AbstractProvider
{
    /**
     * @param MailContext $context
     * @return array
     */
    public function create(MailContext $context)
    {
        // implement SMTP
    }

    /**
     * @param array $params
     * @return string
     */
    public function push(array $params)
    {
        // implement SMTP
    }
}