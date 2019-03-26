var $ = jQuery.noConflict();

$(window).load(function(){
  if($('body').is('.page-template-page-downloads')){
    // Get CSS ready
    $('div.halfbanner').css('padding-bottom','0');
    $('div.halfbanner img.main').css('max-width','100%');


    // Go to the correct section and tab
    var showTab = function() {
      var tabId     = window.location.hash;
      var linuxId   = '#' + $('#desktop a:eq(3)').attr('id');
      var windowsId = '#' + $('#desktop a:eq(0)').attr('id');
      var macosId   = '#' + $('#desktop a:eq(2)').attr('id');
      var androidId = '#' + $('#mobile  a:eq(0)').attr('id');
      var iosId     = '#' + $('#mobile  a:eq(1)').attr('id');
      if (tabId == '#linux')   { $('html, body').animate({scrollTop: $('#desktop').offset().top}, 10); $(linuxId).tab('show'); }
      if (tabId == '#windows') { $('html, body').animate({scrollTop: $('#desktop').offset().top}, 10); $(windowsId).tab('show'); }
      if (tabId == '#macos')   { $('html, body').animate({scrollTop: $('#desktop').offset().top}, 10); $(macosId).tab('show'); }
      if (tabId == '#android') { $('html, body').animate({scrollTop: $('#mobile').offset().top}, 10);  $(androidId).tab('show'); }
      if (tabId == '#ios')     { $('html, body').animate({scrollTop: $('#mobile').offset().top}, 10);  $(iosId).tab('show'); }
    };

    var showButton = function(text, href, image) {
      var button = $('<a class="btn btn-ghost white" href="' + href + '">' + text + '</a>').hide();
      $('div.caption').append(button);
      if (image == 'desktop')
        { $('#dlimg2').show(); }
      else 
        { $('#dlimg1').show(); }
      button.slideDown('fast');
    }

    var useros = platform.os.family.toLowerCase();
    switch (true) {
      case /windows/.test(useros): showButton(download_texts.download_windows, '#windows', 'desktop'); break;
      case /os x/.test(useros):    showButton(download_texts.download_macos,   '#macos',   'desktop'); break;
      case /android/.test(useros): showButton(download_texts.download_android, '#android', 'mobile');  break;
      case /ios/.test(useros):     showButton(download_texts.download_ios,     '#ios',     'mobile');  break;
      case /linux/.test(useros):   showButton(download_texts.download_linux,   '#linux',   'desktop'); break;
      case /ubuntu/.test(useros):  showButton(download_texts.download_linux,   '#linux',   'desktop'); break;
      case /debian/.test(useros):  showButton(download_texts.download_linux,   '#linux',   'desktop'); break;
      case /fedora/.test(useros):  showButton(download_texts.download_linux,   '#linux',   'desktop'); break;
      case /red hat/.test(useros): showButton(download_texts.download_linux,   '#linux',   'desktop'); break;
      case /suse/.test(useros):    showButton(download_texts.download_linux,   '#linux',   'desktop'); break;
      default: break;
    }
    
    if (window.location.hash) {
      showTab();
    }

    // If hash changes, show correct tab
    $(window).on('hashchange', function() {
    	showTab();
    })
    
    $('div.caption > a').click(function() {
      showTab();
    })
  }
})
