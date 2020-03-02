Nova.booting((Vue, router, store) => {
  Vue.component('index-relation-dependance-field', require('./components/IndexField'))
  Vue.component('detail-relation-dependance-field', require('./components/DetailField'))
  Vue.component('form-relation-dependance-field', require('./components/FormField'))
})
