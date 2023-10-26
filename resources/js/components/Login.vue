<template>
  <div class="container">
    <form @submit.prevent="auth">
  <div class="mb-3">
    <label  class="form-label">Логин</label>
    <input v-model="login" type="text" class="form-control" required>
  </div>
  <div class="mb-3">
    <label  class="form-label">Пароль</label>
    <input v-model="password" type="password" class="form-control" required>
  </div>
  <button type="submit" class="btn btn-primary" >Войти</button>
  <div v-if="error" class="is-invalid"> {{this.error}} </div>
  <div class="container" v-if="succes">Вы успешно вошли</div>
</form>
  </div>
  
</template>

<script>
export default{
  data(){
    return{
      login: null,
      password: null,
      error: null,
      succes: null,
    }
  },
  methods: {
    auth(){
      axios.post('/api/getuser', {
        login: this.login, password: this.password
      })
      .then( (response) => {
        this.$store.state.user = response.data.data;
        this.error = null;
        this.succes = true;
      })
      .catch((error) =>{

        this.error = "Данные введены не верно"
      })
    }
  }
}
</script>