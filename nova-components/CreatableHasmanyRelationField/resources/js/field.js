Nova.booting((Vue, router, store) => {
  Vue.component('index-creatable-hasmany-relation-field', require('./components/IndexField'))
  Vue.component('detail-creatable-hasmany-relation-field', require('./components/DetailField'))
  Vue.component('form-creatable-hasmany-relation-field', require('./components/FormField'))
})
