import Alpine from "alpinejs";
import "flowbite";
import "./bootstrap";

window.Alpine = Alpine;

Alpine.start();

// DARK MODE TOGGLE BUTTON

const themeToggleDarkIcon = document.getElementById("theme-toggle-dark-icon");
const themeToggleLightIcon = document.getElementById("theme-toggle-light-icon");

// Проверяем, какая тема установлена в localStorage или предпочитается системой
const currentTheme = localStorage.getItem("color-theme");
const systemPrefersDark = window.matchMedia(
    "(prefers-color-scheme: dark)"
).matches;

if (currentTheme === "dark" || (!currentTheme && systemPrefersDark)) {
    document.documentElement.classList.add("dark");
    themeToggleLightIcon.classList.remove("hidden");
} else {
    document.documentElement.classList.remove("dark");
    themeToggleDarkIcon.classList.remove("hidden");
}

const themeToggleBtn = document.getElementById("theme-toggle");

themeToggleBtn.addEventListener("click", function () {
    themeToggleDarkIcon.classList.toggle("hidden");
    themeToggleLightIcon.classList.toggle("hidden");

    if (document.documentElement.classList.contains("dark")) {
        document.documentElement.classList.remove("dark");
        localStorage.setItem("color-theme", "light");
    } else {
        document.documentElement.classList.add("dark");
        localStorage.setItem("color-theme", "dark");
    }
});

// const {
//     ClassicEditor,
//     Autoformat,
//     AutoImage,
//     Autosave,
//     BlockQuote,
//     Bold,
//     CloudServices,
//     Emoji,
//     Essentials,
//     Heading,
//     ImageBlock,
//     ImageCaption,
//     ImageInline,
//     ImageInsert,
//     ImageInsertViaUrl,
//     ImageResize,
//     ImageStyle,
//     ImageTextAlternative,
//     ImageToolbar,
//     ImageUpload,
//     Indent,
//     IndentBlock,
//     Italic,
//     Link,
//     LinkImage,
//     Mention,
//     Paragraph,
//     SimpleUploadAdapter,
//     Table,
//     TableCaption,
//     TableCellProperties,
//     TableColumnResize,
//     TableProperties,
//     TableToolbar,
//     TextTransformation,
//     Underline,
// } = window.CKEDITOR;

// const LICENSE_KEY = "eyJhbGciOiJFUzI1NiJ9.eyJleHAiOjE3NzE3MTgzOTksImp0aSI6ImQ2ZTg0NGUxLWY1ZTMtNDcxNC04NGUwLTQwZWMyZjkyNmQ1YiIsInVzYWdlRW5kcG9pbnQiOiJodHRwczovL3Byb3h5LWV2ZW50LmNrZWRpdG9yLmNvbSIsImRpc3RyaWJ1dGlvbkNoYW5uZWwiOlsiY2xvdWQiLCJkcnVwYWwiXSwiZmVhdHVyZXMiOlsiRFJVUCJdLCJ2YyI6IjU0ZDAwNzM3In0.YytQnwN1J25Vs6dGqO3-A89N7lgG6XNTwS3UU3seia74mu3bikIHKGGB5AlH2tKak0uzc_McnZm-9wzdCkh_Lw";

// const editorConfig = {
//     toolbar: {
//         items: [
//             "heading",
//             "|",
//             "bold",
//             "italic",
//             "underline",
//             "|",
//             "link",
//             "insertImage",
//             "insertImageViaUrl",
//             "insertTable",
//             "blockQuote",
//             "|",
//             "outdent",
//             "indent",
//         ],
//         shouldNotGroupWhenFull: false,
//     },
//     plugins: [
//         Autoformat,
//         AutoImage,
//         Autosave,
//         BlockQuote,
//         Bold,
//         CloudServices,
//         Emoji,
//         Essentials,
//         Heading,
//         ImageBlock,
//         ImageCaption,
//         ImageInline,
//         ImageInsert,
//         ImageInsertViaUrl,
//         ImageResize,
//         ImageStyle,
//         ImageTextAlternative,
//         ImageToolbar,
//         ImageUpload,
//         Indent,
//         IndentBlock,
//         Italic,
//         Link,
//         LinkImage,
//         Mention,
//         Paragraph,
//         SimpleUploadAdapter,
//         Table,
//         TableCaption,
//         TableCellProperties,
//         TableColumnResize,
//         TableProperties,
//         TableToolbar,
//         TextTransformation,
//         Underline,
//     ],
//     heading: {
//         options: [
//             {
//                 model: "paragraph",
//                 title: "Paragraph",
//                 class: "ck-heading_paragraph",
//             },
//             {
//                 model: "heading1",
//                 view: "h1",
//                 title: "Heading 1",
//                 class: "ck-heading_heading1",
//             },
//             {
//                 model: "heading2",
//                 view: "h2",
//                 title: "Heading 2",
//                 class: "ck-heading_heading2",
//             },
//             {
//                 model: "heading3",
//                 view: "h3",
//                 title: "Heading 3",
//                 class: "ck-heading_heading3",
//             },
//             {
//                 model: "heading4",
//                 view: "h4",
//                 title: "Heading 4",
//                 class: "ck-heading_heading4",
//             },
//             {
//                 model: "heading5",
//                 view: "h5",
//                 title: "Heading 5",
//                 class: "ck-heading_heading5",
//             },
//             {
//                 model: "heading6",
//                 view: "h6",
//                 title: "Heading 6",
//                 class: "ck-heading_heading6",
//             },
//         ],
//     },
//     image: {
//         toolbar: [
//             "toggleImageCaption",
//             "imageTextAlternative",
//             "|",
//             "imageStyle:inline",
//             "imageStyle:wrapText",
//             "imageStyle:breakText",
//             "|",
//             "resizeImage",
//         ],
//     },
//     language: "uk",
//     licenseKey: LICENSE_KEY,
//     link: {
//         addTargetToExternalLinks: true,
//         defaultProtocol: "https://",
//         decorators: {
//             toggleDownloadable: {
//                 mode: "manual",
//                 label: "Downloadable",
//                 attributes: {
//                     download: "file",
//                 },
//             },
//         },
//     },
//     mention: {
//         feeds: [
//             {
//                 marker: "@",
//                 feed: [
//                     /* See: https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html */
//                 ],
//             },
//         ],
//     },
//     menuBar: {
//         isVisible: true,
//     },
//     table: {
//         contentToolbar: [
//             "tableColumn",
//             "tableRow",
//             "mergeTableCells",
//             "tableProperties",
//             "tableCellProperties",
//         ],
//     },
//     simpleUpload: {
//         uploadUrl: "/ckeditor/upload",
//         headers: {
//             "X-CSRF-TOKEN": document
//                 .querySelector('meta[name="csrf-token"]')
//                 .getAttribute("content"),
//         },
//     },
// };

// ClassicEditor.create(document.querySelector("#editor"), editorConfig)
//     .then(editor => {
//         editor.model.document.on('change:data', () => {
//             console.log(editor.getData())
//             document.querySelector('#description').value = editor.getData();
//         });
//     })
//     .catch(error => console.error("CKEditor initialization error:", error));
