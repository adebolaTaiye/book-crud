<template>
    <Layout :title="book.title">
        <form class="bg-white rounded-md p-3 mt-3">
            <div>
                <label class="text-grey-500">Title</label>
                <input type="text"  v-model="book.title" class="rounded w-full p-2 border border-2 border-grey-300 " readonly/>
            </div>

            <div class="mt-2">
                <label class="text-grey-500">Author</label>
                <input type="text"  v-model="book.author" class="rounded w-full p-2 border border-2 border-grey-300 " readonly>
            </div>

            <div>
                <label class="text-grey-500">Description</label>
                <textarea placeholder="description" v-model="book.description" class="rounded w-full p-2 border border-2 border-grey-300 "readonly></textarea>
            </div>

            <div>
                <label class="text-grey-500">Published year</label>
                <input type="number"  v-model.number="book.published_year"  class="rounded w-full p-2 border border-2 border-grey-300 "readonly/>

            </div>
            <div>
                <label class="text-grey-500">Status</label>
                <input type="text" class="rounded w-full p-2 border border-2 border-grey-300 " v-model="book.status"/>
            </div>
        </form>
   </Layout>
</template>

<script setup>
import Layout from './Layout.vue'

defineProps({ book: Object})
</script>

<style lang="scss" scoped>

</style>
