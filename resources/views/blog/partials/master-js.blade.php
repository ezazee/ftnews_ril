 <!-- include jquery & bootstrap js -->
 <script defer src="{{ asset('assets/js/libs/jquery.min.js') }}"></script>
 <script defer src="{{ asset('assets/js/libs/bootstrap.min.js') }}"></script>

 <!-- include scripts -->
 <script defer src="{{ asset('assets/js/libs/anime.min.js') }}"></script>
 <script defer src="{{ asset('assets/js/libs/swiper-bundle.min.js') }}"></script>
 <script defer src="{{ asset('assets/js/libs/scrollmagic.min.js') }}"></script>
 <script defer src="{{ asset('assets/js/helpers/data-attr-helper.js') }}"></script>
 <script defer src="{{ asset('assets/js/helpers/swiper-helper.js') }}"></script>
 <script defer src="{{ asset('assets/js/helpers/anime-helper.js') }}"></script>
 <script defer src="{{ asset('assets/js/helpers/anime-helper-defined-timelines.js') }}"></script>
 <script defer src="{{ asset('assets/js/uikit-components-bs.js') }}"></script>

 <!-- include app script -->
 <script defer src="{{ asset('assets/js/app.js') }}"></script>

 <script>
     // Schema toggle via URL
     const queryString = window.location.search;
     const urlParams = new URLSearchParams(queryString);
     const getSchema = urlParams.get("schema");
     if (getSchema === "dark") {
         setDarkMode(1);
     } else if (getSchema === "light") {
         setDarkMode(0);
     }
 </script>

 <script>
     document.addEventListener("DOMContentLoaded", function() {
         const currentPath = window.location.pathname;
         const navLinks = document.querySelectorAll('.nav-x a');

         navLinks.forEach(link => {
             const linkPath = link.getAttribute(
                 'data-path');

             if (linkPath === currentPath) {
                 link.classList.add('active');
             }
         });
     });
 </script>


 <script>
     const closeBtn = document.getElementById('closeBannerBtn');
     const banner = document.getElementById('mobileBanner');

     closeBtn.addEventListener('click', function() {
         banner.style.display = 'none';
     });
 </script>


<script>
const closeAdBtn = document.getElementById('closeAdBtn');
    const adBanner = document.getElementById('adBanner');

    if (closeAdBtn && adBanner) {
        closeAdBtn.addEventListener('click', function() {
            adBanner.style.display = 'none';
        });
    } else {
        console.error('Element not found');
    }
</script>


 <script>
     document.addEventListener("DOMContentLoaded", function() {
         const closeButton = document.querySelector(".close-ad-btn");
         const adBanner = document.querySelector(".ad-banner");

         closeButton.addEventListener("click", function() {
            adBanner.style.display = "none";
         });
     });
 </script>


<!-- TikTok embed script -->
<script async src="https://www.tiktok.com/embed.js"></script>
<!-- Instagram embed script -->
<script async src="//www.instagram.com/embed.js"></script>
<!-- Twitter embed script -->
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>


<script>
   document.addEventListener('DOMContentLoaded', function() {
    const postUrl = encodeURIComponent(window.location.href);
    const postTitle = encodeURIComponent(document.title);

    const facebookShare = document.getElementById('share-facebook');
    const twitterShare = document.getElementById('share-twitter');
    const instagramShare = document.getElementById('share-instagram');
    const tiktokShare = document.getElementById('share-tiktok');
    const telegramShare = document.getElementById('share-telegram');
    const linkShare = document.getElementById('share-link');
    const whatsappShare = document.getElementById('share-whatsapp');

    // Check if elements exist before adding event listeners
    if (facebookShare) {
        facebookShare.addEventListener('click', function(event) {
            event.preventDefault();
            window.open(`https://www.facebook.com/sharer/sharer.php?u=${postUrl}`, '_blank', 'width=600,height=400');
        });
    }

    if (twitterShare) {
        twitterShare.addEventListener('click', function(event) {
            event.preventDefault();
            window.open(`https://twitter.com/intent/tweet?url=${postUrl}&text=${postTitle}`, '_blank', 'width=600,height=400');
        });
    }

    if (instagramShare) {
        instagramShare.addEventListener('click', function(event) {
            event.preventDefault();
            alert('Instagram does not support direct sharing through URLs.');
        });
    }

    if (tiktokShare) {
        tiktokShare.addEventListener('click', function(event) {
            event.preventDefault();
            alert('TikTok does not support direct sharing through URLs.');
        });
    }

    if (telegramShare) {
        telegramShare.addEventListener('click', function(event) {
            event.preventDefault();
            window.open(`https://t.me/share/url?url=${postUrl}&text=${postTitle}`, '_blank', 'width=600,height=400');
        });
    }

    if (linkShare) {
        linkShare.addEventListener('click', function(event) {
            event.preventDefault();
            navigator.clipboard.writeText(window.location.href)
                .then(() => alert('Link copied to clipboard!'))
                .catch(err => console.error('Failed to copy text: ', err));
        });
    }

    if (whatsappShare) {
        whatsappShare.addEventListener('click', function(event) {
            event.preventDefault();
            window.open(`https://wa.me/?text=${postTitle}%20${postUrl}`, '_blank', 'width=600,height=400');
        });
    }
});

    </script>
    
    
