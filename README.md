# Exclusiveunlock Professional
An open source and FREE GSM Code selling store like Dhru Fusion Clone.

## DEMO Admin Panel Credentials
http://www.exclusiveunlock.co.uk/admin/

U: `admin@exclusiveunlock.co.uk`

P: `demo1234`

## DEMO User Panel Credentials:
http://www.exclusiveunlock.co.uk/

U: `demo@demo.com`

P: `demo1234`

## Core Features:
* Unlock code by IMEI service.
* Unlock code By file service.
* Server logs and credits.
* Unlimited codes.
* Unlimited methods or services.
* Unlimited users.
* Unlimited User's group.
* Group level user pricing.
* Pre-integrated Dhru Fusion API library.
* Pre-integrated PayPal Payment Gateway.
* Multi-user Admin Panel.
* Email Template System.
* Developer Friendly
* Developed on famous PHP Codeigniter Framework.
* 100% Open Source.
* FREE to commerically use or modify.

## Installation:
1. Create database with name `exclusiveunlock`.
2. Import database file `DB/dtabase.sql`.
3. Configure database credentials in file `application/config/database.php`.
4. Set base_url in file `application/config/config.php`

## Admin Panel Credentials:
http://localhost/exclusiveunlock/index.php/Admin

U: `admin@exclusiveunlock.co.uk`

P: `demo1234`

## User Panel Credentials:
http://localhost/exclusiveunlock/

U: `demo@demo.com`

P: `demo1234`

## Cron Jobs ##
* * * * * /usr/bin/php56 /home/imei/public_html/imei/unlock/index.php cron send_imei_orders
* * * * * /usr/bin/php56 /home/imei/public_html/imei/unlock/index.php cron send_file_orders

*/10 * * * * /usr/bin/php56 /home/imei/public_html/imei/unlock/index.php cron receive_imei_orders
*/10 * * * * /usr/bin/php56 /home/imei/public_html/imei/unlock/index.php cron receive_file_orders

## Issues

If you come across any issues please [report them here](https://github.com/muhammad-shariq/exclusiveunlock/issues).

## Contributing

Thank you for considering contributing to the Exclusiveunlock project! Please feel free to make any pull requests, or e-mail me a feature request you would like to see in the future email at shariq2k@yahoo.com.

## Security Vulnerabilities

If you discover a security vulnerability within this project, please send an e-mail to shariq2k@yahoo.com, or create a pull request if possible. All security vulnerabilities will be promptly addressed.

## License

MIT: [https://opensource.org/licenses/MIT](https://opensource.org/licenses/MIT)
