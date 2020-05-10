Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'add-item-without-sn',
      path: '/add-item-without-sn',
      component: require('./components/Tool'),
    },
  ])
})
