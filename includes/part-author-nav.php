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
            section.scrollIntoView({ behavior: 'smooth' });
        }
    }
    function openResumeInNewTab() {
        // Open the "/founder/resume" page in a new tab
        window.open('/founder/resume', '_blank');
    }
</script>
