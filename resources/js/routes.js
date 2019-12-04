import Dashboard from './components/views/Dashboard.vue';
import Category from './components/views/Category.vue';

export default [
    {path: '/', component: Dashboard},
    {path: '/category/:id', component: Category}
]