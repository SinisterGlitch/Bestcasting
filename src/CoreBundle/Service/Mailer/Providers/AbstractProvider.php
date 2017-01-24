<?php

namespace CoreBundle\Service\Mailer\Providers;

use Symfony\Component\Form\Exception\InvalidConfigurationException;
use CoreBundle\Service\Mailer\MailContext;

/**
 * Class AbstractProvider
 * @package CoreBundle\Service\Mailer\Providers
 */
abstract class AbstractProvider
{
    const PROVIDER_MANDRILL = 'mandrill';

    /**
     * @var array
     */
    protected $options = [];

    /**
     * @param array $options
     */
    public function __construct(array $options)
    {
        $this->options = $options;
    }

    /**
     * @param MailContext $context
     * @return mixed
     */
    abstract public function create(MailContext $context);

    /**
     * @param array $params
     * @return mixed
     */
    abstract public function push(array $params);

    /**
     * @return string
     */
    protected function getApiKey()
    {
        $options = $this->getOption('provider');

        return $options[self::PROVIDER_MANDRILL]['api_key'];
    }

    /**
     * @return string
     */
    protected function getUrl()
    {
        $options = $this->getOption('provider');

        return $options[self::PROVIDER_MANDRILL]['api_url'];
    }

    /**
     * @param string $key
     * @throws InvalidConfigurationException
     * @return string
     */
    public function getOption($key)
    {
        if (!array_key_exists($key, $this->options)) {
            throw new InvalidConfigurationException(
                sprintf('option %s is either invalid or empty', $key)
            );
        }

        return $this->options[$key];
    }
}