<?php 

// Pull in Taxonomy terms and the posts that they relate to. (This was used in CTLGroup website)

$custom_terms = get_terms('custom_taxonomy');

foreach($custom_terms as $custom_term) {
    wp_reset_query();
    $args = array('post_type' => 'custom_post_type',
        'tax_query' => array(
            array(
                'taxonomy' => 'custom_taxonomy',
                'field' => 'slug',
                'terms' => $custom_term->slug,
            ),
        ),
     );

     $loop = new WP_Query($args);
     if($loop->have_posts()) {
        echo '<h2>'.$custom_term->name.'</h2>';

        while($loop->have_posts()) : $loop->the_post();
            echo '<a href="'.get_permalink().'">'.get_the_title().'</a><br>';
        endwhile;
     }
}

 ?>


<?php 

 // Simply output the tax and children (simple method)

wp_list_categories( array(
'taxonomy'  => 'consulting_services',
'title_li' => ''
) ); 
?>



<?php

// To pull the parent taxonomy and then show the children terms (used in CTLGroup website)
$services = get_terms(
    array(
        'taxonomy'   => array( 'consulting_services' ),
        'hide_empty' => false,
        'parent' => 0
    )
);
?>

<?php foreach ( $services as $service_term ) { ?>
  <div class="row service">
    
    <div class="col-lg-6 primary">
       <!-- Parent Term -->
      <h3> <?php echo esc_html( $service_term->name ); ?></h3> 
    </div>

    <div class="col-lg-6 secondary">
      <!-- Get Children of Taxonomy -->
      <?php
        $parent_term = $service_term->term_id;
        $parent_term_tax = $service_term->taxonomy;
      ?>
      <?php
      $child_terms = get_terms( array(
        'taxonomy' => $parent_term_tax, 
        'child_of' => $parent_term,
        'parent' => $parent_term, 
        'hide_empty' => false,
      ) );
      ?>  

      <?php 
      if ($child_terms) {
        echo '<ul class="second-level-terms">';

        foreach ($child_terms as $child_term) {
          $second_term_name = $child_term->name;
          echo '<li class="second-level-term">'. '<a href="'.get_permalink().'">' .$second_term_name. '</a>'.'</li>';
        }
        echo '</ul>';
      }
      ?>
    </div>
  </div> 
<?php } ?>
      
      

    