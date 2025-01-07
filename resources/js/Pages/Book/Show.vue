<template>
    <Layout :title="book.title">
    <div class="bg-white rounded-md p-3 mt-3">
        <form >
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

        <button @click="deleteBook(book.id)" class="mt-2 bg-red-600 text-white border rounded md p-2" >Delete Record</button>
    </div>
   </Layout>
</template>

<script setup>
import Layout from './Layout.vue'
import { router } from '@inertiajs/vue3'


defineProps({ book: Object})

function deleteBook(id){

if(confirm('Are you sure you want to delete this record?')){
    router.delete(`/book/${id}`)
}
}
</script>

<style lang="scss" scoped>

</style>
