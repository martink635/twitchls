# twitchls v2

Alternative Twitch.tv listing, with a limited set of features. Historically this was used to force Twitch.tv streams in HLS mode for a better experience on MacOS Safari. Built using [Laravel 8](https://laravel.com/), [Livewire](https://laravel-livewire.com/), [Alpine.js](https://github.com/alpinejs/alpine) and [TailwindCSS](https://tailwindcss.com/).

This application is running on [twitchls.com](https://twitchls.com).

## Development

```shell
composer install
npm install

# Frontend development
npm run dev

# For production
npm run prod

# Tests
vendor/bin/phpunit
```

In order to Login via Twitch and load the followed streams you need to [register your application on the Twitch.tv website](http://www.twitch.tv/settings/connections). After you've registered, fill the `TWITCH_CLIENT_ID`, `TWITCH_CLIENT_SECRET` and `TWITCH_REDIRECT_URL` with the appropriate values in the `.env` file.

## License

Twitchls is licensed under the [MIT license](http://opensource.org/licenses/MIT).
