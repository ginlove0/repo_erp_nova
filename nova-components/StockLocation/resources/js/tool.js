Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'stock-location',
      path: '/stock-location',
      component: require('./components/Tool'),
    },
  ])
})
