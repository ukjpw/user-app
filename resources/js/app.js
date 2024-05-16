import { createApp } from 'vue'

const app = createApp()

import UserList from './vue_components/UserList.vue';
import UserEdit from './vue_components/UserEdit.vue';
import UserCreate from './vue_components/UserCreate.vue';

app.component('UserList', UserList);
app.component('UserEdit', UserEdit);
app.component('UserCreate', UserCreate);
app.mount('#app')