<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Attesa
 */

if ( ! function_exists( 'attesa_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function attesa_posted_on() {
		
		attesa_before_posted_on();
		
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s" '. attesa_get_schema_markup('data-pub') .'>%2$s</time><time class="updated" datetime="%3$s" '. attesa_get_schema_markup('data-mod') .'>%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$byline = '<span class="author vcard" '. attesa_get_schema_markup('author') .'><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';
		if (attesa_check_meta('date')) {
			echo '<span class="posted-on" '. attesa_get_schema_markup('post-date') .'><i class="' . esc_attr(attesa_get_fontawesome_icons('calendar')) . ' spaceRight" aria-hidden="true"></i>' . $time_string . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		if (attesa_check_meta('author')) {
			echo '<span class="byline"><i class="' . esc_attr(attesa_get_fontawesome_icons('user')) . ' spaceRight" aria-hidden="true"></i>' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		if ( attesa_check_meta('comments') && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link"><i class="' . esc_attr(attesa_get_fontawesome_icons('comments')) . ' spaceRight" aria-hidden="true"></i>';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'attesa' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}
		
		attesa_after_posted_on();

	}
endif;

if ( ! function_exists( 'attesa_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function attesa_entry_footer() {
		
		attesa_before_entry_footer();
		
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			$categories_list = get_the_category_list( ', ' );
			if ( $categories_list && has_category() && attesa_check_meta('categories') ) {
				echo '<span class="cat-links smallText"><i class="' . esc_attr(attesa_get_fontawesome_icons('categories')) . ' spaceRight" aria-hidden="true"></i>' . $categories_list . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			$tags_list = get_the_tag_list( '', ', ' );
			if ( $tags_list && attesa_check_meta('tags') ) {
				echo '<span class="tags-links smallText"><i class="' . esc_attr(attesa_get_fontawesome_icons('tags')) . ' spaceRight" aria-hidden="true"></i>' . $tags_list . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'attesa' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link smallText"><i class="' . esc_attr(attesa_get_fontawesome_icons('edit')) . ' spaceRight" aria-hidden="true"></i>',
			'</span>'
		);
		
		attesa_after_entry_footer();
		
	}
endif;

if ( ! function_exists( 'attesa_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function attesa_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>
			<div class="post-thumbnail">
				<?php
					$image_size = 'attesa-the-post';
					if ( ! is_active_sidebar( attesa_get_classic_sidebar() ) || ! attesa_check_bar('classic') ) {
						$image_size = 'attesa-the-post-big';
					}
				?>
				<?php if (attesa_options('_schema_markup', '')) {
					the_post_thumbnail( $image_size, array(
						'itemprop' => 'image',
						'class' => 'attesa-feat-image-single'
					) );
				} else {
					the_post_thumbnail( $image_size, array(
						'class' => 'attesa-feat-image-single'
					) );
				} ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>
			<?php if (attesa_options('_show_featimage_mainblog', '1') == '1') : ?>
				<a class="post-thumbnail hover_<?php echo esc_attr(attesa_options('_imagehover_effect', 'none')); ?>" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
					<?php
					if (attesa_options('_show_posts', 'excerpt') != 'grid') {
						the_post_thumbnail( 'attesa-the-post', array(
							'alt' => the_title_attribute( array(
								'echo' => false,
							),
						), 'class' => 'attesa-feat-image-loop' ) );
					} else {
						the_post_thumbnail( 'attesa-small', array(
							'alt' => the_title_attribute( array(
								'echo' => false,
							),
						), 'class' => 'attesa-feat-image-loop' ) );
					}
					?>
				</a>
			<?php endif; ?>
		<?php
		endif; // End is_singular().
	}
endif;
