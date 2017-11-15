<?php

use ITGolo\Houses\Modules\Front\Services\CreatorQuery;

/**
 * The template for displaying archive custom pages domy
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 */
get_header();
?>

<div class="wrap">
    <div class="filtr">
        <form method="GET" action="<?php echo home_url('domy') ?>">
            <label for="typy-domow">Filtr - typ domów:</label>
            <select name="typy-domow" id="typy-domow"  onchange='if (this.value != 0) {
                            this.form.submit();
                        }'>
                <?php foreach (CreatorQuery::getTypyDomow() as $value => $text): ?>
                    <option value="<?php echo esc_attr($value); ?>" <?php
                    if (CreatorQuery::isSelectedTypDomu($value)) :echo 'selected="selected"';
                    endif;
                    ?>>
                    <?php echo esc_html($text); ?>
                    </option>
<?php endforeach; ?>
            </select>
        </form>
    </div>
        <?php 
        $query = CreatorQuery::query();
        if ($query->have_posts()) : ?>
        <header class="page-header">
            <?php
            the_archive_title('<h1 class="page-title">', '</h1>');
            the_archive_description('<div class="taxonomy-description">', '</div>');
            ?>
        </header><!-- .page-header -->
<?php endif; ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <?php if ($query->have_posts()) : ?>
                <?php
                /* Start the Loop */
                while ($query->have_posts()) : $query->the_post();

                    /*
                     * Include the Post-Format-specific template for the content.
                     * If you want to override this in a child theme, then include a file
                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                     */
                    get_template_part('template-parts/post/content', get_post_format());

                endwhile;

                the_posts_pagination(array(
                    'prev_text' => twentyseventeen_get_svg(array('icon' => 'arrow-left')) . '<span class="screen-reader-text">' . __('Previous page', 'twentyseventeen') . '</span>',
                    'next_text' => '<span class="screen-reader-text">' . __('Next page', 'twentyseventeen') . '</span>' . twentyseventeen_get_svg(array('icon' => 'arrow-right')),
                    'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'twentyseventeen') . ' </span>',
                ));

            else :

                get_template_part('template-parts/post/content', 'none');

            endif;
            ?>

        </main><!-- #main -->
    </div><!-- #primary -->
<?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php
get_footer();
