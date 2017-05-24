Vue.component('contents', {
	template:'#contents_template',
	props: ['list'],
	created(){
		this.list=JSON.parse(this.list);
	}
});

var vm = new Vue({
  el: '#app',
  data: {
  }
});