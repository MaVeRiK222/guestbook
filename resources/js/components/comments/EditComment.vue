<template>
  <div class="container">
    <h3>Текст сообщения</h3>
    <div class="form-group">
        <input type="text" v-model="text" class="form-control">
        <button @click="saveText" class="btn btn-primary">Сохранить</button>
    </div>
    <h3 v-if="succes">Сообщение отредактировано</h3>
  </div>
</template>

<script>
export default {
    props: [
        'commentId'
    ],
    data(){
        return {
            text:null,
            succes: null,
        }

    },
    methods:{
        saveText(){
            axios.post('/api/comments/'+this.commentId, {
                _method: 'PUT',
                text: this.text
            })
            .then(response => {
                this.comment = response.data.data
                this.succes = true
            })
            .catch(error =>{
                console.log(error)
                this.errored = true
            })
            .finally( () => {
                this.loading = false
            })
        }
    },
    mounted(){
        axios.get('/api/comments/'+this.commentId)
    .then(response => {
      //console.log(response)
      this.text = response.data.data.text
    })
    .catch(error =>{
      console.log(error)
      this.errored = true
    })
    .finally( () => {
      this.loading = false
    })
    }

}
</script>
