<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class() ?>>
        <header>
            <?php if(is_front_page()): ?>
            <h3><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
            <?php else: ?>
            <h1 class="h3"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h1>
            <?php endif; ?>
            <time datetime="<?php the_time('Y-m-d')?>"><?php the_time('F jS, Y') ?></time>
            -
            <span class="cat"><?php the_category(', ') ?><?php edit_post_link('Edit', ' - '); ?>
        </header>
        <?php the_content(); ?>
        <?php
            $mediaImages = get_post_meta($post->ID, 'media-images', true);
            $mediaImages = json_decode($mediaImages, true);

            $mediaLinks = get_post_meta($post->ID, 'media-links', true);
            $mediaLinks = json_decode($mediaLinks, true);
        ?>
        <?php if(!empty($mediaImages) || !empty($mediaLinks)): ?>
            <section class="dresser">
                <?php if(!empty($mediaLinks)): ?>
                    <?php if(is_array($mediaLinks)): ?>
                        <?php foreach($mediaLinks as $title => $link): ?>
                            <a href="<?=$link?>"><i class="icon-link"></i><span><?=$title?><span></a>
                        <?php endforeach; ?>
                    <?php else: ?>
                        Incorrect data type
                    <?php endif; ?>
                <?php endif; ?>
                <?php if(!empty($mediaImages)): ?>
                <div class="drawer drawer-single">
                    <?php if(is_array($mediaImages)): ?>
                        <?php foreach($mediaImages as $alt => $image): ?>
                            <a class="img magnific" href="<?=$image;?>">
                            	<img src="<?=$image;?>" alt="<?=$alt?>" />
                            </a>
                        <?php endforeach; ?>
                    <?php else: ?>
                        Incorrect data type
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </section>
        <?php endif; ?>
    </article>

    <?php endwhile; ?>

    <nav class="clear">
        <div class="older"><?php next_posts_link('Older') ?></div>
        <div class="newer"><?php previous_posts_link('Newer') ?></div>
    </nav>

<?php else : ?>

    <h2>Not Found</h2>
    <p>Sorry, but you are looking for something that isn't here.</p>
    <?php get_search_form(); ?>

<?php endif; ?>