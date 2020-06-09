Nova.booting((Vue, router, store) => {
  Vue.component('index-display-model-with-link', require('./components/IndexField'))
  Vue.component('detail-display-model-with-link', require('./components/DetailField'))
  Vue.component('form-display-model-with-link', require('./components/FormField'))
})
