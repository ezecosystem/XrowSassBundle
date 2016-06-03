## XrowSassBundle ##
### Requirements ###
You will need to install https://github.com/sensational/sassphp
### Usage ###
Configure the siteaccess settings in a loaded configuration file (i.e. Config.yml)
```
xrow_sass:
    siteaccess:
        site:
            settings:
                'brand-primary': "#ffff00"
        de:
            settings:
                'brand-primary': "#0000ff"
        no:
            settings:
                'brand-primary': "#ff00ff"
        site_group:
            file: "%kernel.root_dir%/../vendor/twbs/bootstrap/scss/bootstrap.scss"
            settings:
                'gray-dark': "#00ff00"
                'brand-primary': "#00ff00"
                'brand-info': "#00ff00"
                'my-color': "red"
```
Run:
``` ezpublish/console sass:compile ``` and your css files will be placed in web/css/{{siteaccessname}}.css

To load them, simply create a link tag like the following:

``` html
<link rel="stylesheet" href="css/{{ ezpublish.siteaccess.name }}.css" />
```
