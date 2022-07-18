<div class="sendgrid-subscription-widget"  >
		<h4 class="widget-header"> Subscribe to our <br> Newsletter </h4>
			<form name="dash-nl" id="dash-nl" class="sg-widget">
				<input class="sg_email" type="text" name="contacts" id="email" placeholder="your@email.com *" > 
				<fieldset class="input-subscription-checkboxes" >
					<legend class="subscription-type" id="label-subscription_type"  >
						<span >Subscription Type</span>
						<span class="form-required" >*</span>
					</legend>
					<div class="checkbox">
						<input type="checkbox" id="MNO-newsletter" name="list_ids" value="ba8f318b-556e-4930-896a-1c64ec57b58f" />
						<label for="MNO-newsletter">MNO newsletter</label>
					</div>
					<div class="checkbox">
						<input type="checkbox" id="Community-newsletter" name="list_ids" value="47b7176a-980f-42b9-928e-afb05720b3cd" />
						<label for="Community-newsletter">Community Members newsletter</label>
					</div>
                	<div class="checkbox">
                    	<input type="checkbox" id="Developer newsletter" name="list_ids" value="29916fc3-c035-4039-bd88-c6f3d02a5667" /> 
                    	<label for="Developer-newsletter">Developer newsletter</label>
                	</div>
                	<div class="checkbox">
                    	<input type="checkbox" id="Investor-newsletter" name="list_ids" value="3d0db80e-11db-410a-8dc2-589a5f0af522" /> 
                    	<label for="Investor-newsletter">Investor Newsletter</label>
                	</div>
				</fieldset>
				<button type="submit" class="sg-submit-btn">Submit </button>
			</form>
		</div>
<script>
	const myForm = document.getElementById('dash-nl');
	const API_KEY = 'your_sendgrid_api_key' //use hidden .env variable
	
	myForm.addEventListener('submit', function(e) {
	e.preventDefault();	
    const formData = new FormData(this)
    const inputValues = Object.fromEntries(formData.entries());
    const list_ids = inputValues.list_ids = formData.getAll("list_ids")
    const email = inputValues.contacts = formData.get("contacts")

    const data = JSON.stringify({
        "list_ids": list_ids,
        "contacts": [
          {
            "email": email
          }
        ]
      });

    const request = {
		method: 'PUT',
       	headers: { 
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${API_KEY}`,
   		},
		body: data
		}
    
  fetch("https://api.sendgrid.com/v3/marketing/contacts", request)
      .then(response => response.text())
     	.then(result => console.log(result,"result"))
     	.catch(error => console.log(error, "error"))
	});

</script>
<style>
	
	.sendgrid-subscription-widget input { padding: .5em .5em .55em; font-size: .8em; font-family: sans-serif } 
	.sendgrid-subscription-widget .sg_email { 
		border-radius: 5px; 
		height: 40px;
		box-sizing: border-box;
		padding: 0 15px;
    	min-height: 27px;

		display: inline-block;
    	width: 90%;
    	max-width: 500px;
    	height: 40px;
    	padding: 9px 10px;
    	font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    	font-size: 16px;
    	font-weight: normal;
    	line-height: 22px;
    	color: #33475b;
    	border: 1px solid #cbd6e2;
    	border-radius: 3px;
		} 
	.sendgrid-subscription-widget .sg-submit-btn { 
		font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
	    margin: 0;
	    cursor: pointer;
	    display: inline-block;
	    font-weight: 700;
	    line-height: 12px;
	    position: relative;
	    text-align: center;
	    transition: all .15s linear;
	    background-color: #008de4;
	    border-color: #008de4;
	    color: #fff;
	    border-radius: 3px;
	    border-style: solid;
	    border-width: 1px;
	    font-size: 14px;

	    padding: 12px 24px;
		margin-bottom: 20px;
		margin-top: 10px; 
		} 
	.sendgrid-subscription-widget .sg-submit-btn:active { color: #8e8b8b; box-shadow: 0 0 5px -1px rgba(0, 0, 0, .6) } 
	.sendgrid-subscription-widget .response { display: none; font-family: sans-serif; font-size: .8em } 
	.sendgrid-subscription-widget .success { color: inherit } 
		
	.sendgrid-subscription-widget .error, .sendgrid-subscription-widget .sg-consent-text a { color: #3097d1 } 
	.sendgrid-subscription-widget .sg-consent-text { font-size: .9em } 
	.sendgrid-subscription-widget .sg-consent-text label { font-weight: 400 } 


	.sendgrid-subscription-widget .required { outline: 1px solid #f00; } 
	.sendgrid-subscription-widget .sg_custom { margin-left: 5px; } 
	.sendgrid-subscription-widget .checkbox_label { padding-left: 10px; } 
	.sendgrid-subscription-widget .sg-subscription-text
	
	.row newsletter { width: 100% }
	.form-newsletter { display: block; margin-top: 0em; margin-block-end: 1em; }
	.subscription-type { padding-top: 20px;}
	.input-subscription-checkboxes { padding-left: 5px; padding-bottom: 20px; }

</style>