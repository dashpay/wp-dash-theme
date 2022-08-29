<div class="sendgrid-subscription-widget">
	<h4 class="widget-header"> Subscribe to our <br> Newsletter </h4>
	<form name="dash-nl" id="dash-nl" class="sg-widget">
		<input class="sg_email" type="text" name="contacts" id="email" placeholder="your@email.com *" method="get" action="https://o5sxxq7g38.execute-api.us-east-2.amazonaws.com/serverless_lambda_stage/hello">
		<fieldset class="input-subscription-checkboxes">
			<legend class="subscription-type" id="label-subscription_type">
				<span>Subscription Type</span>
				<span class="form-required">*</span>
				<div id="warningDiv"></div>
			</legend>
			<div class="checkbox">
				<input type="checkbox" id="MNO-newsletter" name="list_mno" value="dd99ff3d-5d3e-4824-af92-bdedb1ee9f05" />
				<label for="MNO-newsletter">MNO newsletter</label>
			</div>
			<div class="checkbox">
				<input type="checkbox" id="Community-newsletter" name="list_community" value="398bdea0-cf30-48af-8d40-d9b42ec623a3" />
				<label for="Community-newsletter">Community Members newsletter</label>
			</div>
			<div class="checkbox">
				<input type="checkbox" id="Developer newsletter" name="list_dev" value="828e94c9-bd4a-4550-b67d-91c4f5d0a348" />
				<label for="Developer-newsletter">Developer newsletter</label>
			</div>
			<div class="checkbox">
				<input type="checkbox" id="Investor-newsletter" name="list_investor" value="0a9faa61-98db-4726-8362-ef2f0f9de135" />
				<label for="Investor-newsletter">Investor Newsletter</label>
			</div>
		</fieldset>
		<div id="successDiv"> Success! Thank you for signing up for our newsletter.</div>
		<button type="submit" class="sg-submit-btn">Submit </button>
	</form>
</div>
