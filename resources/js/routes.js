import Dashboard from './components/views/Dashboard.vue';
import Category from './components/views/Category.vue';
import LineChart from './components/LineChart.vue';
import PieChart from './components/PieChart.vue';
import Chat from './components/Chat.vue';

export default [
    {path: '/', component: Dashboard},
    {path: '/line-chart', component: LineChart},
    {path: '/pie-chart', component: PieChart},
    {path: '/chat', component: Chat},
    {path: '/category/:id', component: Category}
]