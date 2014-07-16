<?php
/*
	Section: Timeline
	Author: Enrique Chavez
	Author URI: http://enriquechavez.co
	Description: The Timeline section is useful to show events or small information blocks in a progressive view with 4 content options: Title, Description, Date (Optional) and Icon, also you can configure all the section colors with 11 options to choose from. This section can be aligned to de right, left or in an odd/even view.
	Class Name: TMSingleTimeline
	Workswith: templates, main, header, morefoot, content
	Cloning: true
	Filter: component
	Loading: active
*/
class TMSingleTimeline extends PageLinesSection {

	function section_opts(){
		$options = array();

		$options[] = array(
			'type'  => 'select',
			'key'   => 'align',
			'label' => __( 'Alignment', 'ec-timeline' ),
			'opts'  => array(
				'align-left'  => array('name' => 'Left' ),
				'align-right' => array('name' => 'Right'),
				'align-none'  => array('name' => 'Center (Default)')


			)
		);

		$options[] = array(
			'type' => 'multi',
			'key' => 'ec_multi_color',
			'title' => __('Box Color Configuration', 'ec-timeline'),
			'opts' => array(
				array(
					'key' => 'ec_tm_title_bg',
					'type' => 'color',
					'title' => __('Box Title Background', 'ec-timeline'),
					'default' => '#669EFF'
				),
				array(
					'key' => 'ec_tm_title_color',
					'type' => 'color',
					'title' => __('Box Title Text Color', 'ec-timeline'),
					'default' => '#ffffff'
				),
				array(
					'key' => 'ec_tm_content_bg',
					'type' => 'color',
					'title' => __('Box Content Background', 'ec-timeline'),
					'default' => '#ffffff'
				),
				array(
					'key' => 'ec_tm_content_color',
					'type' => 'color',
					'title' => __('Box Content Text Color', 'ec-timeline'),
					'default' => '#424242'
				),
				array(
					'key' => 'ec_tm_box_border',
					'type' => 'color',
					'title' => __('Box Border Shadow', 'ec-timeline'),
					'default' => '#dadada'
				)
			)
		);

		$options[] = array(
			'type' => 'multi',
			'key' => 'ec_multi_color',
			'title' => __('Timeline Color Configuration', 'ec-timeline'),
			'opts' => array(
				array(
					'key' => 'ec_tm_line_color',
					'type' => 'color',
					'title' => __('Timeline Color', 'ec-timeline'),
					'default' => '#f5f5f5'
				),
				array(
					'key' => 'ec_tm_icon_bg',
					'type' => 'color',
					'title' => __('Icon Background Color', 'ec-timeline'),
					'default' => '#dadada'
				),
				array(
					'key' => 'ec_tm_icon_text',
					'type' => 'color',
					'title' => __('Icon Color', 'ec-timeline'),
					'default' => '#ffffff'
				),
				array(
					'key' => 'ec_tm_icon_bg_hover',
					'type' => 'color',
					'title' => __('Icon Hover Background Color', 'ec-timeline'),
					'default' => '#669EFF'
				),
				array(
					'key' => 'ec_tm_icon_text_hover',
					'type' => 'color',
					'title' => __('Icon Hover Color', 'ec-timeline'),
					'default' => '#ffffff'
				),
				array(
					'key' => 'ec_tm_icon_border_hover',
					'type' => 'color',
					'title' => __('Icon Hover Border Color', 'ec-timeline'),
					'default' => '#B4D0FF'
				),
			)
		);

		$options[] = array(
			'key'       => 'time_array',
			'type'      => 'accordion',
			'col'       => 2,
			'title'     => __('Timeline Setup', 'ec-timeline'),
			'post_type' => __('Event', 'ec-timeline'),
			'opts'      => array(
				array(
					'key'		=> 'title',
					'label'		=> __( 'Event Title', 'ec-timeline' ),
					'type'		=> 'text'
				),
				array(
					'key'   => 'text',
					'label' => __( 'Description', 'ec-timeline' ),
					'type'  => 'textarea'
				),
				array(
					'key'   => 'icon',
					'label' => __( 'Icon (Icon Mode)', 'ec-timeline' ),
					'type'  => 'select_icon'
				),
				array(
					'key'   => 'date',
					'label' => __( 'Event Date (Optional)', 'ec-timeline' ),
					'type'  => 'text'
				),
				array(
					'key'   => 'time',
					'label' => __( 'Event Time (Optional)', 'ec-timeline' ),
					'type'  => 'text'
				)
			)
		);

		return $options;
	}

	function section_head(){
		$title_bg         = ($this->opt('ec_tm_title_bg')) ? pl_hashify($this->opt('ec_tm_title_bg')) :'#669EFF';
		$title_color      = ($this->opt('ec_tm_title_color')) ? pl_hashify($this->opt('ec_tm_title_color')) :'#ffffff';
		$content_bg       = ($this->opt('ec_tm_content_bg')) ? pl_hashify($this->opt('ec_tm_content_bg')) :'#ffffff';
		$content_color    = ($this->opt('ec_tm_content_color')) ? pl_hashify($this->opt('ec_tm_content_color')) :'#424242';
		$shadow_color     = ($this->opt('ec_tm_box_border')) ? pl_hashify($this->opt('ec_tm_box_border')) :'#dadada';
		$line_bg          = ($this->opt('ec_tm_line_color')) ? pl_hashify($this->opt('ec_tm_line_color')) :'#f5f5f5';
		$icon_bg          = ($this->opt('ec_tm_icon_bg')) ? pl_hashify($this->opt('ec_tm_icon_bg')) :'#dadada';
		$icon_color       = ($this->opt('ec_tm_icon_text')) ? pl_hashify($this->opt('ec_tm_icon_text')) :'#ffffff';
		$icon_bg_hover    = ($this->opt('ec_tm_icon_bg_hover')) ? pl_hashify($this->opt('ec_tm_icon_bg_hover')) :'#669EFF';
		$icon_color_hover = ($this->opt('ec_tm_icon_text_hover')) ? pl_hashify($this->opt('ec_tm_icon_text_hover')) :'#ffffff';
		$icon_border_hover = ($this->opt('ec_tm_icon_border_hover')) ? pl_hashify($this->opt('ec_tm_icon_border_hover')) :'#B4D0FF';


	?>
		<style>
			/* TimeLine <?php echo $this->prefix() ?>*/
			<?php echo $this->prefix() ?> .timeline li .title{background: <?php echo $title_bg; ?>;color: <?php echo $title_color; ?>;}
			<?php echo $this->prefix() ?> .timeline li .label-box:after{border-right-color:<?php echo $title_bg; ?>;}
			<?php echo $this->prefix() ?> .timeline li:nth-child(odd) .label-box:after{border-left-color: <?php echo $title_bg; ?>;border-right-color: transparent;}
			<?php echo $this->prefix() ?> .timeline li .details{background: <?php echo $content_bg; ?>;color: <?php echo $content_color; ?>;}
			<?php echo $this->prefix() ?> .timeline li .details .dates{color: <?php echo $content_color; ?>;}
			<?php echo $this->prefix() ?> .timeline li .label-box{box-shadow: 0px 0px 2px <?php echo $shadow_color; ?>;}
			<?php echo $this->prefix() ?> .timeline:before{background: <?php echo $line_bg; ?>}
			<?php echo $this->prefix() ?> .timeline li .icon{background: <?php echo $icon_bg;?>; color:<?php echo $icon_color;?>; box-shadow: 0 0 0 8px <?php echo $line_bg; ?>; }
			<?php echo $this->prefix() ?> .timeline li:hover .icon{background: <?php echo $icon_bg_hover;?>; color:<?php echo $icon_color_hover;?>; box-shadow: 0 0 0 8px <?php echo $icon_border_hover; ?>; }
			<?php echo $this->prefix() ?> .timeline.align-left li .label-box:after{border-left-color: <?php echo $title_bg;?>;border-right-color: transparent;}
			<?php echo $this->prefix() ?> .timeline.align-left li:nth-child(odd) .label-box:after{border-left-color: <?php echo $title_bg; ?>;border-right-color: transparent;}
			<?php echo $this->prefix() ?> .timeline.align-right li .label-box:after{border-right-color: <?php echo $title_bg;?>; border-left-color: transparent;}
			<?php echo $this->prefix() ?> .timeline.align-right li:nth-child(odd) .label-box:after{border-right-color: <?php echo $title_bg;?>;border-left-color: transparent;}

			/* END TimeLine <?php echo $this->prefix() ?>*/
		</style>
	<?php

	}

	function section_template(){

		$align = ( $this->opt('align') ) ? $this->opt('align') : 'align-center';
		$time_array = $this->opt('time_array');
	?>
		<div class="row">
			<div class="span12">
				<ul class="timeline <?php echo $align ?>">
					<?php 	if (!is_array($time_array)){
								$time_array = array('','','');
							}
							$count = 1;
					?>
						<?php
							foreach ($time_array as $event):

								$title = pl_array_get( 'title', $event, 'Event '. $count);

								$text  = pl_array_get( 'text',  $event, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean id lectus sem. Cras consequat lorem. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean id lectus sem. Cras consequat lorem.');

								$icon = pl_array_get( 'icon', $event );

								if(!$icon || $icon == ''){
									$icons = pl_icon_array();
									$icon = $icons[ array_rand($icons) ];
								}

								$date = pl_array_get( 'date', $event, false);
								$time = pl_array_get( 'time', $event, false);
						?>
							<li>
						        <div class="icon icon-<?php echo $icon ?>"></div>
						        <div class="label-box">
									<div class="title" data-sync="time_array_item<?php echo $count?>_title"><?php echo $title ?></div>
									<div class="details hentry" data-sync="time_array_item<?php echo $count?>_text">
									<?php echo do_shortcode($text); ?>
										<span class="dates">
											<span data-sync="time_array_item<?php echo $count?>_date">
												<?php if ($date): ?>
													<?php echo $date ?>
												<?php endif ?>
											</span>
											<?php if ($date && $time): ?> - <?php endif ?>
											<span data-sync="time_array_item<?php echo $count?>_time">
												<?php if ($time): ?>
													<?php echo $time ?>
												<?php endif ?>
											</span>

										</span>
						            </div>
						        </div>
						    </li>

						<?php $count++; endforeach ?>
				</ul>
			</div>
		</div>
	<?php
	}

}