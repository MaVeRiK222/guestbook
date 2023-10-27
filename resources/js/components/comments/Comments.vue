<template>
    <div class="container">
        <h1>Главная</h1>
        <div class="card" v-for="comment in paginatedData()" v-bind:key="comment.id">
            <!-- Пойти в API и добавить имя пользователя -->
            <h5 class="card-header" v-if="comment.user">
                Сообщение от {{ comment.user.login }}
            </h5>
            <h5 class="card-header" v-else>Сообщение от анонима</h5>
            <div class="card-body">
                <p class="card-text">{{ comment.text }}</p>
                <div class="container" v-if="($store.state.user && $store.state.user.is_admin) || (comment.user_id !== null && $store.state.user && comment.user_id === $store.state.user.id && getDiff(comment.created_at))">
                    <router-link
                        class="btn btn-primary btn-sm"
                        :to="{
                            name: 'EditComment',
                            params: { commentId: comment.id },
                        }"
                        role="button"
                        >Отредактировать</router-link
                    >
                    <button
                        class="btn btn-primary btn-sm"
                        :to="{
                            name: 'EditComment',
                            params: { commentId: comment.id },
                        }"
                        @click="deleteComment(comment.id)"
                    >
                        Удалить
                    </button>
                </div>
            </div>
        </div>
        <div class="alert alert-danger" role="alert" v-if="errored">
            Ошибка загрузки данных!
        </div>
        <div class="d-flex justify-content-center" v-if="loading">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div class="container">
            <button class="btn btn-primary" @click="prevPage" v-if="pageNumber !== 0 && loading === false">Назад</button>
            <button class="btn btn-primary" @click="nextPage" v-if="pageNumber < pageCount() - 1 && loading === false">Вперед</button>
        </div>
        <div class="container fixed-bottom">
            <div class="mb-3">
                <label v-if="$store.state.user" class="form-label">Имя: {{ $store.state.user.login }}</label>
                <label v-else class="form-label">Анонимно:</label>
            </div>
            <form @submit.prevent="addComment">
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label"
                        >Введите сообщение</label
                    >
                    <textarea
                        class="form-control"
                        id="exampleFormControlTextarea1"
                        rows="3"
                        style="resize: none"
                        required
                        v-model="text"
                    ></textarea>
                </div>
                <div class="container">
                    <button class="btn btn-primary" type="submit">
                        Отправить
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: "Main",

    props:{
      size: {
        type: Number,
        default: 3
      }
    },

    data() {
        return {
            comments: [],
            errored: false,
            loading: true,
            text: null,
            pageNumber: 0,
        };
    },
    mounted() {
        this.getAllComments();
    },
    methods: {
        getDiff(time){
          let currentTime = new Date()
          let new_time = new Date(time)
          let diff = (currentTime - new_time) / 1000 / 60 / 60
          console.log(diff)
          return diff >= 2 ? false:  true
        },
        paginatedData(){
          const start = this.pageNumber * this.size,
          end = start + this.size;
          return this.comments.slice(start, end);
        }, 
        pageCount(){
          let dataLength = this.comments.length;
          let size = this.size
          return Math.ceil(dataLength / size)
        },
        nextPage(){
          this.pageNumber++;
        },
        prevPage(){
          this.pageNumber--;
        },
        getAllComments() {
            axios
                .get("/api/comments")
                .then((response) => {
                    //console.log(response);
                    this.comments = response.data.data;
                })
                .catch((error) => {
                    console.log(error);
                    this.errored = true;
                })
                .finally(() => {
                    this.loading = false;
                });
        },

        deleteComment(id) {
            if (confirm("Вы действительно хотите удалить сообщение?")) {
                axios
                    .post("/api/comments/" + id, {
                        _method: "DELETE",
                    })
                    .then(() => {
                        this.getAllComments();
                    })
                    .catch((error) => {
                        console.log(error);
                        this.errored = true;
                    })
                    .finally(() => {
                        this.loading = false;
                    });
            }
        },

        addComment() {
            axios
                .post("/api/comments", {
                    text: this.text,
                    user_id: this.$store.state.user ? this.$store.state.user.id : null
                })
                .then((response) => {
                    this.comments = [];
                    this.getAllComments();
                })
                .catch((error) => {
                    console.log(error);
                    this.errored = true;
                })
                .finally(() => {
                    this.loading = false;
                });
        },
    },
};
</script>
