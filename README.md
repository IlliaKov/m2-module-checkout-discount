# Magento 2 – Checkout Discount Module

## Overview

- This module creates extra basket discount block in the checkout page and adds extra variables.

### Installation

Add the module repository to composer.json:

```
"repositories": [
{"type": "vcs", "url": "git@github.com:IlliaKov/m2-module-checkout-discount.git"}
]
```

Then run the following commands:

```
$ composer require illia-nova/m2-module-checkout-discount
$ php bin/magento setup:upgrade
```
Author – Illia Nova