<template>
  <div>
    <div class="row">
      <div class="col-sm-4"></div>
      <div class="col-sm-4">
          <h4 class="text-center">LOGIN</h4>
          <div class="input-group mb-3">
            <span class="input-group-text w-25" id="inputGroup-sizing-default">Email:  </span>
            <input type="text" v-model="email" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
          </div>

          <div class="input-group mb-3">
            <span class="input-group-text w-25" id="inputGroup-sizing-default">Mật khẩu</span>
            <input v-on:keyup.enter="login" type="text" v-model="pwd" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
          </div>
          <button type="button" class="btn btn-danger w-100" @click="login">Đăng nhập</button>
      </div>
      <div class="col-sm-4"></div>
    </div>
  </div>
</template>
<script>
import { mapGetters,mapActions, mapMutations} from 'vuex';
export default {
    data () {
        return {
            email: '',
            pwd: '',
            role: '',
            name: '',
            token: '',
        }
    },
    methods:{
        async login(){
            try {
                await axios.get('sanctum/csrf-cookie');
                await axios.post('/api/login_system',{
                    email: this.email,
                    password: this.pwd,
                }).then((result) => {
                    if(result.data.status_code == 200){
                        this.$store.commit('setName', result.data.name);
                        this.$store.commit('setRole', result.data.role);
                        this.$store.commit('setToken', result.data.access_token);

                        localStorage.setItem("_token", window.btoa(result.data.role+result.data.access_token));
                        localStorage.setItem("_name", window.btoa(result.data.name));

                        this.$router.push({path : "/home"});
                    }else{
                        console.log("Error: ");
                    }
                }).catch((err) => {
                    console.log("Error: " + err);
                });
            } catch (error) {
                console.log("Error: " + err);
            }
         },
     },
     created(){
         localStorage.clear();
     }
}
</script>
