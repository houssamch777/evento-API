
<script setup>
import { ref } from 'vue'
 
const counter = ref(0)
</script>
<template>
    <div>
        <h1>Hello from Vue!</h1>
         <button
    type="button"
    @click="counter++"
    class="p-2 text-white bg-gray-500 rounded"
  >
    Counter is: {{ counter }}</button>
    </div>
</template>
<script>

export default {
    name: "ExampleComponent",
};
</script>

