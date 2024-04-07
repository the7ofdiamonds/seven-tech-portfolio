<section class="seven-tech-admin">
    <?php settings_errors(); ?>
    <form method="post" action="options.php">
        <?php settings_fields('seven-tech-portfolio-group'); ?>
        <?php do_settings_sections('seven-tech-portfolio'); ?>
        <?php submit_button(); ?>
    </form>
</section>