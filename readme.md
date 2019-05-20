## UnRequireJS - Magento 2 module
Unloading Magento 2 requirejs-config files that are not in use.

### Overview

This module is written for the purpose of optimizing the amount of javascript files loaded by Magento 2.
Magento comes with a lot of core modules. Not all of these modules are always in use. 
Some of these modules include a requirejs-config file. This module will check Magento config and unload some 
requirejs-config files if the parent modules are not enabled/configured. Examples; paypal module, amazon module.

### Unofficial way!
Keep in mind: the official way of making sure that requirejs-config files are not loaded are by properly disabling
the module in the Magento way. This is by disabling the module in `app/etc/config.php`.

### Talk numbers to me
For all tests Magento 2.3.1 Luma with sample data has been used as this was the latest version at the creation of this module.

**Homepage**  
default: 179 javascript file loads and 17 xhr loads.  
Optimizer: 163 javascript file loads and 16 xhr loads.

**Checkout**
Default: 284 javascript file loads and 59 xhr loads.
Optimizer: 266 javascript file loads and 42 xhr loads.


Proper JS bundling with either Magento or the RequireJS optimizer will reduce the total number of file loads
but it would still contain these files and run their init functions etc.


### Use in production mode
This module can be used in production mode **BUT** after configuring a module (for instance, enabling paypal) the 
static content MUST be regenerated because the static content will not hold the required paypal requirejs-config file.
> TODO: implement an admin notice after configuring modules that are watched by the unloader


### How to use
> TODO

### Module list
##### MSP_ReCaptcha
Config setting of `msp_securitysuite_recaptcha/frontend/enabled` is checked.  
_Saving 3 js file loads_
##### Amazon_Payment
Config settings of `payment/amazon_payment/active` and `payment/amazon_payment/lwa_enabled` are checked.
If both are disabled the requirejs-config will be unloaded.  
_Not saving any file loads, just saving some kb's in requirejs-config file_
##### Amazon_Login
Config settings of `payment/amazon_payment/amazon_login_in_popup` and `payment/amazon_payment/lwa_enabled` are checked.
If both are disabled the requirejs-config will be unloaded.  
_Saving 10 js file loads_
#### Vertex_Tax
Config setting of `tax/vertex_settings/enable_vertex` is checked.
This module only added requirejs-config mapping and adding x-magento-init config. If the module itself is not enabled it
will not load any extra javascript. Both the requirejs-config and the x-magento-init code is unloaded.  
_Not saving any file loads, just cleaning up_
#### Klarna_Kp
Config setting of `payment/klarna_kp/active` is checked. requirejs-config is unloaded and klarna
 checkout config is removed. This checkout config is depending on the requirejs-config.  
 _Saving 2 js file loads at checkout_


### Modules todo
- magento bundled product
- shipping validators
- temando shipping
- magento module-product_video
- magento_payment
- magento_msrp
- magento_paypal
- magento_downloadable
- Magento_ConfigurableProduct
- Magento_Authorizenet
- Magento_GiftMessage
- Magento_AuthorizenetAcceptjs
- Magento_Multishipping
- Magento_Braintree
- Magento_ProductVideo
- Magento_Tinymce3

