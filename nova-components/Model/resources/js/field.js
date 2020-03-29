Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'model',
      path: '/model',
      component: require('./components/Tool'),
    },
  ])
})
