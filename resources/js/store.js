import {createStore} from 'vuex';

const store = createStore({
    state(){
        return{
            user: {
                id: null,
                login: null,
                is_admin: null
            }
        }
    }
})
export default store;