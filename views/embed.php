<?php if(in_array(${InvolvemePost::$input_prefix . 'embed_mode'},array('full-page','standard'))) { ?><div
	class="involveme_embed" <?php if(${InvolvemePost::$input_prefix . 'project'}) echo 'data-project="' . esc_attr(${InvolvemePost::$input_prefix . 'project'}) . '"' ?>
	<?php if(${InvolvemePost::$input_prefix . 'width'} != 'auto') echo 'data-width=' . esc_attr(${InvolvemePost::$input_prefix . 'width'}) ?>
	<?php if(${InvolvemePost::$input_prefix . 'minimal_height'} != 'auto') echo 'data-min-height=' . esc_attr(${InvolvemePost::$input_prefix . 'minimal_height'}) ?>
	<?php if(${InvolvemePost::$input_prefix . 'background_color'} && ${InvolvemePost::$input_prefix . 'background_color'} != '#ffffff' && !${InvolvemePost::$input_prefix . 'transparent_background'}) echo 'data-loadcolor=' . esc_attr(${InvolvemePost::$input_prefix . 'background_color'}) ?>
	<?php if(${InvolvemePost::$input_prefix . 'transparent_background'}) echo 'data-transparent-embed="true"' ?>
	<?php if(!${InvolvemePost::$input_prefix . 'dynamic_height_resize'}) echo 'data-noresize="true"' ?>
	<?php if(${InvolvemePost::$input_prefix . 'embed_mode'} == 'full-page' && !${InvolvemePost::$input_prefix . 'preview'}) echo 'data-embed-mode="fullscreen"' ?>
	<?php if(${InvolvemePost::$input_prefix . 'preview'}) echo 'data-params="blind"' ?>
>
	<script
		src="<?php if(${InvolvemePost::$input_prefix . 'domain'}) echo esc_url(${InvolvemePost::$input_prefix . 'domain'}) . '/embed' ?>"></script>
</div>
<?php }elseif((${InvolvemePost::$input_prefix . 'embed_mode'}==='popup' && ${InvolvemePost::$input_prefix . 'show_popup'}==='button')|| (in_array(${InvolvemePost::$input_prefix . 'embed_mode'},array('sideTab','sidePanel')) && ${InvolvemePost::$input_prefix . 'show_popup_side'}==='button')) { ?>
	<button class="involveme_popup" <?php if(${InvolvemePost::$input_prefix . 'project'}) echo 'data-project="' . esc_attr(${InvolvemePost::$input_prefix . 'project'}) . '"'?>
	<?php if(${InvolvemePost::$input_prefix . 'domain'}) echo 'data-organization-url="'.${InvolvemePost::$input_prefix . 'domain'}.'"' ?>
		<?php if(${InvolvemePost::$input_prefix . 'background_color'} && ${InvolvemePost::$input_prefix . 'background_color'} != '#ffffff') echo 'data-loadcolor=' . esc_attr(${InvolvemePost::$input_prefix . 'background_color'}) ?>
	<?php if(${InvolvemePost::$input_prefix . 'embed_mode'}) echo 'data-embed-mode="'.${InvolvemePost::$input_prefix . 'embed_mode'}.'"' ?>
	<?php if(${InvolvemePost::$input_prefix . 'show_popup'} && ${InvolvemePost::$input_prefix . 'embed_mode'}==='popup') echo 'data-trigger-event="'.${InvolvemePost::$input_prefix . 'show_popup'}.'"' ?>
		<?php if(${InvolvemePost::$input_prefix . 'show_popup_side'} && ${InvolvemePost::$input_prefix . 'embed_mode'}!=='popup') echo 'data-trigger-event="'.${InvolvemePost::$input_prefix . 'show_popup_side'}.'"' ?>
	<?php if(${InvolvemePost::$input_prefix . 'popup_size'}) echo 'data-popup-size="'.${InvolvemePost::$input_prefix . 'popup_size'}.'"' ?>
	<?php if(${InvolvemePost::$input_prefix . 'position'} && in_array(${InvolvemePost::$input_prefix . 'embed_mode'},array('sideTab','sidePanel') )) echo 'data-position="'.${InvolvemePost::$input_prefix . 'position'}.'"' ?>
	<?php if(${InvolvemePost::$input_prefix . 'close_popup_on_completion'}) echo 'data-close-on-completion-timer="'.${InvolvemePost::$input_prefix . 'time_delay_to_close'}.'"' ?> ><?php echo ${InvolvemePost::$input_prefix . 'button_text'} ?></button>
<script src="<?php if(${InvolvemePost::$input_prefix . 'domain'}) echo esc_url(${InvolvemePost::$input_prefix . 'domain'}) . '/embed' ?>?type=popup"></script>
	<?php
}else{ ?>
	<script src="<?php if(${InvolvemePost::$input_prefix . 'domain'}) echo esc_url(${InvolvemePost::$input_prefix . 'domain'}) . '/embed' ?>?type=popup"></script>
	<script>


        function hexToRgb(hex) {
            var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
            return result ? {
                r: parseInt(result[1], 16),
                g: parseInt(result[2], 16),
                b: parseInt(result[3], 16)
            } : null;
        }

        function getLightnessPercentage(value) {
            let rgb = {};
            let brightness;

            if(value.startsWith('rgba')) {
                value = value.replace('rgba(', '');
                let rgba = value.split(',');
                rgb.r = parseInt(rgba[0]);
                rgb.g = parseInt(rgba[1]);
                rgb.b = parseInt(rgba[2]);
            }else {
                if (value.startsWith('rgb')) {
                    value = value.replace('rgb(', '');
                    let rgba = value.split(',');
                    rgb.r = parseInt(rgba[0]);
                    rgb.g = parseInt(rgba[1]);
                    rgb.b = parseInt(rgba[2]);
                } else {
                    rgb = hexToRgb(value);
                }
            }

            brightness =
                0.299 * rgb.r +
                0.587 * rgb.g +
                0.114 * rgb.b;
// the results of this formula actually looks less good than the next simpler one:
// const hsp = Math.sqrt(
// 0.299 * (rgb.r * rgb.r) +
// 0.587 * (rgb.g * rgb.g) +
// 0.114 * (rgb.b * rgb.b)
// );
            return brightness / 255 * 100;
        }
        var buttonColor = "<?php echo ${InvolvemePost::$input_prefix . 'button_color'} ?>";
        var buttonTextColor = getLightnessPercentage(buttonColor) > 65 ? '#000000' : '#FFFFFF';

        involvemeEmbedPopup.createTriggerEvent({
            projectUrl: "<?php echo esc_attr(${InvolvemePost::$input_prefix . 'project'}); ?>",
            organizationUrl: "<?php echo esc_attr(${InvolvemePost::$input_prefix . 'domain'}); ?>",
            embedMode: "<?php echo ${InvolvemePost::$input_prefix . 'embed_mode'} ?>",
            <?php if(${InvolvemePost::$input_prefix . 'embed_mode'}==='chatButton') {?>
            triggerEvent: "button",
			<?php }elseif(${InvolvemePost::$input_prefix . 'show_popup'} && ${InvolvemePost::$input_prefix . 'embed_mode'}==='popup'){
				echo 'triggerEvent:"'.${InvolvemePost::$input_prefix . 'show_popup'}.'",'  ?>
			<?php }elseif(${InvolvemePost::$input_prefix . 'show_popup_side'} && ${InvolvemePost::$input_prefix . 'embed_mode'}!=='popup') echo 'triggerEvent:"'.${InvolvemePost::$input_prefix . 'show_popup_side'}.'",' ?>
			popupSize: "<?php echo ${InvolvemePost::$input_prefix . 'popup_size'} ?>",
			position: "<?php echo ${InvolvemePost::$input_prefix . 'position'} ?>",
			<?php if(${InvolvemePost::$input_prefix . 'stop_showing_once_completed'}) echo 'stopShowingDuration:"'.${InvolvemePost::$input_prefix . 'stop_showing_duration'}.'",' ?>
	        <?php if(${InvolvemePost::$input_prefix . 'hide_once_viewed'}) echo 'hideAfterViewedFor:"'.${InvolvemePost::$input_prefix . 'hide_once_viewed_duration'}.'",' ?>
			<?php if(${InvolvemePost::$input_prefix . 'close_popup_on_completion'}) echo 'closeOnCompletionTimer:"'.${InvolvemePost::$input_prefix . 'time_delay_to_close'}.'",' ?>
	        <?php if(${InvolvemePost::$input_prefix . 'show_popup_side'} ==='timer' && in_array(${InvolvemePost::$input_prefix . 'embed_mode'},array('sideTab','sidePanel'))) echo 'triggerTimer:"'.${InvolvemePost::$input_prefix . 'trigger_delay'}.'",' ?>
	        <?php if(${InvolvemePost::$input_prefix . 'show_popup'}==='timer' && ${InvolvemePost::$input_prefix . 'embed_mode'}==='popup') echo 'triggerTimer:"'.${InvolvemePost::$input_prefix . 'trigger_delay'}.'",' ?>
            buttonTextColor: buttonTextColor,
	        buttonText: "<?php echo ${InvolvemePost::$input_prefix . 'button_text'} ?>",
            buttonColor: "<?php echo ${InvolvemePost::$input_prefix . 'button_color'} ?>",
            loadColor: "<?php echo ${InvolvemePost::$input_prefix . 'background_color'} ?>",
			<?php if(${InvolvemePost::$input_prefix . 'embed_mode'}==='chatButton') {?>
            icon: "<?php echo ${InvolvemePost::$input_prefix . 'icon'} ?>"
			<?php } elseif(${InvolvemePost::$input_prefix . 'show_popup_side'} && ${InvolvemePost::$input_prefix . 'embed_mode'}!=='popup' && ${InvolvemePost::$input_prefix . 'icon_side'}!='none') echo 'icon:"'.${InvolvemePost::$input_prefix . 'icon_side'}.'",' ?>
        })
	</script>
<?php } ?>
