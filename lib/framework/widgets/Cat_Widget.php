<?php
class Cat_Widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'my_widget',
			'description' => 'My Widget is awesome',
		);
		parent::__construct( 'my_widget', 'Categories Widget', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
    $posts_per_page = 4;
    $category_id = 9;
    $args = array(
        'posts_per_page' => $posts_per_page,
        'category' => $category_id,
    );
    $myposts = get_posts($args);
    ?>
	   <section>
        <h1>أخبار الروشتة</h1>
        <?php
          foreach ($myposts as $post):
            $post_id = $post->ID; ?>
            <div class="media">
              <div class="media-left">
                <a href="<?php the_permalink($post_id); ?>">
                  <?php echo get_the_post_thumbnail($post_id); ?>
                </a>
              </div>
              <div class="media-body">
                <a href="<?php the_permalink($post_id); ?>">
                    <h4 class="media-heading"><?php echo get_the_title($post_id); ?></h4>
                </a>
                ....
              </div>
            </div>
        <?php endforeach; ?>
     </section>
	<?php
  }

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
    $cat_id = ! empty( $instance['cat_id'] ) ? $instance['cat_id'] : 9;
    $posts = ! empty( $instance['posts'] ) ? $instance['posts'] : 4;
		?>
		<p>
  		<label >Cat ID</label>
  		<input class="widefat" name="cat_id" type="number" value="<?php echo $cat_id ?>">
		</p>
    <p>
  		<label >Posts</label>
  		<input class="widefat" name="posts" type="number" value="<?php echo $posts ?>">
		</p>
		<?php
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
    $instance = array();
		$instance['cat_id'] = ( ! empty( $new_instance['cat_id'] ) ) ? strip_tags( $new_instance['cat_id'] ) : '';
    $instance['posts'] = ( ! empty( $new_instance['posts'] ) ) ? strip_tags( $new_instance['posts'] ) : '';
		return $instance;
	}
}

add_action('widgets_init', function(){
	register_widget( 'Cat_Widget' );
});
