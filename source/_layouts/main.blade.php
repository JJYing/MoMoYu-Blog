<!DOCTYPE html>
<html lang="{{ $page->language ?? 'en' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="canonical" href="{{ $page->getUrl() }}">
        <meta name="description" content="{{ $page->description }}">
        <link rel="preconnect" href="https://s.anyway.red" crossorigin/>
        <link rel="icon" href="https://s.anyway.red/momoyu/favicon.png">
        <link rel="stylesheet" href="https://s.anyway.red/momoyu/fontawesome.css">
        <link rel="stylesheet" href="https://s.anyway.red/font/alihealth2/regular/regular.css">
        <link rel="stylesheet" href="https://s.anyway.red/font/alihealth2/bold/bold.css">
        
        <title>{{ $page->title }}</title>
        @viteRefresh()
        <link rel="stylesheet" href="{{ vite('source/_assets/css/blog.css') }}">
        <script defer type="module" src="{{ vite('source/_assets/js/main.js') }}"></script>
        <script>
            var _paq = window._paq = window._paq || [];
            _paq.push(["setCookieDomain", "*.momoyu.app"]);
            _paq.push(["setDomains", ["*.momoyu.app"]]);
            _paq.push(['trackPageView']);
            _paq.push(['enableLinkTracking']);
            (function() {
              var u="//anyway.fm/matomo/";
              _paq.push(['setTrackerUrl', u+'matomo.php']);
              _paq.push(['setSiteId', '5']);
              var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
              g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
            })();
          </script>        
    </head>
    <body>
        @yield('body')
    </body>
</html>
