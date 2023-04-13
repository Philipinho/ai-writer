<template>
    <div class="editor" v-if="editor">
        <div class="editor__footer">
           <!-- <div :class="`editor__status editor__status--`">
                {{ "Something" }}
            </div>-->
            <div class="editor__name">
                {{ editor.storage.characterCount.characters() }} chars |
                {{ editor.storage.characterCount.words() }} words
            </div>
        </div>

        <menu-bar class="editor__header" :editor="editor"/>
        <editor-content class="editor__content" :editor="editor"/>

    </div>
</template>

<script>
import {Editor, EditorContent, BubbleMenu, FloatingMenu} from '@tiptap/vue-3'
import StarterKit from '@tiptap/starter-kit'
import CharacterCount from '@tiptap/extension-character-count'
import Highlight from '@tiptap/extension-highlight'
import TaskItem from '@tiptap/extension-task-item'
import TaskList from '@tiptap/extension-task-list'
import Placeholder from '@tiptap/extension-placeholder'
import debounce from 'debounce'


import MenuBar from '@/Components/Editor/MenuBar.vue'

export default {
    components: {
        EditorContent,
        MenuBar,
        BubbleMenu,
        FloatingMenu,
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
                this.editor.chain().focus('end').createParagraphNear().insertContent(newContent + "<br \>").run();
                this.editor.chain().focus().scrollIntoView().run();
            }
        }

    },

    data() {
        return {
            editor: null,
            document_content: this.data.values.content,
            debouncedUpdateContent: debounce(this.updateContent, 1000),
        }
    },

    methods: {
        updateContent(content) {

            axios.put(route('documents.update', [this.data.values.uuid]), {content: content, action: 'update_content'})
                .then(response => {
                    console.log(response.data)
                }).catch(error => {
                console.log(error.response.data)
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
                this.debouncedUpdateContent(editor.getHTML());
            },

            editorProps: {
                attributes: {
                    // class: 'relative prose prose-sm sm:prose lg:prose-lg px-2 overflow-y-auto max-h-[50vh] !w-full !max-w-none focus-within:outline-none'
                },
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
        background: #0d0d0d;
        border-bottom: 3px solid #0d0d0d;
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
        border-top: 3px solid #0D0D0D;
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


/* Basic editor styles */
.ProseMirror {
    .bubble-menu {
        display: flex;
        background-color: #0D0D0D;
        padding: 0.2rem;
        border-radius: 0.5rem;

        button {
            border: none;
            background: none;
            color: #FFF;
            font-size: 0.85rem;
            font-weight: 500;
            padding: 0 0.2rem;
            opacity: 0.6;

            &:hover,
            &.is-active {
                opacity: 1;
            }
        }
    }

    .floating-menu {
        display: flex;
        background-color: #0D0D0D10;
        padding: 0.2rem;
        border-radius: 0.5rem;

        button {
            border: none;
            background: none;
            font-size: 0.85rem;
            font-weight: 500;
            padding: 0 0.2rem;
            opacity: 0.6;

            &:hover,
            &.is-active {
                opacity: 1;
            }
        }
    }

    p.is-editor-empty:first-child::before {
        color: #adb5bd;
        content: attr(data-placeholder);
        float: left;
        height: 0;
        pointer-events: none;
    }

}

</style>
