# Bandportal Cake

A platform for groups of musicians for organizing their songs, dates (rehearsals and gigs), general ideas.

## Installation

```bash
composer install --no-dev
```

You might wanna adjust at least the `BASE_URL` variable in `config/.env`.

## Configuration

### CalDav

Set `CALENDAR_*` variables in `config/.env` to link this platforms dates to a remote CalDav calendar.

## Development

```bash
ddev start
```

To put the application into debug mode set `DEBUG` to true in `config/.env`.

## Create users

```bash
ddev ssh

$ bin/cake create_user
Username:
> peter
Email:
> peter@example.org
Password:
> 123456
Admin? (yes/no)
[no] > yes
Active? (yes/no)
[yes] > no
Passive? (yes/no)
[no] > no
User creation successfully!
```

There's currently 3 roles a user can have:

* Admin (not necessarily a band member, but can be)
* Active (active band members)
* Passive (not a band member, but someone whom the bands wants to share certain data with: songs, setlists, etc.)

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
* selectize.js 0.12.6
