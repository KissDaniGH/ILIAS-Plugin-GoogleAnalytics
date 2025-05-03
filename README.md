# Google Analytics Plugin for ILIAS

Sets GA4 Measurement ID to track page views with Google Analytics.

## Supported Versions

* ILIAS: [![Minimum ILIAS Version](https://img.shields.io/badge/Minimum_ILIAS-10.0-orange.svg)](https://ilias.de/) [![Maximum ILIAS Version](https://img.shields.io/badge/Maximum_ILIAS-10.99-orange.svg)](https://ilias.de/)

## Installation

* Open a command line.
* Change to your ILIAS webroot directory.
* Create and change to `./public/Customizing/global/plugins/UIComponent/UserInterfaceHook/`.
* Download code as ZIP and unzip it or clone the repository
* Make sure the folder `GoogleAnalytics` and its contents are readable for your webuser.
* Change to your ILIAS webroot directory
* Update the autoloader as webuser.
* Finalize the installation through the web interface in Administration -> Extending ILIAS -> Plugins.

```bash
cd /var/www/html/
mkdir -p public/Customizing/global/plugins/Services/UIComponent/UserInterfaceHook/
cd public/Customizing/global/plugins/Services/UIComponent/UserInterfaceHook/
```

```bash
wget https://github.com/KissDaniGH/ILIAS-Plugin-GoogleAnalytics/archive/refs/tags/v1.0.0.zip
unzip v1.0.0.zip -d ./
rm v1.0.0.zip
mv ILIAS-Plugin-GoogleAnalytics-1.0.0 GoogleAnalytics
```

or

```bash
git clone https://github.com/KissDaniGH/ILIAS-Plugin-GoogleAnalytics.git GoogleAnalytics  
```

```bash
cd /var/www/html/
chown www-data:www-data public/Customizing/global/plugins/Services/UIComponent/UserInterfaceHook/GoogleAnalytics/ -R
chmod 755 public/Customizing/global/plugins/Services/UIComponent/UserInterfaceHook/GoogleAnalytics/ -R
sudo -uwww-data composer du
``` 

As an ILIAS administrator go to 'Administration -> Extending ILIAS -> Plugins' and install, configure and activate the plugin.

## Configuration

As an ILIAS administrator go to "Administration -> Extending ILIAS -> Plugins" and configure the plugin.

You need a Google Analytics Measurement ID to set it up.

## Languages
* English
* German - Deutch
* Hungarian - Magyar

#### Bugs

There are no known bugs.

#### License

The key words "MUST", "MUST NOT", "REQUIRED", "SHALL", "SHALL NOT", "SHOULD",
"SHOULD NOT", "RECOMMENDED", "MAY", and "OPTIONAL"
in this document are to be interpreted as described in
[RFC 2119](https://www.ietf.org/rfc/rfc2119.txt).

See [LICENSE](./LICENSE) file in this repository.

### Buy me a virtual coffee

If you find it useful, feel free to buy me a vitrual coffee.
https://buymeacoffee.com/kissdani

### Contact

kisskalmandaniel@gmail.com  
https://ilias.hu
