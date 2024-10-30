<div class="wrap">
	<div id="col-container">
		<div id="col-right">
			<div class="col-wrap">
				<div class="inside">
					<?php
					if($add_screen) {
						?>
						<div class="involve-me-introduction" style="max-width: 320px;">
							<img style="width: 85%" src="https://www.involve.me/assets/images/logo.svg"
							     alt="Involve.me"/>
							<p>
								involve.me's plugin allows you to add responsive forms, quizzes, surveys and calculators
								designed in its drag & drop online funnel builder. Create or edit your project on the
								platform:
							</p>
							<a target="_blank" class="button-secondary"
							   href="https://app.involve.me/login/?utm_source=wp-plugin&utm_medium=wp&utm_content=new-embed">Get your project URL</a>
						</div>
						<?php
					} else {
						?>
						<p><?php esc_attr_e('Save to preview updates', 'involveme'); ?></p>
						<?php
						InvolvemePost::embed($post_id, true, ${InvolvemePost::$input_prefix . 'preview'});
					} ?>
					<br/>

				</div>
			</div>
		</div>

		<div id="col-left">
			<div class="col-wrap">
				<div class="inside">
					<input id="involveme_iframe_project_url" required
					       placeholder="<?php esc_attr_e('Paste involve.me project URL', 'involveme'); ?>"
					       name="involveme_iframe_project_url" type="url"
					       value="<?php echo esc_url(${InvolvemePost::$input_prefix . 'project_url'}) ?>"
					       class="large-text"/>
					<table class="form-table">
						<tr valign="top">
							<td scope="row"><label for="involveme_iframe_dynamic_height_resize"><?php esc_attr_e(
										'Embed type', 'involveme'
									); ?></label></td>
							<td>
								<label title='<?php esc_attr_e('Standard', 'involveme'); ?>'>
									<input
											type="radio" <?php checked(${InvolvemePost::$input_prefix . 'embed_mode'}, 'standard'); ?>
											name="involveme_iframe_embed_mode" id="involveme_iframe_standard"
											value="standard" />
									<span><?php esc_attr_e('Standard', 'involveme'); ?></span>
								</label><br>
								<label title='<?php esc_attr_e('Full-page', 'involveme'); ?>'>
									<input type="radio" name="involveme_iframe_embed_mode" value="full-page"
									       id="involveme_iframe_full_page" <?php checked(${InvolvemePost::$input_prefix . 'embed_mode'}, 'full-page'); ?> />
									<span><?php esc_attr_e('Full-Page', 'involveme'); ?></span>
								</label><br>
								<label title='<?php esc_attr_e('Popup', 'involveme'); ?>'>
									<input type="radio" name="involveme_iframe_embed_mode" value="popup"
									       id="involveme_iframe_popup" <?php checked(${InvolvemePost::$input_prefix . 'embed_mode'}, 'popup'); ?> />
									<span><?php esc_attr_e('Popup', 'involveme'); ?></span>
								</label><br>
								<label title='<?php esc_attr_e('Chat Button', 'involveme'); ?>'>
									<input type="radio" name="involveme_iframe_embed_mode" value="chatButton"
									       id="involveme_iframe_chatButton" <?php checked(${InvolvemePost::$input_prefix . 'embed_mode'}, 'chatButton'); ?> />
									<span><?php esc_attr_e('Chat Button', 'involveme'); ?></span>
								</label><br>
								<label title='<?php esc_attr_e('Side Panel', 'involveme'); ?>'>
									<input type="radio" name="involveme_iframe_embed_mode" value="sidePanel"
									       id="involveme_iframe_sidePanel" <?php checked(${InvolvemePost::$input_prefix . 'embed_mode'}, 'sidePanel'); ?> />
									<span><?php esc_attr_e('Side Panel', 'involveme'); ?></span>
								</label><br>
								<label title='<?php esc_attr_e('Side Tab', 'involveme'); ?>'>
									<input type="radio" name="involveme_iframe_embed_mode" value="sideTab"
									       id="involveme_iframe_sideTab" <?php checked(${InvolvemePost::$input_prefix . 'embed_mode'}, 'sideTab'); ?> />
									<span><?php esc_attr_e('Side Tab', 'involveme'); ?></span>
								</label>
							</td>
						</tr>
						<tr valign="top">
							<td scope="row"><label for="involveme_iframe_dynamic_height_resize"><?php esc_attr_e(
										'Dynamic height resize', 'involveme'
									); ?></label></td>
							<td>
								<input
										id="involveme_iframe_dynamic_height_resize" <?php checked(${InvolvemePost::$input_prefix . 'dynamic_height_resize'}); ?>
										name="involveme_iframe_dynamic_height_resize" type="checkbox"
										class="involveme_setting"
										id="involveme_iframe_dynamic_height_resize" value="1"/>
							</td>
						</tr>
						<tr valign="top">
							<td scope="row"><label for="involveme_iframe_minimal_height"><?php esc_attr_e(
										'Minimum height (px)', 'involveme'
									); ?></label></td>
							<td><input id="involveme_iframe_minimal_height"
							           value="<?php echo esc_attr(${InvolvemePost::$input_prefix . 'minimal_height'}) ?>"
							           name="involveme_iframe_minimal_height" type="text" class="small-text involveme_setting"/></td>
						</tr>
						<tr data-show="" valign="top">
							<td scope="row"><label for="involveme_iframe_width"><?php esc_attr_e(
										'Width (px)', 'involveme'
									); ?></label></td>
							<td><input id="involveme_iframe_width"
							           value="<?php echo esc_attr(${InvolvemePost::$input_prefix . 'width'}) ?>"
							           name="involveme_iframe_width" type="text" class="small-text involveme_setting"/></td>
						</tr>

						<tr valign="top">
							<td scope="row"><label for="involveme_iframe_show_popup"><?php esc_attr_e(
										'Show popup', 'involveme'
									); ?></label></td>
							<td><select id="involveme_iframe_show_popup"
							            class="involveme_setting"
							            name="involveme_iframe_show_popup">
									<option value="button" <?php selected(${InvolvemePost::$input_prefix . 'show_popup'}, 'button_click'); ?>>
										<?php esc_attr_e('On button click', 'involveme'); ?>
									</option>
									<option value="exit" <?php selected(${InvolvemePost::$input_prefix . 'show_popup'}, 'exit'); ?>>
										<?php esc_attr_e('On exit intent', 'involveme'); ?>
									</option>
									<option value="load" <?php selected(${InvolvemePost::$input_prefix . 'show_popup'}, 'load'); ?>>
										<?php esc_attr_e('On page load', 'involveme'); ?>
									</option>
									<option value="timer" <?php selected(${InvolvemePost::$input_prefix . 'show_popup'}, 'timer'); ?>>
										<?php esc_attr_e('After time delay', 'involveme'); ?>
									</option>
								</select>

							</td>
						</tr>
						<tr valign="top">
							<td scope="row"><label for="involveme_iframe_show_popup_side"><?php esc_attr_e(
										'Show popup', 'involveme'
									); ?></label></td>
							<td><select id="involveme_iframe_show_popup_side"
							            class="involveme_setting"
							            name="involveme_iframe_show_popup_side">
									<option value="button" <?php selected(${InvolvemePost::$input_prefix . 'show_popup_side'}, 'button_click'); ?>>
										<?php esc_attr_e('On button click', 'involveme'); ?>
									</option>
									<option value="exit" <?php selected(${InvolvemePost::$input_prefix . 'show_popup_side'}, 'exit'); ?>>
										<?php esc_attr_e('On exit intent', 'involveme'); ?>
									</option>
									<option value="load" <?php selected(${InvolvemePost::$input_prefix . 'show_popup_side'}, 'load'); ?>>
										<?php esc_attr_e('On page load', 'involveme'); ?>
									</option>
									<option value="timer" <?php selected(${InvolvemePost::$input_prefix . 'show_popup_side'}, 'timer'); ?>>
										<?php esc_attr_e('After time delay', 'involveme'); ?>
									</option>
									<option value="fixedButton" <?php selected(${InvolvemePost::$input_prefix . 'show_popup_side'}, 'fixedButton'); ?>>
										<?php esc_attr_e('On Side label click', 'involveme'); ?>
									</option>
								</select>

							</td>
						</tr>
						<tr valign="top">
							<td scope="row"><label for="involveme_iframe_position"><?php esc_attr_e(
										'Position', 'involveme'
									); ?></label></td>
							<td><select id="involveme_iframe_position"
							            class="involveme_setting"
							            name="involveme_iframe_position">
									<option value="right" <?php selected(${InvolvemePost::$input_prefix . 'position'}, 'right'); ?>>
										<?php esc_attr_e('Right', 'involveme'); ?>
									</option>
									<option value="left" <?php selected(${InvolvemePost::$input_prefix . 'position'}, 'left'); ?>>
										<?php esc_attr_e('Left', 'involveme'); ?>
									</option>
								</select>

							</td>
						</tr>
						<tr valign="top">
							<td scope="row"><label for="involveme_iframe_popup_size"><?php esc_attr_e(
										'Popup size', 'involveme'
									); ?></label></td>
							<td><select id="involveme_iframe_popup_size"
							            class="involveme_setting"
							            name="involveme_iframe_popup_size">
									<option value="large" <?php selected(${InvolvemePost::$input_prefix . 'popup_size'}, 'large'); ?>>
										<?php esc_attr_e('Large', 'involveme'); ?>
									</option>
									<option value="medium" <?php selected(${InvolvemePost::$input_prefix . 'popup_size'}, 'medium'); ?>>
										<?php esc_attr_e('Medium', 'involveme'); ?>
									</option>
									<option value="small" <?php selected(${InvolvemePost::$input_prefix . 'popup_size'}, 'small'); ?>>
										<?php esc_attr_e('Small', 'involveme'); ?>
									</option>
									<option value="mini" <?php selected(${InvolvemePost::$input_prefix . 'popup_size'}, 'mini'); ?>>
										<?php esc_attr_e('Mini', 'involveme'); ?>
									</option>
								</select>

							</td>
						</tr>

						<tr valign="top">
							<td scope="row"><label for="involveme_iframe_icon"><?php esc_attr_e(
										'Icon', 'involveme'
									); ?></label></td>
							<td><select id="involveme_iframe_icon"
							            class="involveme_setting"
							            name="involveme_iframe_icon">
									<option value="speech-bubble" <?php selected(${InvolvemePost::$input_prefix . 'icon'}, 'speech-bubble'); ?>>
										<?php esc_attr_e('Speech bubble', 'involveme'); ?>
									</option>
									<option value="help" <?php selected(${InvolvemePost::$input_prefix . 'icon'}, 'help'); ?>>
										<?php esc_attr_e('Help', 'involveme'); ?>
									</option>
									<option value="feedback" <?php selected(${InvolvemePost::$input_prefix . 'icon'}, 'feedback'); ?>>
										<?php esc_attr_e('Feedback', 'involveme'); ?>
									</option>
									<option value="user" <?php selected(${InvolvemePost::$input_prefix . 'icon'}, 'user'); ?>>
										<?php esc_attr_e('User', 'involveme'); ?>
									</option>
									<option value="megaphone" <?php selected(${InvolvemePost::$input_prefix . 'icon'}, 'megaphone'); ?>>
										<?php esc_attr_e('Megaphone', 'involveme'); ?>
									</option>
									<option value="notes" <?php selected(${InvolvemePost::$input_prefix . 'icon'}, 'notes'); ?>>
										<?php esc_attr_e('Notes', 'involveme'); ?>
									</option>
								</select>

							</td>
						</tr>
						<tr valign="top">
							<td scope="row"><label for="involveme_iframe_icon_side"><?php esc_attr_e(
										'Icon', 'involveme'
									); ?></label></td>
							<td><select id="involveme_iframe_icon_side"
							            class="involveme_setting"
							            name="involveme_iframe_icon_side">
									<option value="speech-bubble" <?php selected(${InvolvemePost::$input_prefix . 'icon_side'}, 'speech-bubble'); ?>>
										<?php esc_attr_e('Speech bubble', 'involveme'); ?>
									</option>
									<option value="help" <?php selected(${InvolvemePost::$input_prefix . 'icon_side'}, 'help'); ?>>
										<?php esc_attr_e('Help', 'involveme'); ?>
									</option>
									<option value="feedback" <?php selected(${InvolvemePost::$input_prefix . 'icon_side'}, 'feedback'); ?>>
										<?php esc_attr_e('Feedback', 'involveme'); ?>
									</option>
									<option value="user" <?php selected(${InvolvemePost::$input_prefix . 'icon_side'}, 'user'); ?>>
										<?php esc_attr_e('User', 'involveme'); ?>
									</option>
									<option value="megaphone" <?php selected(${InvolvemePost::$input_prefix . 'icon_side'}, 'megaphone'); ?>>
										<?php esc_attr_e('Megaphone', 'involveme'); ?>
									</option>
									<option value="notes" <?php selected(${InvolvemePost::$input_prefix . 'icon_side'}, 'notes'); ?>>
										<?php esc_attr_e('Notes', 'involveme'); ?>
									</option>
									<option value="none" <?php selected(${InvolvemePost::$input_prefix . 'icon_side'}, 'none'); ?>>
										<?php esc_attr_e('No Icon', 'involveme'); ?>
									</option>
								</select>

							</td>
						</tr>
						<tr valign="top">
							<td scope="row"><label for="involveme_iframe_button_color"><?php esc_attr_e(
										'Button color', 'involveme'
									); ?></label></td>
							<td><input id="involveme_iframe_button_color" type="text"
							           name="involveme_iframe_button_color" data-alpha-enabled="true"
							           value="<?php echo esc_attr(${InvolvemePost::$input_prefix . 'button_color'}) ?>"
							           class="involveme-color-field involveme_setting" data-default-color="rgba(148, 163, 184, 1)"/></td>
						</tr>

						<tr valign="top">
							<td scope="row"><label for="involveme_iframe_button_text"><?php esc_attr_e(
										'Button text', 'involveme'
									); ?></label></td>
							<td><input id="involveme_iframe_button_text" type="text"
							           name="involveme_iframe_button_text"
							           class="involveme_setting"
							           placeholder="<?php esc_attr_e('Launch popup', 'involveme'); ?>"
							           value="<?php echo esc_attr(${InvolvemePost::$input_prefix . 'button_text'}) ?>"/></td>
						</tr>
						<tr valign="top">
							<td scope="row"><label for="involveme_iframe_trigger_delay"><?php esc_attr_e(
										'Time delay (seconds)', 'involveme'
									); ?></label></td>
							<td><input id="involveme_iframe_trigger_delay" type="text"
							           name="involveme_iframe_trigger_delay"
							           class="involveme_setting"
							           value="<?php echo esc_attr(${InvolvemePost::$input_prefix . 'trigger_delay'}) ?>"/>
							</td>
						</tr>
						<tr valign="top">
							<td scope="row"><label for="involveme_iframe_close_popup_on_completion"><?php esc_attr_e(
										'Close popup on completion', 'involveme'
									); ?></label></td>
							<td>
								<input
										id="involveme_iframe_close_popup_on_completion" <?php checked(${InvolvemePost::$input_prefix . 'close_popup_on_completion'}); ?>
										name="involveme_iframe_close_popup_on_completion" type="checkbox"
										class="involveme_setting" id="involveme_iframe_close_popup_on_completion" value="1"/>
								<small class="warning" id="involveme_iframe_close_popup_on_completion_warning" style="padding-bottom: 5px; display: inline-block"><?php esc_attr_e(
										'This feature requires a Professional subscription or higher plan.', 'involveme'
									); ?></small>
							</td>
						</tr>
						<tr valign="top">
							<td scope="row"><label for="involveme_iframe_time_delay_to_close"><?php esc_attr_e(
										'Time delay to close (seconds)', 'involveme'
									); ?></label></td>
							<td>
								<input id="involveme_iframe_time_delay_to_close"
								       value="<?php echo esc_attr(${InvolvemePost::$input_prefix . 'time_delay_to_close'}) ?>"
								       name="involveme_iframe_time_delay_to_close" type="text" class="small-text involveme_setting"/>
							</td>
						</tr>
						<tr valign="top">
							<td scope="row"><label for="involveme_iframe_stop_showing_once_completed"><?php esc_attr_e(
										'Stop showing once completed', 'involveme'
									); ?></label></td>
							<td>
								<input
										id="involveme_iframe_stop_showing_once_completed" <?php checked(${InvolvemePost::$input_prefix . 'stop_showing_once_completed'}); ?>
										name="involveme_iframe_stop_showing_once_completed" type="checkbox"
										class="involveme_setting" id="involveme_iframe_stop_showing_once_completed" value="1"/>
								<small id="involveme_iframe_stop_showing_once_completed_warning" class="warning" style="padding-bottom: 5px; display: inline-block"><?php esc_attr_e(
										'This feature requires a Professional subscription or higher plan.', 'involveme'
									); ?></small>
							</td>
						</tr>
						<tr valign="top">
							<td scope="row"><label for="involveme_iframe_stop_showing_duration"><?php esc_attr_e(
										'Duration', 'involveme'
									); ?></label></td>
							<td><select id="involveme_iframe_stop_showing_duration"
							            class="involveme_setting"
							            name="involveme_iframe_stop_showing_duration">
									<option value="midnight" <?php selected(${InvolvemePost::$input_prefix . 'stop_showing_duration'}, 'midnight'); ?>>
										<?php esc_attr_e('Midnight in user’s local time', 'involveme'); ?>
									</option>
									<option value="24hours" <?php selected(${InvolvemePost::$input_prefix . 'stop_showing_duration'}, '24hours'); ?>>
										<?php esc_attr_e('24 Hours', 'involveme'); ?>
									</option>
									<option value="7days" <?php selected(${InvolvemePost::$input_prefix . 'stop_showing_duration'}, '7days'); ?>>
										<?php esc_attr_e('7 Days', 'involveme'); ?>
									</option>
									<option value="14days" <?php selected(${InvolvemePost::$input_prefix . 'stop_showing_duration'}, '14days'); ?>>
										<?php esc_attr_e('14 Days', 'involveme'); ?>
									</option>
									<option value="30days" <?php selected(${InvolvemePost::$input_prefix . 'stop_showing_duration'}, '30days'); ?>>
										<?php esc_attr_e('30 Days', 'involveme'); ?>
									</option>
									<option value="60days" <?php selected(${InvolvemePost::$input_prefix . 'stop_showing_duration'}, '60days'); ?>>
										<?php esc_attr_e('60 Days', 'involveme'); ?>
									</option>
									<option value="notes" <?php selected(${InvolvemePost::$input_prefix . 'stop_showing_duration'}, 'indefinite'); ?>>
										<?php esc_attr_e('Indefinite', 'involveme'); ?>
									</option>
								</select>

							</td>
						</tr>
						<tr valign="top">
							<td scope="row"><label for="involveme_iframe_hide_once_viewed"><?php esc_attr_e(
										'Hide once viewed', 'involveme'
									); ?></label></td>
							<td>
								<input
										id="involveme_iframe_hide_once_viewed" <?php checked(${InvolvemePost::$input_prefix . 'hide_once_viewed'}); ?>
										name="involveme_iframe_hide_once_viewed" type="checkbox"
										class="involveme_setting" id="involveme_iframe_hide_once_viewed" value="1"/>
								<small id="involveme_iframe_hide_once_viewed_warning" class="warning" style="padding-bottom: 5px; display: inline-block"><?php esc_attr_e(
										'This feature requires a Professional subscription or higher plan.', 'involveme'
									); ?></small>
							</td>
						</tr>
						<tr valign="top">
							<td scope="row"><label for="involveme_iframe_hide_once_viewed_duration"><?php esc_attr_e(
										'Duration', 'involveme'
									); ?></label></td>
							<td><select id="involveme_iframe_hide_once_viewed_duration"
							            class="involveme_setting"
							            name="involveme_iframe_hide_once_viewed_duration">
									<option value="midnight" <?php selected(${InvolvemePost::$input_prefix . 'hide_once_viewed_duration'}, 'midnight'); ?>>
										<?php esc_attr_e('Midnight in user’s local time', 'involveme'); ?>
									</option>
									<option value="24hours" <?php selected(${InvolvemePost::$input_prefix . 'hide_once_viewed_duration'}, '24hours'); ?>>
										<?php esc_attr_e('24 Hours', 'involveme'); ?>
									</option>
									<option value="7days" <?php selected(${InvolvemePost::$input_prefix . 'hide_once_viewed_duration'}, '7days'); ?>>
										<?php esc_attr_e('7 Days', 'involveme'); ?>
									</option>
									<option value="14days" <?php selected(${InvolvemePost::$input_prefix . 'hide_once_viewed_duration'}, '14days'); ?>>
										<?php esc_attr_e('14 Days', 'involveme'); ?>
									</option>
									<option value="30days" <?php selected(${InvolvemePost::$input_prefix . 'hide_once_viewed_duration'}, '30days'); ?>>
										<?php esc_attr_e('30 Days', 'involveme'); ?>
									</option>
									<option value="60days" <?php selected(${InvolvemePost::$input_prefix . 'hide_once_viewed_duration'}, '60days'); ?>>
										<?php esc_attr_e('60 Days', 'involveme'); ?>
									</option>
									<option value="notes" <?php selected(${InvolvemePost::$input_prefix . 'hide_once_viewed_duration'}, 'indefinite'); ?>>
										<?php esc_attr_e('Indefinite', 'involveme'); ?>
									</option>
								</select>

							</td>
						</tr>
						<tr valign="top">
							<td scope="row"><label for="involveme_iframe_transparent_background"><?php esc_attr_e(
										'Transparent Background', 'involveme'
									); ?></label></td>
							<td>
								<input
										id="involveme_iframe_transparent_background" <?php checked(${InvolvemePost::$input_prefix . 'transparent_background'}); ?>
										name="involveme_iframe_transparent_background" type="checkbox"
										class="involveme_setting" id="involveme_iframe_transparent_background" value="1"/>
							</td>
						</tr>
						<tr valign="top">
							<td scope="row"><label for="involveme_iframe_background_color"><?php esc_attr_e(
										'Loading background color', 'involveme'
									); ?></label></td>
							<td><input id="involveme_iframe_background_color" type="text"
							           name="involveme_iframe_background_color" data-alpha-enabled="true"
							           value="<?php echo esc_attr(${InvolvemePost::$input_prefix . 'background_color'}) ?>"
							           class="involveme-color-field involveme_setting" data-default-color="rgba(255,255,255)"/></td>
						</tr>

						<?php if(!$add_screen) { ?>
							<tr valign="top" style="border-top: 1px solid #c3c4c7">
								<td scope="row"><label><?php esc_attr_e(
											'Shortcode', 'involveme'
										); ?></label></td>
								<td>
									<small style="padding-bottom: 5px; display: inline-block"><?php esc_attr_e(
											'Paste shortcode in your WordPress content', 'involveme'
										); ?></small><br/>
									<code><?php echo esc_html('[' . INVOLVE_ME_SHORTCODE . ' embed="' . $post_id . '"]'); ?></code>
									<a id="involve_me_copy_shortcode_button"
									   data-default-text="<?php esc_attr_e('Copy', 'involveme'); ?>"
									   data-copied-text="<?php esc_attr_e('Copied', 'involveme'); ?>" href="#"
									   data-clipboard-text="<?php echo esc_attr('[' . INVOLVE_ME_SHORTCODE . ' embed="' . $post_id . '"]'); ?>"
									><?php esc_attr_e(
											'Copy', 'involveme'
										); ?>
									</a>
								</td>
							</tr>
						<?php } ?>
					</table>
				</div>

			</div>

		</div>

	</div>
	<div style="clear:both"></div>
	<?php wp_nonce_field('involveme_iframe_customization_box', 'involveme_iframe_customization_box_nonce'); ?>
</div> <!-- .wrap -->
