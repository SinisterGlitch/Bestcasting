<?php

namespace CoreBundle\Service\Mailer;

use CoreBundle\Service\Mailer\Handlers\AbstractHandler;
use CoreBundle\Service\Mailer\Providers\AbstractProvider;

/**
 * Class MailManager
 * @package CoreBundle\Service\Mailer
 */
class MailManager
{
    /**
     * @var AbstractProvider[]
     */
    private $providers;

    /**
     * @var AbstractHandler[]
     */
    private $handlers = [];

    /**
     * @param $key
     * @param AbstractProvider $provider
     */
    public function addProvider($key, AbstractProvider $provider)
    {
        $this->providers[$key] = $provider;
    }

    /**
     * @param $key
     * @return AbstractProvider
     */
    private function getProvider($key)
    {
        if (!array_key_exists($key, $this->providers)) {
            throw new \LogicException(sprintf('provider with key %s not found', $key));
        }

        return $this->providers[$key];
    }

    /**
     * @param $key
     * @param AbstractHandler $handler
     */
    public function addHandler($key, AbstractHandler $handler)
    {
        $this->handlers[$key] = $handler;
    }

    /**
     * @param $key
     * @return AbstractHandler
     */
    private function getHandler($key)
    {
        if (!array_key_exists($key, $this->handlers)) {
            throw new \LogicException(sprintf('handler with key %s not found', $key));
        }

        return $this->handlers[$key];
    }

    /**
     * @param string $handlerKey
     * @param array $params
     * @param string $providerKey
     * @return MailContext
     */
    public function send($handlerKey, array $params, $providerKey = AbstractProvider::PROVIDER_MANDRILL)
    {
        $provider = $this->getProvider($providerKey);
        $handler = $this->getHandler($handlerKey);

        return $handler
            ->setProvider($provider)
            ->execute($params);
    }
}