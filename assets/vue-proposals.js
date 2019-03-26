Vue.component('dash-proposals', {
  props: [],
  data: function(){
    return {
      proposals:[],
      max: 5
    }
  },
  mounted: function(){
    this.loadProposals();
  },
  watch : {
  },
  computed: {
  },
  methods: {
    loadProposals: function(e){
      var that = this;
        $.ajax({
          dataType: "json",
          url: 'https://www.dashcentral.org/api/v1/budget',
          success: function(data){
            if ( data.proposals.length< that.max ){
              that.proposals = data.proposals;
            }
            else {
              for (var i = 0; i<that.max; i++) {
                that.proposals.push(data.proposals[i])
              }
            }
          }
        });
    }
  }
})
if ( $('dash-proposals').length ){
  new Vue({
    el: 'dash-proposals'
  });

}
