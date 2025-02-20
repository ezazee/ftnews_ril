<!DOCTYPE html>
<html lang="en">

<head>
    @include('blog.partials.master-meta')
    @include('blog.partials.master-css')
    
      <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-XFJB4628LQ"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
        
          gtag('config', 'G-XFJB4628LQ');
        </script>

     <script defer data-domain="ftnews.co.id" src="https://analitik.kbndigital.net/js/script.file-downloads.hash.outbound-links.pageview-props.tagged-events.js"></script>
     <script>window.plausible = window.plausible || function() { (window.plausible.q = window.plausible.q || []).push(arguments) }</script>
     <meta name="google-adsense-account" content="ca-pub-7366174212541814">
     <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7366174212541814"
     crossorigin="anonymous"></script>
</head>

<body
    class="uni-body panel bg-white text-gray-900 dark:bg-gray-custom dark:text-white text-opacity-50 overflow-x-hidden">
    <div>
        @include('blog.partials.header')
        <!-- Left Advertisement -->
        <div class="advertisement-left">
            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7366174212541814"
                 crossorigin="anonymous"></script>
            <!-- vertical_skinad_kiri -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:160px;height:600px"
                 data-ad-client="ca-pub-7366174212541814"
                 data-ad-slot="3127706346"></ins>
            <script>
                 (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
        
        <!-- Right Advertisement -->
        <div class="advertisement-right">
           <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7366174212541814"
                 crossorigin="anonymous"></script>
            <!-- vertical_skinad_kanan -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:160px;height:600px"
                 data-ad-client="ca-pub-7366174212541814"
                 data-ad-slot="6046088116"></ins>
            <script>
                 (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
        <div>
            @yield('content')
        </div>

        @include('blog.partials.footer')
        @include('blog.partials.master-js')
    </div>
</body>

</html>
