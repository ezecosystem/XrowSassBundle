<?php

namespace Xrow\SassBundle\Model;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SassHandler
{
    private $container;

    public function __construct(ContainerInterface $container, $currentSiteaccess)
    {
        $this->container = $container;
        $this->kernel = $this->container->get('kernel');
        $this->path =  $this->kernel->locateResource("@XrowSassBundle/Resources/scss/test.scss");
        $this->dir = dirname($this->path);
        $this->base = basename($this->path, ".scss");
        $this->siteaccess = $currentSiteaccess->name;
        $this->web = $this->kernel->getRootDir() . "/../web/css/";
        var_dump($this->siteaccess);
    }
    
    public function generate()
    {
        $siteaccesses = $this->container->getParameter('sass.siteaccess');
        
        
        $cache = $this->kernel->getCacheDir() . "/";
        
        var_dump($this->path);
        var_dump($cache);
        
        echo "<br>";
        foreach( $siteaccesses as $name => $siteaccess)
        {
            $variables = $cache . $name . "_variables.scss";
            file_put_contents($variables, $this->scssBuilder($siteaccess["settings"]) );
            $command = "sass -I ". $this->dir . " " . $variables . ":" . $this->web . $name . ".css  --sourcemap=none";
            var_dump($command);
        }
        var_dump($this->fetchCSS());
    }
    
    private function scssBuilder($siteaccess)
    {
        $scss = "";
        foreach ($siteaccess as $key => $value)
        {
            if (!is_array($value))
            {
                $scss .= "$" . $key . ": " . $value . ";\n";
            }
        }
        $scss .= '@import "' . $this->base . '";' . "\n";
        return $scss;
    }
    
    public function fetchCSS()
    {
        $path = "/css/" . $this->siteaccess . ".css";
       
        return $path;
    }
}
