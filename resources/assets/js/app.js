require('./bootstrap');

window.Vue = require('vue');
window.axios = require('axios');

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

// Vue.component('example-component', require('./components/ExampleComponent.vue'));
const app = new Vue({
    el: '#app',
    data: {
        keywords: null,
        results: [],
        files: []
    },
    watch: {
        keywords(after, before) {
            this.fetch();
        }
    },
    created(){
        // axios.get('/default').then(result => {
        //     this.results = result.data;
        // }).catch(error => {
        //         console.log(error);
        // });
    },
    methods: {
        fetch() {
            axios.get('/search/' + this.keywords).then(result => {
                this.results = result.data;
            }).catch(error => {
                console.log(error);
            });
        },
        loadFiles($id){
                console.log($id);
            axios.get('/getfiles/' + $id).then(result => {
                this.files = result.data;
                console.log($id);
            }).catch(error => {
                    console.log(error);
            });
        }
    },

});
