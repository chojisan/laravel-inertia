<template>
  <div>
    <navbar-component></navbar-component>
    <!-- Page Content -->
    <slot></slot>

    <!-- Modal Portal -->
    <portal-target name="modal" multiple></portal-target>
    <footer-component></footer-component>
  </div>
</template>

<script>
import NavbarComponent from "@/Shared/Navbar.vue";
import FooterComponent from "@/Shared/Footer.vue";

export default {
  components: {
    NavbarComponent,
    FooterComponent
  }
};
</script>

<style></style>
