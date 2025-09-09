<article class="archive-post">
    <header class="archive-post--header">
        <?php
            if ( ! has_post_thumbnail() == false ) {
                echo '<img class="thumbnail" src="'; the_post_thumbnail_url( 'media' ); echo '" alt="Picture post" loading="lazy" width="300" height="200">';
            }
        ?>
    </header><!-- .archive-post--header -->
    <div class="archive-post--content">
        <a href="<?php the_permalink(); ?>" class="archive-post--permalink">
            <?php the_title( '<h3 class="archive-post--title">', '</h3>' ); ?>
        </a>
    </div><!-- .archive-post--content -->
</article><!-- .archive-post -->