Vue.component('dash-team', {
  props: ['team'],
  data: function(){
    return {
      people: [],
      showPeople: [],
      tags:[''],
      tag_c:''
    }
  },
  mounted: function(){
    this.loadPeople();
  },
  watch : {
    tag_c: function(){
      var that = this;

      this.people.forEach(function(item){
        if ( that.tag_c.length ) {
          if (item.tag.indexOf(that.tag_c)>=0){
            item.show = true;
          }
          else {
            item.show = false;
          }
        }
        else {
            item.show = true;
        }
      })
      

    }
  },
  computed: {
  },
  methods: {
    loadPeople: function(e){
      var that = this;
      var data = JSON.parse(this.team);

      data.forEach(function(item){
        item.tag = item.tag.toUpperCase().split(',');
        item.tag.forEach(function(tag){
          if (that.tags.indexOf( tag.trim() )<0){
            that.tags.push( tag.trim() );
          }
        })
        item.show = true;
      })
      this.people = data;

      that.$nextTick(function(){
        // custom select style
        $('select').selectric().on('selectric-change', function(event, element, selectric) {
          that[$(element).attr('name') ] = $(element).val();
        });
      })
    

    }
  }
})
if ( $('dash-team').length ){
  new Vue({
    el: 'dash-team'
  });

}
