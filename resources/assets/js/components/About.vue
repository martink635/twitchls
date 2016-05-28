<template>

  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <h1>About</h1>

      <p>This is an open source project, enabling you to watch streams using HLS techonolgy instead of Flash. It uses significantly less power on a Mac. It also has the option to display the Twitch chat, which thanks to the new Twitch update also loads without using Flash.</p>

      <p>There is an experimental feature that enables HTML5 streams on new browsers (tested on Chrome and Firefox). By default it's turned on.</p>

      <p>HLS works only on a handful of browsers:</p>

      <ul>
        <li>Safari 6+ (5+ for iOS),</li>
        <li>Edge (on Windows 10),</li>
        <li>Chrome for Android 30+,</li>
        <li>Stock Android browser 4.1+.</li>
      </ul>

      <p>Twitchls is open source, licensed under <a href="http://opensource.org/licenses/mit-license.html">MIT License</a>, available on <a href="https://github.com/mkoterle/twitchls">Github</a>.</p>

    </div>
  </div>


</template>

<script>
export default {
  name: 'About'
}
</script>
