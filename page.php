<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>

    <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
        <header>
            <h1 class="h3"><?php the_title(); ?></h1>
        </header>
        <?php the_content(); ?>
    </article>

    <?php endwhile; ?>

    <nav class="clear">
        <div class="older"><?php next_posts_link('Older') ?></div>
        <div class="newer"><?php previous_posts_link('Newer') ?></div>
    </nav>

<?php endif; ?>