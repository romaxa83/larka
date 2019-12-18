import Dashboard from './components/views/Dashboard.vue';
import Category from './components/views/Category.vue';
import LineChart from './components/LineChart.vue';
import PieChart from './components/PieChart.vue';

export default [
    {path: '/', component: Dashboard},
    {path: '/line-chart', component: LineChart},
    {path: '/pie-chart', component: PieChart},
    {path: '/category/:id', component: Category}
]