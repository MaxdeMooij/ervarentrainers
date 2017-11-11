import Vue from 'vue';
import InstantSearch from 'vue-instantsearch';
import App from './components/App.vue';

Vue.use(InstantSearch);

let app = new Vue({
    el: '#app',
    data() {
        return {
            rootElem: null
        }
    },
    beforeMount() {
        console.log(this.$el);
        this.rootElem = this.$el;
    },
    render: function(createElement) {
        return createElement(App, {
            props: {
                appId: this.rootElem.getAttribute('app-id'),
                apiKey: this.rootElem.getAttribute('api-key'),
                indexSuffix: this.rootElem.getAttribute('index-suffix'),
            }
        })
    }
});