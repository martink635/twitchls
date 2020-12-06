@if (env('ANALYTICS_ID'))
<script async src="https://www.googletagmanager.com/gtag/js?id={{ env('ANALYTICS_ID') }}"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', '{{ env('ANALYTICS_ID') }}', { 'anonymize_ip': true });
</script>
@endif
