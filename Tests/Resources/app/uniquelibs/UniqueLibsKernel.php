<?php

use Symfony\Cmf\Component\Testing\HttpKernel\TestKernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class UniqueLibsKernel extends TestKernel
{
    public function configure()
    {
        $this->addBundles(array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),

            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),

            new Liip\FunctionalTestBundle\LiipFunctionalTestBundle(),

            new UniqueLibs\RequestToQueryBuilderBundle\UniqueLibsRequestToQueryBuilderBundle(),
            new UniqueLibs\RequestToQueryBuilderTestBundle\UniqueLibsRequestToQueryBuilderTestBundle(),
        ));
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config.php');
    }
}