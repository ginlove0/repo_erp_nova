
import Vuex from 'vuex';

Nova.booting((Vue, router, store) => {
  Vue.use(Vuex);

  Nova.packagesStore = new Vuex.Store({
    state: {
      count: 0
    },
    mutations: {
      increment (state) {
        state.count++
      }
    }
  });


  Vue.component('index-create-packages-shipping', require('./components/IndexField'))
  Vue.component('detail-create-packages-shipping', require('./components/DetailField'))
  Vue.component('form-create-packages-shipping', require('./components/FormField'))
})

