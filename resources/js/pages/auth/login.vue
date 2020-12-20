<template>
  <div class="authentication">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-sm-12">
          <form class="card auth_form" @submit.prevent="login" @keydown="form.onKeydown($event)">
            <div class="header">
              <img class="logo" src="https://www.kmgglobal.com/static/media/logo.fa2b86a2.png" alt="KMG Global">
              <h5>Log in</h5>
            </div>
            <div class="body">
              <div class="input-group mb-3">
                <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" type="text" class="form-control" placeholder="Email">
                <div class="input-group-append">
                  <span class="input-group-text"><i class="zmdi zmdi-account-circle"></i></span>
                </div>
                <has-error :form="form" field="email" />
              </div>
              <div class="input-group mb-3">
                <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" type="password" class="form-control"  placeholder="Password">
                <div class="input-group-append">
                  <span class="input-group-text"><i class="zmdi zmdi-lock"></i></span>
                </div>
                <has-error :form="form" field="password" />
              </div>
              <div class="checkbox">
                <input id="remember_me" type="checkbox">
                <label for="remember_me">Remember Me</label>
              </div>
              <v-button :loading="form.busy" :type="primary" :native-type="submit">SIGN IN</v-button>
            </div>
          </form>
          <div class="copyright text-center">
            &copy;
            {{ new Date().getFullYear() }}
            <span>Designed by <a href="https://aiso.uz/" target="_blank">Aiso</a></span>
          </div>
        </div>
        <div class="col-lg-8 col-sm-12">
          <div class="card">
            <img src="/assets/images/signup.svg" alt="Sign In"/>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Form from 'vform'
import Cookies from 'js-cookie'
import VButton from '../../components/Button'

export default {
  components: { VButton },
  layout: 'basic',

  middleware: 'guest',

  metaInfo () {
    return { title: this.$t('login') }
  },

  data: () => ({
    form: new Form({
      email: '',
      password: ''
    }),
    remember: false
  }),

  methods: {
    async login () {
      // Submit the form.
      const { data } = await this.form.post('/api/login')

      // Save the token.
      this.$store.dispatch('auth/saveToken', {
        token: data.token,
        remember: this.remember
      })

      // Fetch the user.
      await this.$store.dispatch('auth/fetchUser')

      // Redirect home.
      this.redirect()
    },

    redirect () {
      const intendedUrl = Cookies.get('intended_url')

      if (intendedUrl) {
        Cookies.remove('intended_url')
        this.$router.push({ path: intendedUrl })
      } else {
        this.$router.push({ name: 'home' })
      }
    }
  }
}
</script>
