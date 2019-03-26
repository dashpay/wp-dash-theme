Vue.component('dash-buyspend', {
  props: ['type','vendors'],
  data: function(){
    return {
      // currency and method show for Buy
      // category show for Spend
      currencies:[''],
      methods:[''],
      categories:[''],
      currencyFilter: {},

      // init the current to whatever is first (or 'all'?)
      currency_c:'',
      method_c:'',
      category_c:'',

      items: [],
      items_all: [],

      // 'capApi':'https://www.coincap.io/front/',
      'buyApi':'https://www.dash.org/api/v1/exchange/'

    }
  },
  mounted: function(){
    var that = this;

    // custom select style
    $('select').selectric().on('selectric-change', function(event, element, selectric) {
      that[$(element).attr('name') ] = $(element).val();
    });

    if (this.vendors.length){
      this.items_all = JSON.parse(this.vendors);
      if (this.type=='buy'){
        that.currencyFilter = that.items_all[0].currencies;
        // setup currency filter and buy method filter
        for (var curr in that.currencyFilter) {
          that.currencies.push(curr.toUpperCase());
          that.currencyFilter[curr].forEach(function(method){
            if ( that.methods.indexOf(method)<0 ){
              that.methods.push(method);
            }
          })
        }
        this.items_all.shift();
        that.filter();

        // get the prices from API, later
        $.ajax({
          url: that.buyApi,
          error: function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
            console.log(textStatus);
            console.log('errorThrown:', errorThrown);
          }
        }).done(function(prices) {
          prices.forEach(function(price){
            that.items_all.forEach(function(exch){
              if ( exch.name==price.exchange ){
                exch['price'] = price.price;
                exch['volume'] = price.volume;
              }
            })
          })
          that.filter();
        });
/*
        $.ajax({
          url: that.capApi,
          error: function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
            console.log(textStatus);
            console.log('errorThrown:', errorThrown);
          }
        }).done(function(prices) {
          console.log(prices);
          // that.filter();
        });
*/

      }
      else {
        this.items_all.forEach(function(el){
          if ( that.type=='spend'){
            // setup product category filter
            if ( that.categories.indexOf(el.vendor_category)<0 ){
              that.categories.push(el.vendor_category)
            }
            that.category_c = that.categories[0]
          }

          if ( that.type=='fulllist' ){
            // setup manual currency filter
              var currencies = el.vendor_currencies.split(",");
              currencies.forEach(function(cur){
                if ( that.currencies.indexOf(cur)<0 ){
                  that.currencies.push(cur)
                }
              })
              that.currency_c = that.currencies[0]
          }
        })
      this.filter();

      }


      that.methods = that.sortArray(that.methods);
      that.currency = that.sortArray(that.currencies);
      that.categories = that.sortArray(that.categories);
    }


  },
  watch : {
    currency_c: function(){
      this.filter();
    },
    method_c: function(){
      this.filter();
    },
    category_c: function(){
      this.filter();
    },
  },
  computed: {
  },
  methods: {
    filter: function(){
      var that = this;
      that.items = [];
      if ( that.currency_c=="" && that.method_c=="" && that.category_c==""){
        that.items = that.items_all;
      }
      else {
        this.items_all.forEach(function(el){

          var methods = [];
          var currencies = [];

          if ( that.type== 'buy' ){
            var methods = el.methods;
            var currencies = el.currency;
          }
          if ( that.type== 'fulllist' ){
            var currencies = el.vendor_currencies.split(",");
          }
          var add = false;

          // currency and method match
          if ( that.currency_c.length && that.method_c.length ){ 
            if ( currencies.indexOf(that.currency_c)>=0 && methods.indexOf(that.method_c)>=0 ){
              add = true;
            }
          }
          else if ( that.currency_c.length && currencies.indexOf(that.currency_c)>=0){ 
            add=true;
          }
          else if ( that.method_c.length && methods.indexOf(that.method_c)>=0){ 
            add=true;
          }

          // category only
          if ( that.category_c.length && el.vendor_category==that.category_c){ 
            add=true;
          }

          if ( add ){
            that.items.push(el);
          }
        })
      }

    },
    sortArray: function(array){
      var s = array.sort(function(a, b){
          if(a < b) { return -1; }
          if(a > b) { return 1; }
          return 0;
      })
      return s;
    }
  }
})
if ( $('dash-buyspend').length ){
  new Vue({
    el: 'dash-buyspend'
  });

}
