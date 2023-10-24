<?php

namespace SEVEN_TECH_Portfolio\Post_Types;

class Portfolio
{
    public function __construct()
    {
        add_action('add_meta_boxes', array($this, 'add_post_meta_boxes'));
        add_action('save_post', array($this, 'save_post_project_button'));
    }
    
    function add_custom_meta_boxes()
    {
        add_meta_box(
            "post_metadata_project_button",
            "Project Button",
            [$this, 'post_meta_box_project_button'],
            "projects",
            "side",
            "low"
        );
    }
    
    function post_meta_box_project_button()
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
        
    // add event date field to events post type
    function add_post_meta_boxes()
    {
        add_meta_box(
            "post_metadata_project_button", // div id containing rendered fields
            "Project Button", // section heading displayed as text
            [$this, 'post_meta_box_project_button'], // callback function to render fields
            "portfolio", // name of post type on which to render fields
            "normal", // location on the screen
            "low" // placement priority
        );
    }
}
