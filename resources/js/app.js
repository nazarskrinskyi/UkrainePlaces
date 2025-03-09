import Alpine from "alpinejs";
import "flowbite";
import "./bootstrap";

window.Alpine = Alpine;

Alpine.start();

const themeToggleDarkIcon = document.getElementById("theme-toggle-dark-icon");
const themeToggleLightIcon = document.getElementById("theme-toggle-light-icon");

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

const {
    ClassicEditor,
    Autoformat,
    AutoImage,
    Autosave,
    BlockQuote,
    Bold,
    CloudServices,
    Emoji,
    Essentials,
    Heading,
    ImageBlock,
    ImageCaption,
    ImageInline,
    ImageInsert,
    ImageInsertViaUrl,
    ImageResize,
    ImageStyle,
    ImageTextAlternative,
    ImageToolbar,
    ImageUpload,
    Indent,
    IndentBlock,
    Italic,
    Link,
    LinkImage,
    Mention,
    Paragraph,
    SimpleUploadAdapter,
    Table,
    TableCaption,
    TableCellProperties,
    TableColumnResize,
    TableProperties,
    TableToolbar,
    TextTransformation,
    Underline,
    Alignment,
    FontSize,
    FontColor,
    FontBackgroundColor,
    Highlight,
    Subscript,
    Strikethrough,
    Superscript,
    MediaEmbed
} = window.CKEDITOR;

const LICENSE_KEY = "eyJhbGciOiJFUzI1NiJ9.eyJleHAiOjE3NzE3MTgzOTksImp0aSI6ImQ2ZTg0NGUxLWY1ZTMtNDcxNC04NGUwLTQwZWMyZjkyNmQ1YiIsInVzYWdlRW5kcG9pbnQiOiJodHRwczovL3Byb3h5LWV2ZW50LmNrZWRpdG9yLmNvbSIsImRpc3RyaWJ1dGlvbkNoYW5uZWwiOlsiY2xvdWQiLCJkcnVwYWwiXSwiZmVhdHVyZXMiOlsiRFJVUCJdLCJ2YyI6IjU0ZDAwNzM3In0.YytQnwN1J25Vs6dGqO3-A89N7lgG6XNTwS3UU3seia74mu3bikIHKGGB5AlH2tKak0uzc_McnZm-9wzdCkh_Lw";

const editorConfig = {
    toolbar: {
        items: [
            "heading",
            "|",
            "bold",
            "italic",
            "underline",
            "strikethrough",
            "subscript",
            "superscript",
            "|",
            "fontSize",
            "fontColor",
            "fontBackgroundColor",
            "highlight",
            "|",
            "alignment",
            "link",
            "insertImage",
            "insertImageViaUrl",
            "insertTable",
            "blockQuote",
            "|",
            "outdent",
            "indent",
            "|",
            "mediaEmbed"
        ],
        shouldNotGroupWhenFull: false,
    },
    plugins: [
        Autoformat,
        AutoImage,
        Autosave,
        BlockQuote,
        Bold,
        CloudServices,
        Emoji,
        Essentials,
        Heading,
        ImageBlock,
        ImageCaption,
        ImageInline,
        ImageInsert,
        ImageInsertViaUrl,
        ImageResize,
        ImageStyle,
        ImageTextAlternative,
        ImageToolbar,
        ImageUpload,
        Indent,
        IndentBlock,
        Italic,
        Link,
        LinkImage,
        Mention,
        Paragraph,
        SimpleUploadAdapter,
        Table,
        TableCaption,
        TableCellProperties,
        TableColumnResize,
        TableProperties,
        TableToolbar,
        TextTransformation,
        Underline,
        Alignment,
        FontSize,
        FontColor,
        FontBackgroundColor,
        Highlight,
        Strikethrough,
        Subscript,
        Superscript,
        MediaEmbed
    ],
    language: "uk",
    licenseKey: LICENSE_KEY,
    link: {
        addTargetToExternalLinks: true,
        defaultProtocol: "https://",
        decorators: {
            toggleDownloadable: {
                mode: "manual",
                label: "Downloadable",
                attributes: {
                    download: "file",
                },
            },
        },
    },
    mention: {
        feeds: [
            {
                marker: "@",
                feed: [],
            },
        ],
    },
    image: {
        toolbar: [
            "toggleImageCaption",
            "imageTextAlternative",
            "|",
            "imageStyle:inline",
            "imageStyle:wrapText",
            "imageStyle:breakText",
            "|",
            "resizeImage",
        ],
    },
    table: {
        contentToolbar: [
            "tableColumn",
            "tableRow",
            "mergeTableCells",
            "tableProperties",
            "tableCellProperties",
        ],
    },
    fontSize: {
        options: [
            "10px",
            "12px",
            "14px",
            "16px",
            "18px",
            "20px",
            "24px",
            "28px",
            "32px",
            "36px",
            "40px",
        ],
        supportAllValues: true,
    },
    simpleUpload: {
        uploadUrl: "/ckeditor/upload",
        headers: {
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
    },
};

ClassicEditor.create(document.querySelector("#editor"), editorConfig)
    .then(editor => {
        editor.model.document.on('change:data', () => {
            console.log(editor.getData())
            document.querySelector('#description').value = editor.getData();
        });
    })
    .catch(error => console.error("CKEditor initialization error:", error));
