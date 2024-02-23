<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/gh/dixonandmoe/rellax@master/rellax.min.js"></script>
<script>
    AOS.init({
        duration: 1200,
        easing: 'ease',
        delay: 150,
        once: false,
    });
    var rellax = new Rellax('.rellax', {
        speed: -4,
        center: false,
        wrapper: null,
        round: true,
        vertical: true,
        horizontal: false
    });

    var headerBtn = document.getElementById("openMenu");
    var closeBtn = document.getElementById("closeMenu");

    if(screen.width <= 767){
        headerBtn.addEventListener("click", ()=>{
            document.querySelector("header").classList.toggle("header__menus-open");
            scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
            window.onscroll = function() {
                window.scrollTo(scrollLeft, scrollTop);
            };
        });
        closeBtn.addEventListener("click", ()=>{
            document.querySelector("header").classList.remove("header__menus-open");
            window.onscroll = function() {};
        });
    }
</script>
<script src="components/static/js/script.js"></script>