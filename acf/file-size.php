<!-- ACF File (Using ID) for showing links and file size -->

<div class="row">
    <div class="col-lg-12">
        <?php if( have_rows('download_item') ): while ( have_rows('download_item') ) : the_row(); ?>
            <?php
            $title = get_sub_field('title');
            $desc = get_sub_field('description');
            $pdf = get_sub_field('download_pdf');
            $pdf_name = get_sub_field('link_name');
            $size = 'large'; 
            $pdf_link = wp_get_attachment_url( $pdf );

            $attachment_id = get_sub_field('download_pdf');
            $url = wp_get_attachment_url( $attachment_id );

                    // get the filesize
            $filesize = filesize( get_attached_file( $attachment_id ) );
            $filesize = size_format($filesize, 2);

            ?>
            <article class="item">
               <h2><?php echo $title ?></h2>
               <p><?php echo $desc ?></p>
               <div class="row">
                <div class="col-lg-6 col-sm-12 download"><a href="<?php echo esc_html($pdf_link) ?>" target="_blank">Download <?php echo $pdf_name ?> (<?php echo $filesize; ?>)</a></div>
                <div class="col-lg-6 col-sm-12 email-pdf"><a href="mailto:?body=<?php echo esc_html($pdf_link) ?>">Email this Asset</a></div>
            </div>
        </article>

        
    <?php endwhile; endif; ?>
</div>
</div>