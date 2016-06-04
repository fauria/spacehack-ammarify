<?php
/**
 * Template for fixed audio player.
 * Created by themify
 * @since 1.0.0
 */

$album = get_page_by_path( themify_get( 'setting-audio_player' ), OBJECT, 'album' );
?>

<div id="footer-player" class="jukebox">
	<div class="footer-player-inner pagewidth clearfix">
                <?php  $type = themify_get('setting-audio_player_type');?>
		<?php if((!$type || $type=='album') && has_post_thumbnail( $album->ID ) ) : ?>
			<?php
			$album_image = wp_get_attachment_image_src( get_post_thumbnail_id( $album->ID ) );
			$size = apply_filters( 'themify_theme_audio_player_image_size', array(
				'w' => 52,
				'h' => 52,
			) );
			$post_image = themify_get_image( 'src=' . $album_image[0] . '&ignore=true&w=' . $size['w'] . '&h=' . $size['h'] ); ?>
			<figure class="post-image clearfix">

				<a href="<?php echo get_permalink( $album->ID ); ?>"><?php echo $post_image; ?></a>

			</figure>

		<?php endif; // if there's a featured image?>

		<div class="tracklist<?php if($type):?> themify_player_<?php echo $type?><?php endif;?>">
			<?php
                       
                        $playlist = '';
                        if($type=='songs'){
                            for($i=1;$i<=7;++$i){
                                $url = themify_get('setting-audio_player_songs_url_'.$i);
                                if(!$url){
                                    continue;
                                }
                                $list = '';
                                $img = themify_get('setting-audio_player_songs_img_'.$i);
                                $title = themify_get('setting-audio_player_songs_title_'.$i);

                                $list.= '[themify_trac src="'.esc_url_raw($url).'"';
                                if($title){
                                    $list.=' title="'.themify_https_esc($title).'"';
                                }
                                if($img){
                                    $list.=' thumb_src="'.themify_https_esc($img).'"';
                                }
                                $list.=']';
                           
                                $playlist.=$list;
                            }
                            $images = 1;
                        }
                        elseif($type=='code'){
                            echo '<div class="footer-player-inner">'.do_shortcode(themify_get('setting-audio_player_code')).'</div>';
                        }
                        else{
                            for ( $track = 1; $track <= apply_filters( 'themify_theme_number_of_tracks', 18 ); $track++ ) {
                                    $list = '';
                                    if ( $song = get_post_meta( $album->ID, 'track_file_' . $track, true ) ) {
                                            $list .= '[themify_trac';
                                            if ( $song_title = get_post_meta( $album->ID, 'track_name_' . $track, true ) ) {
                                                    $list .= ' title="' . $song_title . '"';
                                            }
                                            $list .= ' src="' . esc_url( themify_https_esc( $song ) ) . '"]';
                                    }
                                    if ( '' != $list ) {
                                            $playlist .= $list;
                                    }
                            }
                            $images = 'no';
                            $footer_autoplay = themify_check( 'setting-audio_player_autoplay' ) ? 'preload="auto" autoplay="yes"' : '';
                        }

                        if($playlist){
                            echo do_shortcode( '[themify_playlist type="audio" tracklist="no" tracknumbers="no" images="'.$images.'" artist="no" style="themify" ' . $footer_autoplay . ' ]' . $playlist . '[/themify_playlist]' );
                        }
			?>
		</div>

		<div class="buttons-console-wrap">
                    <a href="#" class="button-switch-player"></a>
		</div>

	</div>
</div>