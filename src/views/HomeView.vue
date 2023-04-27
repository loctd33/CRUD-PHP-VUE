<template>
  <section class="vh-100" style="background-color: #9A616D;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
          <div class="card" style="border-radius: 1rem;">
            <div class="row g-0">
              <div class="col-md-6 col-lg-5 d-none d-md-block">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img1.webp"
                  alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
              </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">

                  <form action="" method="POST">

                    <div class="d-flex align-items-center mb-3 pb-1">
                      <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                      <span class="h1 fw-bold mb-0">Logo</span>
                    </div>

                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

                    <div class="form-outline mb-4">
                      <label class="form-label" for="formUsername">Username</label>
                      <input v-model="Admin.username" type="email" id="formUsername" class="form-control form-control-lg" />
                    </div>

                    <div class="form-outline mb-4">
                      <label class="form-label" for="formPass">Password</label>
                      <input v-model="Admin.password" type="password" id="formPass" class="form-control form-control-lg" />
                    </div>

                    <div class="d-flex justify-content-between mb-4">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                        <label class="form-check-label" for="form1Example3"> Remember me </label>
                      </div>
                      <a href="#!">Forgot password?</a>
                    </div>

                    <div class="pt-1 mb-4">
                      <button class="btn btn-dark btn-lg btn-block w-100" type="button" @click.prevent="onLogin()">Login</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
// @ is an alias to /src
// import HelloWorld from '@/components/HelloWorld.vue'
import axios from 'axios';

export default {
  name: 'HomeView',
  data() {
    return {
      Admin: {
        username: 'admin',
        password: 'admin'
      }
    }
  },
  methods: {
    onLogin() {
      var data = new FormData();
      data.append('username',this.Admin.username);
      data.append('password',this.Admin.password);
      axios.post('http://localhost/vue-php/src/api/api.php?action=login',data)
      .then(res => {

        console.log(res)
        if(res.data.error) {
          console.log('Error',res.data);
        }
        else {
          console.log('success',res.data);
          this.$router.push('/dashboard');
        }
      })
      .catch(err => {
        console.log(err)
      })
    }
  }
}
</script>

<style>
</style>
