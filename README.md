<!--h-->
# Control Panel API

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/3200ceba8aea4a31ac1dfe826328bcb1)](https://www.codacy.com/app/laravel-enso/ControlPanelApi?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=laravel-enso/ControlPanelApi&amp;utm_campaign=Badge_Grade)
[![StyleCI](https://styleci.io/repos/88979520/shield?branch=master)](https://styleci.io/repos/88979520)
[![License](https://poser.pugx.org/laravel-enso/controlpanelapi/license)](https://https://packagist.org/packages/laravel-enso/controlpanelapi)
[![Total Downloads](https://poser.pugx.org/laravel-enso/controlpanelapi/downloads)](https://packagist.org/packages/laravel-enso/controlpanelapi)
[![Latest Stable Version](https://poser.pugx.org/laravel-enso/controlpanelapi/version)](https://packagist.org/packages/laravel-enso/controlpanelapi)
<!--/h-->

The package depends on the Laravel/Passport official package.

### Installation

Follow the next steps for completing the [Passport package install](https://laravel.com/docs/5.4/passport#installation):
* run `composer require laravel-enso/ControlPanelApi`
* run `php artisan migrate`
* run `php artisan passport:install`
* set `'driver' => 'passport',` inside `config/auth.php` for the api guard.
* publish the laravel passport FE components: `php artisan vendor:publish --tag=passport-components`
* register the components in `resources/js/app.js`
    - Vue.component('passport-clients', require('./components/passport/Clients.vue'));
    - Vue.component('passport-authorized-clients', require('./components/passport/AuthorizedClients.vue'));
    - Vue.component('passport-personal-access-tokens', require('./components/passport/PersonalAccessTokens.vue'));
* compile the js assets `npm run dev`, `gulp`, etc.
* include the component `<passport-clients></passport-clients>` where desired. Optionally, you may use the `manage-oauth-tokens` permission to allow just admins to manage the clients.

Next steps are required for this package:
* Use the FE to define an OAuth client, and take note of the ID and the secret (you'll need these in the client that consumes the services)

**Note** The packages comes with the `manage-oauth-tokens` policy that allows you to only show the `passport-clients` VueJS component to admins. 

<!--h-->
### Contributions

are welcome. Pull requests are great, but issues are good too.

### License

This package is released under the MIT license.
<!--/h-->
