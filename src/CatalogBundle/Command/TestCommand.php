<?php

namespace CatalogBundle\Command;

use CatalogBundle\Entity\Product;
use Doctrine\ORM\EntityManager;
use EavBundle\Entity\EavAttribute;
use EavBundle\Entity\EavGroup;
use EavBundle\Entity\EavValue;
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
        $product = new Product();

        $attribute = new EavAttribute();
        $attribute
            ->setType('string')
            ->setCode('name')
            ->setSearchable(true)
            ->setRequired(true);

        $value = new EavValue();
        $value
            ->setValue('Macbook')
            ->setAttribute($attribute)
            ->setEntity($product);

        $group = new EavGroup();
        $group
            ->addAttribute($attribute)
            ->setCode('General')
            ->setEntity($product);

        $product
            ->setCode('1232')
            ->addGroup($group);

        $this->getManager()->persist($product);
        $this->getManager()->persist($value);
        $this->getManager()->flush();
    }

    /**
     * @return EntityManager
     */
    private function getManager()
    {
        return $this->getContainer()->get('doctrine.orm.entity_manager');
    }
}