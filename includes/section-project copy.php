<section id="project" class="project">
    <!-- The Solution -->
    <!-- Gallery -->
    <?php include THFW_PORTFOLIO . 'includes/part-project-gallery.php'; ?>

    <!-- Who -> Client -->
    <h2 class="title"><?php the_title(); ?></h2>

    <div class="project-info">

        <?php include THFW_PORTFOLIO . 'includes/part-project-type.php'; ?>

        <?php include THFW_PORTFOLIO . 'includes/part-project-status.php'; ?>

    </div>
project 123
    <?php the_content(); ?>

    <!-- What -> Github Read Me File -->
    <!-- When -> Github -> Versions -->
    <!-- The Process - How -> Check list -->
    <!-- Design -> Gallery -->
    <!-- Colors -->
    <!-- Logos & Icons -->
    <!-- UML Diagrams -->
    <!-- Development -> Link to GitHub repo -->
    <!-- Check List -->
    <!-- Delivery —> Where ? -->
    <!-- Websites -->

    <div class="project-action-button">
        <button class="project-button">
            <h3>
                <?php echo get_post_meta($project->ID, '_project_button', true); ?>
            </h3>
        </button>
    </div>
    <!-- Social Networks -->
    <!-- App Stores -->
    <!-- The Problem - Why^ -->

    <?php include THFW_PORTFOLIO . 'includes/part-project-author.php'; ?>

    <?php include THFW_PORTFOLIO . 'includes/part-project-tag.php'; ?>
</section>