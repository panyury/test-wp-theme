<?php
$args = array(
    'post_type'      => 'slider',
    'posts_per_page' => 10,
    'orderby'        => 'date',
    'order'          => 'DESC',
);
$query = new WP_Query($args);

if ($query->have_posts()) : ?>
    <div class="slider-container">
        <!-- Верхний блок с заголовками -->
        <div class="title-slider">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                        <div class="swiper-slide"><?php the_title(); ?></div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>

        <!-- Основной слайдер -->
		<div class="main-slader">
			<div class="swiper">
				<div class="swiper-wrapper">
					<?php while ($query->have_posts()) : $query->the_post(); ?>
						<div class="swiper-slide" data-id="<?php the_ID(); ?>">
							<?php if (has_post_thumbnail()) : ?>
								<img src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title(); ?>">
							<?php endif; ?>
						</div>
					<?php endwhile; ?>
				</div>



				<!-- Пагинация -->
				<div class="swiper-pagination"></div>
			</div>
		
			<!-- Стрелки -->
            <div class="swiper-button-next">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
				  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
				</svg>
			</div>
            <div class="swiper-button-prev">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
				  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
				</svg>
			</div>
		</div>
    </div>

    <div id="popup-modal" class="hidden">
		<div class="popup-content">
			<span class="close-modal">&times;</span>
			<div class="popup-header">
				Description
			</div>
			<div class="popup-text"></div>
		</div>
	</div>

    <?php wp_reset_postdata(); ?>
<?php endif; ?>
