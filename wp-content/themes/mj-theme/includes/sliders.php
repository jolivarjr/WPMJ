<div class="slider-content-home">
    <div class="container">
        <div class="owl-carousel">
            <?php $get_posts = get_posts(['posts_per_page' => -1, 'post_type' => 'sliders']); ?>
            <?php if ($get_posts) : ?>
                <?php foreach ($get_posts as $slider) : ?>
                    <?php
                    $link = get_post_meta($slider->ID, 'link', true);
                    $abrir_em_outra_aba = get_post_meta($slider->ID, 'abrir_em_outra_aba', true);
                    ?>
                    <div class="slider-container">
                        <?php if ($link) : ?>
                            <a href="<?= $link ?>" title="<?= $slider->post_title ?>" target="<?= ($abrir_em_outra_aba) ? '_blank' : '_self' ?>">
                            <?php endif; ?>

                            <?php echo get_the_post_thumbnail($slider->ID, 'large', '') ?>

                            <?php if ($link) : ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>