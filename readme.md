## UnRequireJS - Magento 2 module

### Overview

This module is written for the purpose of optimizing the amount of javascript files loaded by Magento 2.
Magento comes with a lot of core modules. Not all of these modules are always in use. 
Some of these modules include a requirejs-config file. This module will check Magento config and unload some 
requirejs-config files if the parent modules are not enabled/configured. Examples; paypal module, amazon module.

### Unofficial way!
Keep in mind: the official way of making sure that requirejs-config files are not loaded are by properly disabling
the module in the Magento way. This is by disabling the module in `app/etc/config.php`.


### Use in production mode
This module can be used in production mode **BUT** after configuring a module (for instance, enabling paypal) the 
static content MUST be regenerated because the static content will not hold the required paypal requirejs-config file.
> TODO: implement an admin notice after configuring modules that are watched by the unloader


### How to use
> TODO