import VueRouter from 'vue-router'

import RoomList from './components/Room/RoomList'
import RoomDetail from './components/Room/RoomDetail'
import ReviewDetail from './components/Review/ReviewDetail'
import Basket from './components/Basket/Basket'

const routes = [
  {
    path: '/',
    component: RoomList,
    name: 'home',
  },
  {
    path: '/rooms/:id',
    component: RoomDetail,
    name: 'room',
  },
  {
    path: '/review/:id',
    component: ReviewDetail,
    name: 'review',
  },
  {
    path: '/basket',
    component: Basket,
    name: 'basket',
  },
]

const router = new VueRouter({
  routes,
  mode: 'history',
})

export default router
