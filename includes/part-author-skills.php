<div class='author-skills'>
    <div class="author-skills-slide">
        <i class="fa-brands fa-html5"></i>
        <i class="fa-brands fa-css3-alt"></i>
        <i class="fa-brands fa-js"></i>
        <i class="fa-brands fa-php"></i>
        <i class="fa-brands fa-java"></i>
        <i class="fa-brands fa-swift"></i>
        <i class="fa-brands fa-docker"></i>
    </div>
</div>

<script>
    const skills = document.querySelector('.author-skills-slide');
    const totalSkills = skills.children.length;

    for (let i = 0; i < totalSkills; i++) {
        skills.appendChild(skills.children[i].cloneNode(true));
    }

    document.documentElement.style.setProperty('--total-skills', totalSkills);
</script>