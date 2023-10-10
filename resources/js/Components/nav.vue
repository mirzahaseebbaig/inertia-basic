<script setup>
import {Link} from '@inertiajs/vue3';

const props = defineProps({
  activeClass: {
    type: String,
    default: 'customer_list'
  }
});
</script>

<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Navbar</a>
      <button aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-bs-target="#navbarNav"
              data-bs-toggle="collapse" type="button">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div id="navbarNav" class="collapse navbar-collapse">
        <ul class="navbar-nav">
          <li class="nav-item">
            <Link class="nav-link" href="/customers">Customer List</Link>
          </li>
          <li class="nav-item">
            <Link class="nav-link" href="/customer/create">Customer Create</Link>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<style scoped>

</style>