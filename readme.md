# twitchls

Watch Twitch streams via HLS. Works on Safari 6+ (5+ for iOS), Chrome for Android 30+ and Edge on Windows 10. If browser is not supported, it loads a Flash stream. Built on top of [Lumen](http://lumen.laravel.com/) and [Vue.js](http://vuejs.org).

## Development

```shell
composer install
npm install

# Frontend development
gulp watch

# For production
gulp --production

# Tests
vendor/bin/phpunit
```

In order to Login via Twitch and load the followed streams you need to [register](http://www.twitch.tv/settings/connections) your application on the Twitch website. After you've registered, fill the `TWITCH_CLIENT_ID`, `TWITCH_CLIENT_SECRET` and `TWITCH_REDIRECT_URL` in the `.env` file.

## License

Twitchls is licensed under the [MIT license](http://opensource.org/licenses/MIT).
