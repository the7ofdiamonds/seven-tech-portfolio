<?php

namespace SEVEN_TECH_Portfolio\Post_Types\Portfolio;

class Portfolio
{
    public function __construct()
    {
        add_action('add_meta_boxes', [$this, 'add_custom_meta_boxes']);
        add_action('save_post', [$this, 'save_post_project_button']);
    }

    function add_custom_meta_boxes()
    {
        add_meta_box(
            "post_metadata_project_button",
            "Project Button",
            [$this, 'project_button'],
            "portfolio",
            "side",
            "low"
        );

        add_meta_box(
            "post_metadata_box_add_team",
            "Project Team",
            [$this, 'project_team'],
            "portfolio",
            "side",
            "low"
        );
    }

    function project_button()
    {
        $postID = get_the_ID();
        $projectButton = get_post_meta($postID, '_project_button', true); ?>

        <input type='text' name="_project_button" value="<?php echo esc_attr($projectButton); ?>" placeholder="Project Button">
    <?php }

    function save_post_project_button($postID)
    {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        $projectButton = isset($_POST["_project_button"]) ? sanitize_text_field($_POST["_project_button"]) : '';
        update_post_meta($postID, "_project_button", $projectButton);
    }

    function project_team()
    { ?>
        <input type='text' />
<?php }
}
