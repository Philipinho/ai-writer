<template>

    <bubble-menu class="flex bg-gray-200 rounded border border-gray-300 mb-4 "
                 :editor="editor"
                 :tippy-options="{ duration: 250 }"
                 v-if="editor">

        <button @click="rewrite(editor)"
                :class="['border-r border-gray-400 px-2 bg-gray-200 text-gray-900 hover:text-gray-700 font-medium']">
            <i class="ri-arrow-go-back-line"></i> Rewrite
        </button>

        <button @click="rewrite(editor)"
                :class="['border-r border-gray-400 px-2 bg-gray-200 text-gray-900 hover:text-gray-700 font-medium']">
            <i class="ri-article-line"></i> Rephrase
        </button>

        <button @click="rewrite(editor)"
                :class="['border-r border-gray-400 px-2 bg-gray-200 text-gray-900 hover:text-gray-700 font-medium']">
            <i class="ri-edit-line"></i>  Write More
        </button>

    </bubble-menu>

</template>
<!--

<div class="bg-white border border-gray-200 rounded shadow z-20" style="visibility: visible;">
<button data-testid="rewrite-button" class="cursor-pointer text-turquoise-500 p-2">
Rewrite</button></div></div></div></div>
-->
<script>
import {BubbleMenu} from '@tiptap/vue-3'

export default {
    components: {
        BubbleMenu,
    },
    props: {
        editor: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {

        }
    },
    methods: {
        rewrite(editor){
            const text = editor.state.doc.textBetween(editor.state.selection.from, editor.state.selection.to, ' ')
            console.log('I am to rewrite this ' + text)
            // send text to api and get new response
        },

    }

}
</script>

<style lang="scss">

</style>
