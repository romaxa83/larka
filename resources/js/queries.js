import Vue from 'vue';

Vue.prototype.$apiQueries = {
    dashboard: '{categories{id, title, slug}}',
    singleCategory: `query fetchSingleCategory($categoryId: Int){
        categories(categoryId: $categoryId) {
            id, 
            title
            books {
                id,title,description
            } 
        }
    }`
};