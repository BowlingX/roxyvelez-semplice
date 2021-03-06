<?php

// add mobile detection
$detect = new Mobile_Detect;

// muted video
$muted = 'muted';
$vimeoUrl = get_field('vimeo_url');
// is linked to a project?
if (filter_var(get_field('cover_link'), FILTER_VALIDATE_BOOLEAN) === TRUE) {
    $is_link = true;
    $link = '<a class="cover-link" href="' . get_field('link') . '"></a>';
} else {
    $is_link = false;
}

// bg data
if (get_field('cover_bg_image') && get_field('cover_bg_type') === 'image') {
    $bg_data = 'image';
} elseif (get_field('cover_bg_type') === 'video') {
    $bg_data = 'video';
} else {
    $bg_data = 'color';
}

$backgroundFlag = get_field('video_mute') !== 'no';

// unmute video
if (get_field('cover_bg_type') === 'video' && get_field('video_mute') === 'no') {
    $muted = false;
}

if ($is_link) : echo $link; endif;
echo '<div class="cover-' . get_the_id() . ' fullscreen-cover" data-bg-type="' . $bg_data . '
    " data-cover-id="' . get_the_id() . '">';
if (get_field('cover_bg_type') === 'image') : ?>
    <div class="cover-image"
         data-parallax-scrolling="<?php if (get_field('cover_parallax')) :
             echo get_field('cover_parallax');
         else : echo 'enabled'; endif; ?>" <?php if (get_field('cover_bg_zoom') === 'enabled') {
        echo 'data-image-zoom="zoom"';
    } ?> <?php if (get_field('cover_bg_image_scale') === 'actual-size') :
        echo 'data-bg-align="' . get_field('cover_bg_image_align') . '"'; endif; ?>></div>
<?php else : ?>
    <?php $video_type = get_field('cover_videotype'); ?>
    <div
        style=" <?= $backgroundFlag? '' : 'background:'.get_field('video_width') ?>"
        class="cover-video flex-center cover-video-responsive <?= $backgroundFlag ? 'just-background' : '' ?>"
        data-has-bg="true">
        <div class="box-round" data-play-cover="video-modal"
             style="<?= !$backgroundFlag ?
                 'background:linear-gradient(to right, rgba(255, 249, 240, 0.13), rgba(255, 249, 240, 0.13)), url('.get_field('video_fallback_bg').')' : '' ?>">
            <i class="icon-play"></i>
        </div>
        <div id="video-modal" class="modal video-modal">
            <i data-close-modal class="modal-close icon-cancel"></i>
            <?php if (get_field($video_type . '_mp4')) : ?>
                <div class="video-embed-container">
                    <iframe src="<?php echo get_field($video_type . '_mp4') ?>?api=1"
                            frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
<?php if (filter_var(get_field('hide_cover_headline'), FILTER_VALIDATE_BOOLEAN) !== TRUE) : ?>
    <?php if (get_field('cover_headline') && trim(get_field('cover_headline')) !== '' || get_field('cover_headline_image')) : ?>
        <div class="container">
            <div class="row">
                <div
                    class="cover-headline span12 <?php echo get_field('cover_headline_ver_align'); ?> <?php echo get_field('cover_headline_hor_align'); ?>"
                    data-headline-format="<?php echo get_field('cover_headline_format'); ?>">
                    <?php if (get_field('cover_headline_format') === 'text') : ?>
                        <h1 class="<?php echo get_field('cover_headline_weight'); ?>"><?php echo get_field('cover_headline'); ?></h1>
                    <?php else: ?>
                        <?php

                        // get image src
                        $headline_img = wp_get_attachment_image_src(get_field('cover_headline_image'), 'full');

                        ?>
                        <img class="headline-image" src="<?php echo $headline_img[0]; ?>" alt="<?php the_title(); ?>"/>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>
<?php if (get_field('cover_scroll') === 'visible') : ?>
    <div class="see-more">
        <div class="icon"><?php echo setIcon('arrow_down'); ?></div>
    </div>
<?php endif; ?>
</div>