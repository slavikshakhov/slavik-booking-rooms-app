require('./bootstrap')
import moment from 'moment'
import VueRouter from 'vue-router'
import Vuex from 'vuex'
import router from './routes'
import storeDefinition from './store'
import Index from './Index'
import FatalError from './shared/components/FatalError'
import Success from './shared/components/Success'
import ValidationErrors from './shared/components/ValidationErrors'
import StarRating from './shared/components/StarRating'

window.Vue = require('vue')
Vue.use(VueRouter)
Vue.use(Vuex)

Vue.filter('fromNow', (value) => moment(value).fromNow())

Vue.component('star-rating', StarRating)
Vue.component('fatal-error', FatalError)
Vue.component('success', Success)
Vue.component('v-errors', ValidationErrors)

const store = new Vuex.Store(storeDefinition)

const app = new Vue({
  el: '#app',
  router,
  store,
  components: {
    index: Index,
  },
  beforeCreate() {
    this.$store.dispatch('loadStoredState')
  },
})
