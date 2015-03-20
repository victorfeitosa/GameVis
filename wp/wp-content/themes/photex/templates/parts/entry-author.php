<article class="post-author-info row-fluid">
    <figure class="span1">
        <?php echo get_avatar(get_the_author_meta('ID'), '62', get_template_directory_uri().'/style/img/autor.jpg')?>
    </figure>
    <section class="span11">
        <h5><?php the_author_posts_link();?></h5>
        <?php echo get_the_author_meta('description'); ?>
    </section>
</article>