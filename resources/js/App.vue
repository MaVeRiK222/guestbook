<template>
    <div class="container">
      <div id="app">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
          <div class="container-fluid">
    <div class="navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <router-link class="navbar-brand" :to="{name: 'Comments'}">Сообщения</router-link>
        </li>
        <li class="nav-item">
          <router-link class="navbar-brand" :to="{name: 'Login'}">Вход</router-link>
        </li>
        <li class="nav-item">
          <router-link class="navbar-brand" :to="{name: 'Register'}">Регистрация</router-link>
        </li>
        <li class="nav-item">
          <button class="btn btn-primary" @click="quit">Выйти</button>
        </li>
      </ul>
    </div>
  </div>
</nav>
        <router-view></router-view>
      </div>
    </div>
  </template>
 
  <script>
  export default {
  methods:{
    quit(){
      this.$store.state.user = null;
    }
  }
  }
  </script>