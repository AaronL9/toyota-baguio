// import Alpine from 'alpinejs';
// import { Editor } from '@tiptap/core';
// import StarterKit from '@tiptap/starter-kit';
// import TextStyle from '@tiptap/extension-text-style';
// import Color from '@tiptap/extension-color';

// Alpine.data('editor', (content = '') => {
//     let editor; // keep outside Alpine's reactive proxy

//     return {
//         loaded: false,
//         updatedAt: Date.now(),

//         init() {

//             const self = this;

//             editor = new Editor({
//                 element: this.$refs.element,
//                 extensions: [
//                     StarterKit.configure({ heading: { levels: [1] } }),
//                     TextStyle,
//                     Color,
//                 ],
//                 content,
//                 editorProps: {
//                     attributes: {
//                         class: [
//                             'min-h-48 p-4 text-sm text-foreground focus:outline-none',
//                             '[&_h1]:text-2xl [&_h1]:font-bold [&_h1]:my-2',
//                             '[&_p]:my-1',
//                         ].join(' '),
//                     },
//                 },
//                 onCreate: () => { self.loaded = true; self.updatedAt = Date.now(); },
//                 onUpdate: () => (self.updatedAt = Date.now()),
//                 onSelectionUpdate: () => (self.updatedAt = Date.now()),
//             });
//         },

//         destroy() { editor?.destroy(); },

//         isLoaded() { return this.loaded; },

//         // H1
//         isH1() {
//             this.updatedAt;
//             return editor ? editor.isActive('heading', { level: 1 }) : false;
//         },
//         toggleH1() {
//             editor.chain().focus().toggleHeading({ level: 1 }).run();
//         },

//         // Text color
//         currentColor() {
//             this.updatedAt;
//             return editor?.getAttributes('textStyle').color || '#000000';
//         },
//         setColor(color) { editor.chain().focus().setColor(color).run(); },
//         resetColor() { editor.chain().focus().unsetColor().run(); },

//         getHTML() { return editor.getHTML(); },
//     };
// });

// window.Alpine = Alpine;
// Alpine.start();