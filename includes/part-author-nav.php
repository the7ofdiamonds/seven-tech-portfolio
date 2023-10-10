<nav class="author-nav">
    <button onclick="scrollToSection('7tech_portfolio')">
        <h3>PORTFOLIO</h3>
    </button>

    <button onclick="openResumeInNewTab()">
        <h3>RÉSUMÉ</h3>
    </button>
</nav>

<script>
    function scrollToSection(sectionId) {
        const section = document.getElementById(sectionId);

        if (section) {
            const offsetTopPx = section.getBoundingClientRect().top + window.scrollY;
            const paddingTopPx = 137.5;
            const rootFontSize = parseFloat(getComputedStyle(document.documentElement).fontSize);

            const paddingTopRem = paddingTopPx / 16;
            const paddingTopBackToPx = paddingTopRem * rootFontSize;
            const topPx = offsetTopPx - paddingTopBackToPx;

            window.scrollTo({
                top: topPx,
                behavior: 'smooth'
            });
        }
    }

    function openResumeInNewTab() {
        window.open('/founder/resume', '_blank');
    }
</script>