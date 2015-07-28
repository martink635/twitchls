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

## License

Twitchls is licensed under the [MIT license](http://opensource.org/licenses/MIT).
