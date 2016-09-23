## XrowSassBundle ##
### Requirements ###
You will need to install https://github.com/sensational/sassphp
### Usage ###

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
Run:
``` ezpublish/console sass:compile ``` and your CSS files will be placed in web/css/{{siteaccessname}}.css

Variables defined in an siteaccess or siteaccessgroup will be either made available or override the matching variables in the defined .scss file.

To load the CSS, simply create a link tag like the following:

``` html
<link rel="stylesheet" href="css/{{ ezpublish.siteaccess.name }}.css" />
```
