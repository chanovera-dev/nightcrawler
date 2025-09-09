<article class="archive-post">
    <div class="archive-post--content">
        <div class="date"><?= get_the_date(); ?></div>
        <a href="<?php the_permalink(); ?>" class="archive-post--permalink">
            <?php the_title( '<h3 class="archive-post--title">', '</h3>' ); ?>
        </a>
    </div><!-- .archive-post--content -->
</article><!-- .archive-post -->