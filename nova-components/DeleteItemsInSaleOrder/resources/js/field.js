Nova.booting((Vue, router, store) => {
  Vue.component('index-delete-items-in-sale-order', require('./components/IndexField'))
  Vue.component('detail-delete-items-in-sale-order', require('./components/DetailField'))
  Vue.component('form-delete-items-in-sale-order', require('./components/FormField'))
})
