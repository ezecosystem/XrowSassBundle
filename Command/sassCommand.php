<?php

namespace Xrow\SassBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use eZ\Publish\Core\MVC\ConfigResolverInterface;
use Xrow\SassBundle\Model\SassHandler;
use Xrow\SassBundle\Model\SassFileHandler;
use Symfony\Component\DependencyInjection\ContainerInterface;
use \Sass as Sass;

class sassCommand extends ContainerAwareCommand
{
    private $configResolver;
    
    public function __construct(ConfigResolverInterface $configResolver, ContainerInterface $container, array $siteAccessList)
    {
        parent::__construct();
        $this->configResolver = $configResolver;
        $this->container = $container;
        $this->kernel = $this->container->get('kernel');
        $this->siteAccessList = $siteAccessList;
    }

    protected function configure()
    {
        $this->setName('sass:compile')->setDescription('compile scss');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $destination = $this->getContainer()->get('kernel')->getRootDir() . "/../web/css/";
        foreach ($this->siteAccessList as $siteaccess)
        {
            $file = $this->configResolver->getParameter( 'file', 'xrow_sass' , $siteaccess );
            $settings = $this->configResolver->getParameter( 'settings', 'xrow_sass' , $siteaccess );
            $this->compile($file, $siteaccess, $settings, $destination);
            $output->writeln("<info>Compiled " . $siteaccess . "</info>");
        }
    }

    public function compile($file, $siteaccessName, $settings, $destination)
    {
        $sass = new Sass();
        $sass->setIncludePath(dirname($file));
        $css = $sass->compile($this->settingsToSCSS($file, $settings));
        file_put_contents($destination . $siteaccessName . ".css", $css);
    }

    private function settingsToSCSS($file, $settings)
    {
        $scss = "";
        foreach ($settings as $key => $value)
        {
            if (!is_array($value))
            {
                $scss .= "$" . $key . ": " . $value . ";\n";
            }
        }
        $scss .= '@import "' . basename($file, ".scss") . '";' . "\n";
        return $scss;
    }
}