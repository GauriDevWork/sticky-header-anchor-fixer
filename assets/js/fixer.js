document.addEventListener("DOMContentLoaded", function () {
    const offset = parseInt(shaf_params.offset) || 0;
    const smooth = shaf_params.smooth ? "smooth" : "auto";

    function adjustScroll() {
        if (window.location.hash) {
            const id = window.location.hash.substring(1);
            const el = document.getElementById(id);

            if (el) {
                const top = el.getBoundingClientRect().top + window.scrollY - offset;
                window.scrollTo({
                    top: top,
                    behavior: smooth
                });
            }
        }
    }

    // On initial page load
    setTimeout(adjustScroll, 10);

    // On hash change (clicking anchor links)
    window.addEventListener("hashchange", adjustScroll);
});
