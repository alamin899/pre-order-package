<template>
  <div class="container d-flex justify-content-center align-items-center vh-100">
    Helllllllllllllllllllllllllllllllllllllllllooooo
<!--    <div class="card shadow-sm p-4" style="max-width: 400px; width: 100%;">-->
<!--      <h2 class="text-center mb-4">Login</h2>-->
<!--      <form @submit.prevent="handleLogin">-->
<!--        <div class="mb-3">-->
<!--          <label for="email" class="form-label">Email address</label>-->
<!--          <input-->
<!--              type="email"-->
<!--              id="email"-->
<!--              v-model="form.email"-->
<!--              class="form-control"-->
<!--              placeholder="Enter your email"-->
<!--              required-->
<!--          />-->
<!--        </div>-->
<!--        <div class="mb-3">-->
<!--          <label for="password" class="form-label">Password</label>-->
<!--          <input-->
<!--              type="password"-->
<!--              id="password"-->
<!--              v-model="form.password"-->
<!--              class="form-control"-->
<!--              placeholder="Enter your password"-->
<!--              required-->
<!--          />-->
<!--        </div>-->
<!--        <button-->
<!--            type="submit"-->
<!--            class="btn btn-primary w-100"-->
<!--            :disabled="isLoading"-->
<!--        >-->
<!--          <span v-if="isLoading">Logging in...</span>-->
<!--          <span v-else>Login</span>-->
<!--        </button>-->
<!--      </form>-->
<!--      <p v-if="errorMessage" class="text-danger mt-3 text-center">-->
<!--        {{ errorMessage }}-->
<!--      </p>-->
<!--    </div>-->
  </div>
</template>

<script>
export default {
  // data() {
  //   return {
  //     form: {
  //       email: "",
  //       password: "",
  //     },
  //     isLoading: false,
  //     errorMessage: "",
  //   };
  // },
  // methods: {
  //   async handleLogin() {
  //     this.isLoading = true;
  //     this.errorMessage = "";
  //
  //     try {
  //       const response = await fetch("/api/login", {
  //         method: "POST",
  //         headers: {
  //           "Content-Type": "application/json",
  //         },
  //         body: JSON.stringify(this.form),
  //       });
  //
  //       if (!response.ok) {
  //         const errorData = await response.json();
  //         this.errorMessage = errorData.message || "Login failed";
  //         return;
  //       }
  //
  //       const data = await response.json();
  //       alert("Login successful!");
  //       // Handle successful login, e.g., redirect or save token
  //     } catch (error) {
  //       this.errorMessage = "An error occurred during login.";
  //     } finally {
  //       this.isLoading = false;
  //     }
  //   },
  // },
};
</script>

<style scoped>
.card {
  border-radius: 8px;
}
</style>
