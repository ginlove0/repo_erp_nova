Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'add_item_without_sn_us',
      path: '/add_item_without_sn_us',
      component: require('./components/Tool'),
    },
  ])
})
