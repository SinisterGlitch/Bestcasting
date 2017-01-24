<?php

namespace CoreBundle\Service\Mailer\Handlers;

/**
 * Class PortalAccessHandler
 * @package CoreBundle\Service\Mailer\Handlers
 */
class AccessHandler extends AbstractHandler
{
    /**
     * {@inheritDoc}
     */
    public function execute(array $params)
    {
        $this->sendMailTo($params);
    }

    /**
     * @param array $params
     */
    private function sendMailTo(array $params)
    {
        $provider = $this->getProvider();
        $html = $this->render('portal_access', $params);

        $mailToContext = $this
            ->getMailContext()
            ->setToEmail($params['user']->getEmail())
            ->setToName($params['user']->getFirstname().' '.$params['user']->getLastname())
            ->setSubject('Portal access token')
            ->setBody($html);

        $mailTo = $provider->create($mailToContext);
        $provider->push($mailTo);
    }
}