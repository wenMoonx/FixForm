<script setup>
import axios from "axios";
import { ref, reactive } from "vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Editor from "@ckeditor/ckeditor5-build-classic";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import SubmitButton from "@/Components/SubmitButton.vue";
import ProcessingIcon from "@/Components/Icons/ProcessingIcon.vue";

const props = defineProps({
    post: Object,
    categories: Object,
});

const form = useForm({
    _method: "PUT",
    title: props.post.title,
    slug: props.post.slug,
    price: props.post.price,
    image: props.post.image,
    body: props.post.body,
});

/**
 * Slugify the title
 */
const titleField = () => {
    if (form.title) {
        // fetch("/dashboard/posts/getSlug?title=" + form.title)
        //     .then((response) => response.json())
        //     .then((data) => {
        //         form.slug = data.slug;
        //     });
        axios
            .get(`/dashboard/posts/getSlug?title=${form.title}`)
            .then((response) => {
                form.slug = response.data.slug;
            });
    } else {
        form.reset("slug");
    }
};

/**
 * Image Upload
 * onChange: Read the file and set the form image
 * onRemove: Reset the form image and the input file
 */
const urlImage = ref(null);
const imageField = () => {
    return {
        onChange: (event) => {
            const file = event.target.files[0];
            const reader = new FileReader();
            form.image = file;
            reader.onload = (event) => {
                urlImage.value = event.target.result;
            };
            reader.readAsDataURL(file);
        },
        onRemove: () => {
            document.querySelector("#imageInput").value = "";
            form.reset("image");
            urlImage.value = null;
        },
    };
};

const texteditor = reactive({
    editor: Editor,
    editorConfig: {
        toolbar: {
            items: [
                "heading",
                "|",
                "bold",
                "italic",
                "strikethrough",
                "underline",
                "link",
                "bulletedList",
                "numberedList",
                "|",
                "alignment",
                "outdent",
                "indent",
                "|",
                "htmlEmbed",
                "imageUpload",
                "blockQuote",
                "insertTable",
                "mediaEmbed",
                "|",
                "removeFormat",
                "undo",
                "redo",
            ],
        },
        language: "en",
        table: {
            contentToolbar: ["tableColumn", "tableRow", "mergeTableCells"],
        },
    },
});

/**
 * Update Form
 */
const updatePost = () => {
    form.post(route("dashboard.posts.update", props.post.slug), {
        preserveState: true,
    });
};
</script>

<template>
    <Head title="Edit Post" />

    <AuthenticatedLayout>
        <template #header>
            <div
                class="text-xl font-bold leading-tight text-gray-800 cursor-default dark:text-gray-200"
            >
                <Link :href="route('dashboard.posts.index')">Posts / </Link>
                <span class="text-indigo-500">{{ props.post.title }}</span>
                <span> / Edit</span>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg"
                >
                    <div
                        class="p-6 bg-white border-b dark:border-b-0 dark:bg-gray-800"
                    >
                        <form @submit.prevent="updatePost">
                            <div class="grid grid-cols-2 gap-3 mb-3">
                                <!-- TITLE -->
                                <div
                                    class="w-full col-span-2 mb-3 md:col-span-1"
                                >
                                    <InputLabel
                                        for="title"
                                        value="Title"
                                        class="text-base text-gray-700 dark:text-gray-200"
                                    />
                                    <TextInput
                                        id="title"
                                        v-model="form.title"
                                        type="text"
                                        class="block w-full mt-1 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-800"
                                        :class="'ring-red-500' +
                                            (form.errors.title ? ' ring-2' : '')
                                        "
                                        placeholder="Title"
                                        required
                                        @change="titleField"
                                    />
                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.title"
                                    />
                                </div>

                                <!-- SLUG -->
                                <div
                                    class="w-full col-span-2 mb-3 md:col-span-1"
                                >
                                    <InputLabel
                                        for="slug"
                                        value="Slug"
                                        class="text-base text-gray-700 dark:text-gray-200"
                                    />
                                    <TextInput
                                        id="slug"
                                        v-model="form.slug"
                                        type="text"
                                        class="block w-full mt-1 placeholder-gray-400 bg-gray-200 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-800"
                                        :class="'ring-red-500' +
                                            (form.errors.slug ? ' ring-2' : '')
                                        "
                                        placeholder="Slug"
                                        disabled=""
                                        required
                                    />
                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.slug"
                                    />
                                </div>

                                <!-- IMAGE -->
                                <div
                                    class="w-full col-span-2 mb-3 md:col-span-1"
                                >
                                    <InputLabel
                                        for="image"
                                        value="Image"
                                        class="text-base text-gray-700 dark:text-gray-200"
                                    />
                                    <div class="flex items-center gap-2">
                                        <label class="w-full">
                                            <span class="sr-only"
                                                >Choose image</span
                                            >
                                            <input
                                                id="imageInput"
                                                type="file"
                                                class="block w-full text-sm border border-gray-100 rounded-full dark:border-gray-700 text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 dark:text-gray-200 hover:file:bg-violet-100 focus:ring-2 focus:ring-indigo-500 focus:outline-none focus:rounded-full"
                                                @change="imageField().onChange"
                                            />
                                        </label>
                                        <button
                                            v-if="urlImage || form.post.image"
                                            type="button"
                                            class="p-1 transition duration-200 ease-in rounded-full hover:bg-slate-300"
                                            @click="imageField().onRemove"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke-width="1.5"
                                                stroke="currentColor"
                                                class="w-6 h-6"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M6 18L18 6M6 6l12 12"
                                                />
                                            </svg>
                                        </button>
                                    </div>
                                    <img
                                        v-if="urlImage || post.image"
                                        :src="
                                            urlImage || '/storage/' + post.image
                                        "
                                        class="w-full mt-4 h-80"
                                    />
                                    <div
                                        v-if="form.errors.image"
                                        class="mt-1 text-sm text-red-500"
                                    >
                                        {{ form.errors.image }}
                                    </div>
                                </div>

                                <!-- Price -->
                                <div
                                    class="w-full col-span-2 mb-3 md:col-span-1"
                                >
                                    <InputLabel
                                        for="price"
                                        value="Price"
                                        class="text-base text-gray-700 dark:text-gray-200"
                                    />
                                    <TextInput
                                        id="price"
                                        v-model="form.price"
                                        type="number"
                                        class="block w-full mt-1 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-800"
                                        :class="'ring-red-500' +
                                            (form.errors.price ? ' ring-2' : '')
                                        "
                                        placeholder="1.02"
                                        required
                                        @change="titleField"
                                    />
                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.price"
                                    />
                                </div>

                                <!-- BODY -->
                                <div class="w-full col-span-2 mb-3">
                                    <InputLabel
                                        value="Body"
                                        class="text-base text-gray-700 dark:text-gray-200"
                                    />
                                    <ckeditor
                                        v-model="form.body"
                                        :editor="texteditor.editor"
                                        :config="texteditor.editorConfig"
                                    ></ckeditor>
                                    <div
                                        v-if="form.errors.body"
                                        class="mt-1 text-sm text-red-500"
                                    >
                                        {{ form.errors.body }}
                                    </div>
                                </div>
                            </div>

                            <SubmitButton
                                :disabled="form.processing"
                                :class="
                                    form.processing
                                        ? 'flex items-center justify-center'
                                        : ''
                                "
                            >
                                <ProcessingIcon v-if="form.processing" />
                                {{
                                    form.processing
                                        ? "Processing..."
                                        : "Update Post"
                                }}
                            </SubmitButton>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style></style>
