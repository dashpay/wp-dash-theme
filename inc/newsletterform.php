<div class="subscription-form">
  <form name="dash-nl" id="dash-nl" class="sg-widget" method="get" action="https://sg.subscribe.dash.org/subscribe">
    <div class="form-row">
      <img src="wp-content/themes/dash-theme/assets/img/email.svg" alt="Email Icon">

      <input
        class="sg_email"
        type="text"
        name="contacts"
        id="emailInput"
        placeholder="<?php esc_attr_e('Subscribe to email newsletter', 'dash-theme'); ?>"
        onfocus="this.placeholder='<?php echo esc_js(__('type your email', 'dash-theme')); ?>'"
        onblur="this.placeholder='<?php echo esc_js(__('Subscribe to email newsletter', 'dash-theme')); ?>'">

      <button type="submit" class="sg-submit-btn" style="display: none;">
        <?php _e('Subscribe', 'dash-theme'); ?>
      </button>

      <div id="successMessage" class="hidden-message">
        <?php _e('You have been successfully subscribed!', 'dash-theme'); ?>
      </div>
    </div>
  </form>
</div>

<div id="emailError"></div>

