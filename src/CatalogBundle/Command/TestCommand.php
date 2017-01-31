<?php

namespace CatalogBundle\Command;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class TestCommand
 * @package CatalogBundle\Command
 */
class TestCommand extends ContainerAwareCommand
{
    /**
     * Configure
     */
    protected function configure()
    {
        $this->setName('test')->setDescription('Sandbox');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
    }

    /**
     * @return EntityManager
     */
    private function getManager()
    {
        return $this->getContainer()->get('doctrine.orm.entity_manager');
    }

}