Nova.booting((Vue, router, store) => {
  Vue.component('index-model-quick-view-field', require('./components/IndexField'))
  Vue.component('detail-model-quick-view-field', require('./components/DetailField'))
  Vue.component('form-model-quick-view-field', require('./components/FormField'))
})
