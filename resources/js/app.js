require('./bootstrap')

import { createApp } from 'vue'
import Login from './components/Login'
import Registration from './components/Registration'
import PreRegistr from './components/PreRegistr'
import Password from './components/Password'
import ResPassword from './components/ResPassword'


const app = createApp({})
window.Laravel = {csrfToken: '{{ csrf_token() }}'}


app.component('login', Login)
app.component('registration', Registration)
app.component('password', Password)
app.component('respassword', ResPassword)
app.component('preregistr', PreRegistr)

app.mount('#app')
