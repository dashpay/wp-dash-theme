<form name="dash-nlform" class="form-newsletter" method="post" action="https://secure.campaigner.com/CSB/Public/ProcessHostedForm.aspx" id="dash-nlform" enctype="multipart/form-data" target="_blank">
    <script type="text/javascript">
    //<![cdata[
    var theForm = document.forms['dash-nlform'];
    if (!theForm) {
        theForm = document.dash-nlform;
    }
    function __doPostBack(eventTarget, eventArgument) {
        if (!theForm.onsubmit || (theForm.onsubmit() != false)) {
            theForm.__EVENTTARGET.value = eventTarget;
            theForm.__EVENTARGUMENT.value = eventArgument;
            theForm.submit();
        }
    }
    //]]>
    </script>

    <input type="hidden" name="FormInfo" id="FormInfo" value="7015c67c-5344-4f33-9d5b-1a0ede24d988">
    <input type="hidden" name="AccId" id="AccId" value="fxzm">

    <div class="position-relative">
        <input name="8650261" type="text" maxlength="4000" id="8650261" class="form-control email" contactattributeid="8650261" placeholder="you@email.com">

        <button type="submit" class="btn">
            <i class="icon-inline">
                <svg width="34px" height="34px" viewBox="0 0 34 34" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g transform="translate(-1271.000000, -614.000000)">
                        <g>
                            <g transform="translate(1271.000000, 614.000000)">
                                <rect fill="#008DE4" x="0" y="0" width="34" height="34" rx="17"></rect>
                                <polygon fill="#FFFFFF" points="9 14.6734694 9 23 26 23 26 14.6734694 17.4997431 18.6306825"></polygon>
                                <polygon fill="#FFFFFF" points="9 11 9 13.2857716 17.4997431 17.3673469 26 13.2857716 26 11"></polygon>
                            </g>
                        </g>
                    </g>
                </g>
            </svg>
            </i>
        </button>
    </div>

    <div class="row">
        <div class="col">
            <span class="form-check">
                <input id="15448933" type="checkbox" class="form-check-input" name="15448933" checked>
                <label for="15448933"><?php echo get_field('newsletter_updates','option');?></label>
            </span>
        </div>
        <div class="col">
            <span class="form-check">
                <input id="15449020" type="checkbox" class="form-check-input" name="15449020">
                <label for="15449020"><?php echo get_field('newsletter_monthly','option');?></label>
            </span>
        </div>
        <div class="col">
            <span class="form-check">
                <input id="15449021" type="checkbox" class="form-check-input" name="15449021">
                <label for="15449021"><?php echo get_field('newsletter_weekly','option');?></label>
            </span>
        </div>
    </div>
</form>
