## XrowSassBundle ##
### Usage Example ###
Config.yml
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
