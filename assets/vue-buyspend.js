Vue.component('dash-buyspend', {
  props: ['type','vendors'],
  data: function(){
    return {
      currencies: [],
      methods:    [],
      categories: [],
      currency_c: '',
      method_c:   '',
      category_c: '',
      sortedBy:   '',
      items:      [],
      items_all:  [],
      tabFilter:  'exchange',
      buyApi:     'https://exchapi.dashevo.org/exchange/'
    }
  },
  mounted: function(){
    var that = this;

    if (typeof jQuery !== 'undefined' && jQuery.fn && jQuery.fn.selectric){
      jQuery('select').selectric().on('selectric-change', function(event, element, selectric) {
        that[jQuery(element).attr('name')] = jQuery(element).val();
      });
    }

    if (this.vendors){
      var raw = this.vendors;
      try {
        if (typeof raw === 'string'){
          raw = raw.replace(/&quot;/g,'"').replace(/&#34;/g,'"');
          this.items_all = JSON.parse(raw);
        } else {
          this.items_all = raw;
        }
      } catch(e){
        console.error('Failed to parse vendors JSON', e);
        this.items_all = [];
      }
    }

    if (!this.items_all.length) {
      this.filter();
      return;
    }

    // BUY PAGE
    if (this.type === 'buy'){
      this.items_all.forEach(function(ex){
        if (Array.isArray(ex.currency)){
          ex.currency.forEach(function(cur){
            if (cur && that.currencies.indexOf(cur) < 0) that.currencies.push(cur);
          });
        }
      });
      that.currencies = that.sortArray(that.currencies);
      that.filter();

      if (typeof jQuery !== 'undefined' && jQuery.ajax){
        jQuery.ajax({ url: that.buyApi }).done(function(prices){
          if (Array.isArray(prices)){
            prices.forEach(function(price){
              that.items_all.forEach(function(exch){
                if (exch.name === price.exchange){
                  exch.price  = price.price;
                  exch.volume = price.volume;
                }
              });
            });
            that.filter();
          }
        });
      }
    }

    // SPEND PAGE (multiple categories per vendor supported)
    else if (this.type === 'spend'){
      this.items_all.forEach(function(el){
        var catStr = (el.vendor_category || '').trim();
        if (!catStr) return;

        catStr.split(',').forEach(function(rawCat){
          var cat = rawCat.trim();
          if (cat && that.categories.indexOf(cat) < 0) {
            that.categories.push(cat);
          }
        });
      });
      that.categories = that.sortArray(that.categories);
      that.category_c = '';
      that.filter();
    }

    else if (this.type === 'fulllist'){
      this.items_all.forEach(function(el){
        if (el.vendor_currencies){
          el.vendor_currencies.split(',').map(function(s){return s.trim();}).forEach(function(cur){
            if (cur && that.currencies.indexOf(cur) < 0) that.currencies.push(cur);
          });
        }
      });
      that.currencies = that.sortArray(that.currencies);
      that.currency_c = '';
      that.filter();
    }

    else {
      that.filter();
    }
  },
  watch : {
    currency_c(){ this.filter(); },
    method_c(){   this.filter(); },
    category_c(){ this.filter(); }
  },
  methods: {
    filter: function(){
      var that = this;

      // SPEND FILTERING (supports multiple categories)
      if (this.type === 'spend'){
        this.items = this.items_all.filter(function(el){
          if (!that.category_c) return true;

          var catStr = (el.vendor_category || '').trim();
          if (!catStr) return false;

          var cats = catStr.split(',').map(function(s){ return s.trim(); });
          return cats.indexOf(that.category_c) >= 0;
        });
        return;
      }

      // BUY / FULLLIST
      this.items = [];
      this.items_all.forEach(function(el){
        var add = false;
        var methods    = Array.isArray(el.methods)  ? el.methods  : [];
        var currencies = Array.isArray(el.currency) ? el.currency : [];

        if (that.type === 'fulllist' && el.vendor_currencies){
          currencies = el.vendor_currencies.split(',').map(function(s){ return s.trim(); });
        }

        if (!that.currency_c && !that.method_c && !that.category_c) add = true;

        if (that.currency_c && currencies.indexOf(that.currency_c) >= 0) add = true;
        if (that.method_c   && methods.indexOf(that.method_c)     >= 0) add = true;

        if (add) that.items.push(el);
      });
    },
    sortArray: function(array){
      return array
        .filter(function(v){ return v !== null && v !== undefined && String(v).trim() !== ''; })
        .sort(function(a, b){
          a = String(a).toLowerCase(); b = String(b).toLowerCase();
          if (a < b) return -1;
          if (a > b) return 1;
          return 0;
        });
    }
  }
});

if (document.querySelector('dash-buyspend')) {
  new Vue({ el: 'dash-buyspend' });
}
