# Bandportal Cake

A platform for groups of musicians for organizing their songs, dates (rehearsals and gigs), general ideas.

## Installation

```bash
composer install --no-dev
```

You might wanna adjust at least the `BASE_URL` variable in `config/.env`.

## Configuration

### Mails

#### Notifications

That's band internal notifications informing about new/altered records on the platform.

These mails are being sent to 'active' users only.

A cron job might look like this:

```crobtab
0 1 * * * /var/www/bin/cake notification -q
```

Make sure to have set up the `EMAIL_DEFAULT_FROM` variable in for `config/.env`.

#### Mails to locations

That's mails to external locations, e.g. for applications.

These mails are based on 'mail' records that define a generic mail text (containing placeholders) that are processed for each selected location.

A cron job might look like this:

```crobtab
*/5 * * * * /var/www/bin/cake send_mails -q
```

Make sure to have set up the `EMAIL_EXTERNAL_FROM` variable in for `config/.env`.

### CalDav

Set `CALENDAR_*` variables in `config/.env` to link this platforms dates to a remote CalDav calendar.

## Development

```bash
ddev start
```

To put the application into debug mode set `DEBUG` to true in `config/.env`.

## Dependencies

### CakePHP 4.x

* https://github.com/cakephp/cakephp/tree/4.x
* https://github.com/cakephp/app/blob/4.x

### JavaScript

* dropzone.js
* Foundation
* Foundation Dropdown
* jQuery 3.1
* jQuery UI 1.12.0
* jQuery UI Touch Punch 0.2.3
* Moment 2.14.1
* [Fullcalendar 2.9.1](https://github.com/fullcalendar/fullcalendar/tree/v2.9.1)
* foundation-datepicker 1.5.6
* selectize.js 0.12.6
