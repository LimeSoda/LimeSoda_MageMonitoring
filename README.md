LimeSoda_MageMonitoring
=====================
Adds health checks and statistics to Hackathon_MageMonitoring.

Facts
-----
- version: 1.1.1
- [extension on GitHub](https://github.com/LimeSoda/LimeSoda_MageMonitoring)

Compatibility
-------------
- Magento EE 1.13.0.2 (may also work in other versions and CE, not tested)

Requirements
------------
- Hackathon_MageMonitoring

Installation
------------
1. Install the extension using [Composer](https://getcomposer.org/),
[modman](https://github.com/colinmollenhour/modman) or copy all the
files to the according Magento directories manually.

Uninstallation
--------------
1. Remove the files.

Usage
-----
Install the extension and navigate to the backend menu `System > Monitoring`.

The following checks and statistics have been added:

###Sales

####Sales Check

* Orders with incorrect state / status combination.

####Order Statuses

Shows the orders counts grouped by Order Status.

####Order Statuses (excluded orders with Complete statuses)

Shows the orders counts grouped by Order Status with all orders excluded that have an order status assigned to state
'Complete'.

####Order Statuses (for orders in progress)

Shows the orders counts grouped by Order Status with all orders excluded that have an order status assigned to state
'Canceled', 'Complete' or 'Closed'.

Support
-------
If you have any issues with this extension, open an issue in the GitHub
repository. Please provide error messages, debug information like output
from the Magento error logs and the exact steps / code to reproduce the
issue.

Contribution
------------
Any contribution is highly appreciated. The best way to contribute code is to
open a [pull request on GitHub](https://help.github.com/articles/using-pull-requests).

Developers
---------
* Matthias Zeis ([matthias-zeis.com](http://www.matthias-zeis.com), [@mzeis](https://twitter.com/mzeis))

Licence
-------
[OSL - Open Software Licence 3.0](http://opensource.org/licenses/osl-3.0.php)

Copyright
---------
(c) 2014 LimeSoda Interactive Marketing GmbH
