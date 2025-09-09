<?php if ( have_rows( 'hero_repeater' ) ) : ?>
    <style>
        <?php $index = 1; ?>
        <?php while ( have_rows( 'hero_repeater' ) ) : the_row(); ?>
            .tabs input[name="tab-control"]:nth-of-type(<?php echo $index; ?>):checked ~ .card-content--container > div:nth-child(<?php echo $index; ?>) {
                display: grid;
                gap: 2rem;
            }

            .tabs input[name="tab-control"]:nth-of-type(<?php echo $index; ?>):checked ~ .card-btns > li:nth-child(<?php echo $index; ?>) {
                border-color: #342b64;
            }

            .tabs input[name="tab-control"]:nth-of-type(<?php echo $index; ?>):checked ~ .card-btns.lines > li:nth-child(<?php echo $index; ?>) {
                background-color: #d8d8d8;
            }
            <?php $index++; ?>
        <?php endwhile; ?>
    </style>
<?php endif; ?>