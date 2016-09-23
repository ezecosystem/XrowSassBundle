## XrowSassBundle ##
### Requirements ###
You will need to install https://github.com/sensational/sassphp
### Configuration ###

Either add ```xrow/sass-bundle``` to you composer.json or run ```composer require xrow/sass-bundle```.
```json
"require": {
    "xrow/sass-bundle": "~1.0", 
},
```
Make sure the Bundle is loaded in EzPublishKernel.php or AppKernel.php
```php
public function registerBundles()
{
    $bundles = array(
            new Xrow\SassBundle\XrowSassBundle(),
    );
}
```

Configure the siteaccess settings in a loaded configuration file (i.e. Config.yml)
```yml
xrow_sass:
    siteaccess:
        my_siteaccess:
            settings:
                'brand-primary': "#ffff00"
        my_second_siteaccess:
            settings:
                'brand-primary': "#0000ff"
        my_siteaccess_group:
            file: "bootstrap/scss/bootstrap.scss"
            settings:
                'gray-dark': "#00ff00"
                'brand-primary': "#00ff00"
                'brand-info': "#00ff00"
                'my-color': "red"
```
You can specfiy file and settings for siteaccesses or siteaccessgroups, file specifies the SASS file to use, settings defines a list of SASS variables wich should be included.

If a siteacces is in a siteaccesgroup it will gain all settings defined in the associated siteaccesgroup.

Settings defined below a siteaccess will override settings defined in a siteaccessgoup.

If neither the siteaccess or the associated siteaccesgroup has file attribute specified, the siteaccess will be skipped. 

### Usage ###
Run:
``` ezpublish/console sass:compile ``` and your CSS files will be placed in web/css/{{siteaccessname}}.css



To load the CSS, simply create a link tag like the following:

``` html
<link rel="stylesheet" href="css/{{ ezpublish.siteaccess.name }}.css" />
```
