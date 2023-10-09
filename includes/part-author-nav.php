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
        const paddingTop = 137.5; // Adjust this value to set your desired padding in pixels

        if (section) {
            const offsetTop = section.getBoundingClientRect().top + window.scrollY;
            window.scrollTo({
                top: offsetTop - paddingTop,
                behavior: 'smooth'
            });
        }
    }

    function openResumeInNewTab() {
        // Open the "/founder/resume" page in a new tab
        window.open('/founder/resume', '_blank');
    }
</script>