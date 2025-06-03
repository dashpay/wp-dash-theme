<div class="subscription-form">
  <form name="dash-nl" id="dash-nl" class="sg-widget" method="get" action="https://sg.subscribe.dash.org/subscribe">
    <div class="form-row">
      <img src="wp-content/themes/dash-theme/assets/img/email.svg" alt="Email Icon">

      <input class="sg_email" type="text" name="contacts" id="emailInput"
        placeholder="Subscribe to email newsletter"
        onfocus="this.placeholder='type your email'"
        onblur="this.placeholder='Subscribe to email newsletter'">

      <button type="submit" class="sg-submit-btn" style="display: none;">Subscribe</button>

      <div id="successMessage" class="hidden-message">You have been successfully subscribed!</div>
    </div>
  </form>
</div>

<div id="emailError"></div>
