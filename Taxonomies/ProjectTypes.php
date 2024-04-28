<?php

namespace SEVEN_TECH\Portfolio\Taxonomies;

use Exception;

use WP_Query;

use SEVEN_TECH\Portfolio\Post_Types\Portfolio\Portfolio;
use SEVEN_TECH\Portfolio\Media\Media;

class ProjectTypes
{
    public $taxonomies;
    public $portfolio;
    private $media;

    public function __construct()
    {
        $this->taxonomies = new Taxonomies;
        $this->portfolio = new Portfolio;
        $this->media = new Media;

        add_filter('manage_edit-project_types_columns', [$this, 'edit_columns']);
        add_action('manage_project_types_custom_column', [$this, 'manage_columns'], 10, 3);
        add_action('project_types_add_form_fields', [$this, 'add_fields']);
        add_action('project_types_edit_form_fields', [$this, 'edit_fields'], 10, 2);
        add_action('created_project_types', [$this, 'save_fields']);
        add_action('edited_project_types', [$this, 'save_fields']);
    }

    function edit_columns($columns)
    {
        if (!empty($columns)) {
            $columns['fa_icon'] = 'FA Icon';
            $columns['icon_url'] = 'Icon URL';
        }

        return $columns;
    }

    function manage_columns($content, $column_name, $term_id)
    {
        switch ($column_name) {
            case 'fa_icon':
                $fa_icon = get_term_meta($term_id, 'fa_icon', true);
                echo esc_html($fa_icon);
                break;
            case 'icon_url':
                $icon_url = get_term_meta($term_id, 'icon_url', true);
                echo esc_url($icon_url);
                break;
        }
    }

    function add_fields()
    {
?>
        <div class="form-field">
            <label for="fa_icon">Font Awesome Icon</label>
            <input type="text" name="fa_icon" id="fa_icon">
            <p>Add Font Awesome Icon</p>
        </div>

        <div class="form-field">
            <label for="icon_url">Icon URL</label>
            <input type="text" name="icon_url" id="icon_url">
            <p>Add Icon URL</p>
        </div>
    <?php
    }

    function edit_fields($term, $taxonomy)
    {
        $faIcon = get_term_meta($term->term_id, 'fa_icon', true);
        $iconURL = get_term_meta($term->term_id, 'icon_url', true);
    ?>
        <tr class="form-field">
            <th scope="row"> <label for="fa_icon">Font Awesome Icon</label></th>
            <td><input type="text" name="fa_icon" id="fa_icon" value="<?php echo esc_attr($faIcon); ?>">
                <p class="description">Add Font Awesome Icon.</p>
            </td>
        </tr>

        <tr class="form-field">
            <th scope="row"><label for="icon_url">Icon URL</label></th>
            <td><input type="text" name="icon_url" id="icon_url" value="<?php echo esc_attr($iconURL); ?>" size="40">
                <p class="description">Add Icon URL</p>
            </td>
        </tr>
<?php
    }

    function save_fields($term_id)
    {
        if (isset($_POST['fa_icon'])) {
            update_term_meta($term_id, 'fa_icon', sanitize_text_field($_POST['fa_icon']));
        }

        if (isset($_POST['icon_url'])) {
            update_term_meta($term_id, 'icon_url', sanitize_text_field($_POST['icon_url']));
        }
    }

    public function getProjectTypes($post_type)
    {
        try {
            $project_types = $this->taxonomies->get_post_type_taxonomy($post_type, 'project_types');

            $projectTypes = [];

            foreach ($project_types as $term) {
                $faIcon = get_term_meta($term->term_id, 'fa_icon', true);
                $iconURL = get_term_meta($term->term_id, 'icon_url', true);

                $projectTypes[] = [
                    'id' =>$term->term_id,
                    'title' =>$term->name,
                    'icon' => [
                        'name' =>$term->name,
                        'description' =>$term->description,
                        'fa_icon' => $faIcon,
                        'icon_url' => $this->media->getURL('icons', $iconURL),
                    ],
                    'url' => "/project/type/{$term->slug}"
                ];
            }

            return $projectTypes;
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    public function getProjectType($type)
    {
        try {
            $taxonomy = 'project_types';
            $args = array(
                'post_type' => array('post', 'portfolio'),
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => $taxonomy,
                        'field' => 'slug',
                        'terms' => $type,
                    )
                )
            );

            $query = new WP_Query($args);

            $posts = $query->posts;

            $projects = [];

            if (empty($posts)) {
                throw new Exception('No portfolio items found', 400);
            }

            foreach ($posts as $post) {
                $projects[] = $this->portfolio->getPortfolioProject($post->ID, $post->post_title, $post->post_excerpt, "/{$post->post_type}/{$post->post_name}");
            }

            $term = get_term_by('slug', $type, $taxonomy);

            if ($term == false) {
                return '';
            }

            $faIcon = get_term_meta($term->term_id, 'fa_icon', true);
            $iconURL = get_term_meta($term->term_id, 'icon_url', true);

            $projectTypes = [
                'id' =>$term->term_id,
                'title' =>$term->name,
                'icon' => [
                    'name' =>$term->name,
                    'description' =>$term->description,
                    'fa_icon' => $faIcon,
                    'icon_url' => $this->media->getURL('icons', $iconURL),
                ],
                'projects' => $projects
            ];

            return rest_ensure_response($projectTypes);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
}
