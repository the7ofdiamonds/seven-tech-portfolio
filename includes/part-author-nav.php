<nav class="author-nav">
    <button onclick="scrollToSection('founder')" id="founder_button">
        <h3>FOUNDER</h3>
    </button>

    <button onclick="scrollToSection('7tech_portfolio')" id="portfolio_button">
        <h3>PORTFOLIO</h3>
    </button>

    <button onclick="openResumeInNewTab()">
        <h3>RÉSUMÉ</h3>
    </button>
</nav>

<script>
    const founderSection = document.getElementById('founder');
    const portfolioElement = founderSection.querySelector('.portfolio');
    const portfolioButton = document.getElementById('portfolio_button');
    const founderButton = document.getElementById('founder_button');

    console.log(founderSection);
    console.log(portfolioElement);
    console.log(founderButton);
    console.log(portfolioButton);

    // Page load
    // window.addEventListener('load', () => {

    //     if (founderSection.getBoundingClientRect() === isElementInViewport('founder')) {
    //         updateButtonVisibility('7tech_portfolio');
    //     } else if (portfolioSection.getBoundingClientRect() === isElementInViewport('7tech_portfolio')) {
    //         updateButtonVisibility('founder');
    //     }
    // });

    //     function isElementInViewport(element) {
    //         console.log(element);
    //         const rect = element.getBoundingClientRect();
    // console.log(rect);
    //         return (
    //             rect.top >= 0 &&
    //             rect.left >= 0 &&
    //             rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
    //             rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    //         );
    //     }

    //     window.addEventListener('scroll', isElementInViewport(portfolioSection));

    // Page scroll
    // window.addEventListener('scroll', () => {

    //     if (founderSection.getBoundingClientRect() <= isElementInViewport(founderSection)) {
    //         currentSectionId = 'founder';
    //         console.log('founder');
    //     } else if (portfolioSection && isElementInViewport(portfolioSection)) {
    //         currentSectionId = '7tech_portfolio';
    //         console.log('portfolio');
    //     }

    //     const currentSection = getCurrentSection();
    //     updateButtonVisibility();
    // });

    // function determineCurrentSection() {
    //     const scrollPosition = window.scrollY;

    // Iterate through section IDs and find the one in view
    // let currentSectionId = null;

    // for (const sectionId of sectionIds) {
    //     const section = document.getElementById(sectionId);

    //     if (section) {
    //         const sectionTop = section.getBoundingClientRect().top + window.scrollY;
    //         const sectionBottom = sectionTop + section.offsetHeight;

    //         if (scrollPosition >= sectionTop && scrollPosition < sectionBottom) {
    //             currentSectionId = sectionId;
    //                 break; // Stop looping once the current section is found
    //             }
    //         }
    //     }

    //     if (currentSectionId) {
    //         console.log('Current Section ID:', currentSectionId);
    //         // Do something with the current section ID
    //     }
    // }

    function updateButtonVisibility(currentSectionId) {

        if (currentSectionId === 'founder') {
            founderButton.style.display = 'none';
            portfolioButton.style.display = 'block';
        } else if (currentSectionId === '7tech_portfolio') {
            portfolioButton.style.display = 'none';
            founderButton.style.display = 'block';
        }
    }

    // Button press
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