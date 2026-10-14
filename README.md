# Zero_ProductFeed

The store's catalog as XML feeds that marketplaces,
price comparison sites and ad platforms fetch by URL: Rozetka and Prom.ua
(YML), Hotline, Google Merchant Center (which Meta catalogs read too). One
feed per store view, in its own language and currency, at
{store URL}/productfeed/{rozetka|prom|hotline|google}.

## Install

Requires Magento Open Source 2.4.7–2.4.9 and PHP 8.2–8.4.

```bash
composer require fixstacks/module-zero-product-feed
bin/magento setup:upgrade
bin/magento setup:di:compile           # production mode
bin/magento setup:static-content:deploy # production mode
bin/magento cache:flush
```

Composer installs `fixstacks/module-zero-core` with it.

Part of [`fixstacks/zero`](https://fixstacks.com/zero), which installs the Zero theme and every Zero module at once.

## License

OSL-3.0 or AFL-3.0, your choice: see `NOTICE.md`.

---

Zero is made by [Fixstacks](https://fixstacks.com/zero) in partnership with [Vilmate](https://vilmate.com).
Documentation: https://fixstacks.com/zero/docs. Demo store: https://zero.fixstacks.com.
