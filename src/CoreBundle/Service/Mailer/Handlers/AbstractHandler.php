<?php

namespace CoreBundle\Service\Mailer\Handlers;

use Doctrine\ORM\EntityManager;
use CoreBundle\Service\Mailer\MailContext;
use CoreBundle\Service\Mailer\Providers\AbstractProvider;

/**
 * Class AbstractHandler
 * @package CoreBundle\Service\Mailer\Handlers
 */
abstract class AbstractHandler
{
    const TEMPLATE_PATH = 'mail';
    const TWIG_EXTENSION = '.html.twig';

    /**
     * @var MailContext
     */
    private $context;

    /**
     * @var EntityManager
     */
    private $manager;

    /**
     * @var AbstractProvider
     */
    private $provider;

    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * @param MailContext $context
     * @param \Twig_Environment $twig
     * @param EntityManager $manager
     */
    public function __construct(MailContext $context, EntityManager $manager, \Twig_Environment $twig)
    {
        $this->context = $context;
        $this->manager = $manager;
        $this->twig = $twig;
    }

    /**
     * @param array $params
     * @return mixed
     */
    abstract public function execute(array $params);

    /**
     * @param AbstractProvider $provider
     * @return $this
     */
    public function setProvider(AbstractProvider $provider)
    {
        $this->provider = $provider;

        return $this;
    }

    /**
     * @return AbstractProvider
     */
    protected function getProvider()
    {
        return $this->provider;
    }

    /**
     * @param string $template
     * @param array $params
     * @return string
     */
    protected function render($template, array $params)
    {
        $templatePath = self::TEMPLATE_PATH.DIRECTORY_SEPARATOR.$template.self::TWIG_EXTENSION;

        return $this->twig->render($templatePath, $params);
    }

    /**
     * @return MailContext
     */
    protected function getMailContext()
    {
        return $this->context;
    }

    /**
     * @return EntityManager
     */
    protected function getManager()
    {
        return $this->manager;
    }
}