<template>
  <div class="container">
    <form @submit.prevent="register">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Логин</label>
    <input v-model="login" type="text" class="form-control" required>
     <div v-if="error" class="is-invalid">
                {{this.error}}
            </div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Пароль</label>
    <input v-model="password" type="password" class="form-control" required>
  </div>
  <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
  <div class="container" v-if="succes">Регистрация прошла успешно</div>
</form>
{{ $store.state.message }}
  </div>
  
</template>

<script>
export default {
  name: 'Register',
  data(){
    return {
    login: null,
    password: null,
    error: null,
    succes: null,
    }
  },
  methods:{
    register(){
      axios.post("/api/users", {login: this.login, password: this.password})
      .then((response) => {
        this.error = null
        this.succes = true
      })
      .catch((error) => {
        this.error = error.response.data.message
      })
    }
  }
}
</script>
<style>
.is-invalid{
  color:red;
}
</style>