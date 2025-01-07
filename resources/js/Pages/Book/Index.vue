<template>
    <Layout title="Index Page">
    <template #button>
    <Link href="/create" class="text-white bg-indigo-400 hover:bg-indigo-700 p-2 rounded">Add Book</Link>
    </template>
    <div class="mt-9">
    <div class="mb-3 flex justify-between">
    <div>
        <label class="mx-1">filter by status</label>
    <select name="filter" v-model="bookStatus" @change="statusFilter" class="w-48 rounded p-2 bg-white border hover:border-2 border-indigo-600 text-grey-600">
                <option value="available">available</option>
                <option value="borrowed">borrowed</option>
                <option value="reserved">reserved</option>
    </select>
    </div>
    <input type="text" v-model.number="yearFilter" placeholder="search only year" class=" w-48 py-2 border border-2 rounded hover:border-indigo-600"/>
    </div>
        <table class=" bg-white min-w-full">
        <thead class="border border-b" >
          <tr>
            <th scope="col" class=" font-medium text-gray-900 px-6 py-4 text-left">
                #
            </th>
            <th scope="col" class=" font-medium text-gray-900 px-6 py-4 text-left">
                Title
            </th>
            <th scope="col" class=" font-medium text-gray-900 px-6 py-4 text-left">
                Author
            </th>
            <th scope="col" class=" font-medium text-gray-900 px-6 py-4 text-left ">
                Description
            </th>
            <th scope="col" class=" font-medium text-gray-900 px-6 py-4 text-left">
               Published_year
            </th>
            <th scope="col" class=" font-medium text-gray-900 px-6 py-4 text-left">
               Status
            </th>
            <th scope="col" class=" font-medium text-gray-900 px-6 py-4 text-left">
               Actions
            </th>
          </tr>
        </thead>
          <tbody v-for="(resu, index) in result.data " :key=index>
          <tr class="border-b">
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{index+1}}</td>
            <td class=" text-gray-900  px-6 py-4 whitespace-nowrap">
                {{resu.title}}
            </td>
            <td class=" text-gray-900  px-6 py-4 whitespace-nowrap">
                {{resu.author}}
            </td>
            <td class=" text-gray-900 px-6 py-4 text-clip overflow-hidden... ">
                {{resu.description}}
            </td>
            <td class=" text-gray-900  px-6 py-4 whitespace-nowrap">
                {{resu.published_year}}
            </td>
            <td class=" text-gray-900  px-6 py-4 whitespace-nowrap" :class="status(resu.status)">
                {{resu.status}}
            </td>
            <td class=" text-gray-900  px-6 py-4 whitespace-nowrap">
                <Link :href="route('book.show',resu.id)" class="text-blue-700 text-sm"> Show</Link>
                <Link :href="route('book.edit',resu.id)" class="text-amber-700 text-sm "> Edit</Link>
              <!-- <button @click="deleteBook(resu.id)" class="text-rose-700 text-sm mx-1 "> Delete</button> !-->
            </td>
          </tr>
          </tbody>
    </table>
    </div>
   </Layout>
   <div class="text-center mt-5">
    <Link v-for="(link, index) in result.links"
   :key="index"
   :href="link.url"
    class=" relative inline-flex items-center px-4 py-2 mb-7 border font-medium whitespace-nonwrap"
    :class="[
      link.active
      ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600'
      : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50',
      index === 0 ? 'rounded-l-md' : '',
      index === result.links.length - 1 ? 'rounded-r-md' : ''
      ]"
   v-html="link.label"  ></Link>
   </div>
</template>

<script setup>
import Layout from './Layout.vue'
import { Link, router } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
import { ref,watch } from 'vue'

defineProps({ result: Array})

function status(status){
    if (status === "available") {
    return "text-green-600 ";
  } else if (status === "borrowed") {
    return "text-yellow-500 ";
  } else {
    return "text-rose-500";
  }
}

const yearFilter= ref('')
const bookStatus= ref('')

watch (yearFilter, (value) => {
    router.get('/', {year: value},{ preserveState: true}, { replace: true})

})

watch (bookStatus, (value) => {
    router.get('/', {status: value},{ preserveState: true}, { replace: true})

})

function deleteBook(id){

    if(confirm('Are you sure you want to delete this record?')){
        router.delete(`/book/${id}`)
    }
}
</script>

<style lang="scss" scoped>

</style>
