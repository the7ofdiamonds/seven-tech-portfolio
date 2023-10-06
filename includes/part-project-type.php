<div class="project-type">
     <h3>Type</h3>

     <?php
     $terms = get_the_terms($post->ID, 'projects');

     if ($terms) {

          foreach ($terms as $term) {
               $termlink = get_term_link($term->name, 'projects');
     ?>
               <button class="category" onclick="window.location.href='<?php echo $termlink ?>';">
                    <h3><?php echo $term->name ?></h3>
               </button>
     <?php }
     } ?>
</div>