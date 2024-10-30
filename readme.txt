=== Move orders on-hold to processing if successful authorize.net payment ===
Contributors: Md. Atiqur Rahman
Tags: Payment, authorize.net, on-hold, processing, order status, WooCommerce, 
Requires at least: 5.0
Tested up to: 5.9
Stable tag: 1.0
License: GPLv2 or later

It's a must use plugin if you are using authorize.net CC payment for your WooCommerce site.

This is one we looked into awhile back and found out the authorize.net vendor confirmed it was an issue on their end but they would probably not do anything about it. Basically an issue comes up if someone orders with a payment type other than CC that puts the order on hold and then the person decides to pay with credit card. Even if the CC is successful the order stays as on hold because the plugin doesn't change the order status. They have also seen cases where the person attempts a CC, it fails so its put on hold, they use another card and that is successful but it stays on hold.

== Description ==

It's a must use plugin if you are using authorize.net CC payment for your WooCommerce site.

This is one we looked into awhile back and found out the authorize.net vendor confirmed it was an issue on their end but they would probably not do anything about it. Basically an issue comes up if someone orders with a payment type other than CC that puts the order on hold and then the person decides to pay with credit card. Even if the CC is successful the order stays as on hold because the plugin doesn't change the order status. They have also seen cases where the person attempts a CC, it fails so its put on hold, they use another card and that is successful but it stays on hold.

Move orders on-hold to processing if successful authorize.net payment. Cron job rans every 5 minutes and check on-hold orders to see if there any successful payment from Authorize.net. If yes change the order status to processing from on-hold. 


== Installation ==

Upload the Move orders on-hold to processing if successful authorize.net payment plugin to your site, activate it,That's all!!!