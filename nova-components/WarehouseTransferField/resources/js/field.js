Nova.booting((Vue, router, store) => {
  Vue.component('index-warehouse-transfer-field', require('./components/IndexField'))
  Vue.component('detail-warehouse-transfer-field', require('./components/DetailField'))
  Vue.component('form-warehouse-transfer-field', require('./components/FormField'))
})
