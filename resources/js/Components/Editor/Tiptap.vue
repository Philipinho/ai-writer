<template>
    <div class="editor" v-if="editor">
        <div class="editor__footer">
           <!-- <div :class="`editor__status editor__status--`">
                {{ "Something" }}
            </div>-->
            <div class="editor__name">
                {{ editor.storage.characterCount.characters() }} chars |
                {{ editor.storage.characterCount.words() }} words (auto saved)
            </div>
        </div>

        <menu-bar class="editor__header" :editor="editor"/>
        <!--<bubble-menu-bar :editor="editor"/>-->

        <editor-content class="editor__content" :editor="editor"/>


    </div>
</template>

<script>
import {Editor, EditorContent} from '@tiptap/vue-3'
import StarterKit from '@tiptap/starter-kit'
import CharacterCount from '@tiptap/extension-character-count'
import Highlight from '@tiptap/extension-highlight'
import TaskItem from '@tiptap/extension-task-item'
import TaskList from '@tiptap/extension-task-list'
import Placeholder from '@tiptap/extension-placeholder'
import Link from '@tiptap/extension-link'
import debounce from 'debounce'
import { useToast } from "vue-toastification";

import MenuBar from '@/Components/Editor/MenuBar.vue'
import BubbleMenuBar from '@/Components/Editor/BubbleMenuBar.vue'


export default {
    components: {
        EditorContent,
        MenuBar,
        BubbleMenuBar
    },

    props: {
        data: {
            type: Object,
        },
        content: {
            type: String,
        }
    },
    watch: {
        content(newContent) {
            if (newContent) {
                this.editor.chain().focus('end').insertContent(newContent + "<br \>").run();
                this.editor.chain().focus().scrollIntoView().run();
            }
        }

    },

    data() {
        return {
            editor: null,
            document_content: this.data.values.content,
            debouncedUpdateContent: debounce(this.updateContent, 1500),
            toast: useToast(),
        }
    },

    methods: {
        updateContent(content) {
            const word_count = this.editor.storage.characterCount.words();

            axios.put(route('documents.update', [this.data.values.uuid]), {content: content, word_count: word_count, action: 'update_content'})
                .then(response => {
                    // add a green tick to the editor header to signify success
                }).catch(error => {
                    this.toast.error('There was an error updating the document.');
                    console.log(error.response.data);
            });
        },
    },

    computed: {},

    mounted() {

        this.editor = new Editor({
            extensions: [
                StarterKit.configure({
                    history: true,
                }),
                Highlight,
                TaskList,
                TaskItem,
                Link,
                CharacterCount.configure({
                    limit: 30000,
                }),
                Placeholder.configure({
                    emptyEditorClass: 'is-editor-empty',
                }),
            ],
            content: this.document_content,
            onUpdate: ({editor}) => {
                // update the document
                this.debouncedUpdateContent(editor.getHTML().replace(/<p><\/p>/g, "<br>"));
            },

            editorProps: {
                attributes: { },
            },
        })
    },

    beforeUnmount() {
        this.editor.destroy()
    },
}
</script>

<style lang="scss" scoped>
.editor {
    background-color: #FFF;
    border: 3px solid #fff;
    border-radius: 0.75rem;
    color: #0D0D0D;
    display: flex;
    flex-direction: column;
    min-height: 100%;
    max-height: 100%;

    &__header {
        align-items: center;
        background: #fff;
        border-bottom: 2px solid rgb(#0D0D0D, 0.4);
        border-top-left-radius: 0.25rem;
        border-top-right-radius: 0.25rem;
        display: flex;
        flex: 0 0 auto;
        flex-wrap: wrap;
        padding: 0.25rem;
    }

    &__content {
        flex: 1 1 auto;
        overflow-x: hidden;
        overflow-y: auto;
        padding: 1.25rem 1rem;
        -webkit-overflow-scrolling: touch;
    }

    &__footer {
        align-items: center;
        border-top: 2px solid rgb(#0D0D0D, 0.4);
        border-bottom: 1px solid rgb(#0D0D0D, 0.2);
        color: #0D0D0D;
        display: flex;
        flex: 0 0 auto;
        flex-wrap: wrap;
        font-size: 12px;
        font-weight: 600;
        justify-content: space-between;
        padding: 0.25rem 0.75rem;
        white-space: nowrap;
    }

    /* Some information about the status */
    &__status {
        align-items: center;
        border-radius: 5px;
        display: flex;

        &::before {
            background: rgba(#0D0D0D, 0.5);
            border-radius: 50%;
            content: ' ';
            display: inline-block;
            flex: 0 0 auto;
            height: 0.5rem;
            margin-right: 0.5rem;
            width: 0.5rem;
        }

        &--connecting::before {
            background: #616161;
        }

        &--connected::before {
            background: #B9F18D;
        }
    }

    &__name {
        button {
            background: none;
            border: none;
            border-radius: 0.4rem;
            color: #0D0D0D;
            font: inherit;
            font-size: 12px;
            font-weight: 600;
            padding: 0.25rem 0.5rem;

            &:hover {
                background-color: #0D0D0D;
                color: #FFF;
            }
        }
    }
}
</style>
