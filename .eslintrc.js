module.exports = {
    root: true,

    env: {
        node: true,
    },

    globals: {
        NodeJS: true,
        withDefaults: true,
        defineProps: true,
        defineEmits: true,
    },

    extends: [
        // "eslint:recommended",
        "plugin:@typescript-eslint/eslint-recommended",
        "plugin:vue/vue3-recommended",
        "prettier",
    ],

    plugins: ["@typescript-eslint", "vue", "import"],
    parser: "vue-eslint-parser",

    parserOptions: {
        extraFileExtensions: [".vue"],
        parser: "@typescript-eslint/parser",
        ecmaVersion: 2021,
        sourceType: "module",
        ecmaFeatures: {
            jsx: true,
        },
    },

    rules: {
        "no-console": "off",
        "no-debugger": process.env.NODE_ENV === "production" ? "warn" : "off",
        "@typescript-eslint/no-explicit-any": "off",
        "@typescript-eslint/ban-ts-ignore": "off",
        "@typescript-eslint/camelcase": "off",
        "@typescript-eslint/no-undef": "off",
        "@typescript-eslint/no-var-requires": "off",
        "@typescript-eslint/no-use-before-define": "off",
        "@typescript-eslint/explicit-module-boundary-types": "off",
        "@typescript-eslint/ban-ts-comment": "off",
        "vue/multi-word-component-names": "off",
        "vue/require-default-prop": "off",
        "@typescript-eslint/no-this-alias": "off",
    },

    overrides: [
        {
            files: [
                "**/__tests__/*.{j,t}s?(x)",
                "**/tests/unit/**/*.spec.{j,t}s?(x)",
            ],
            env: {
                jest: true,
            },
        },
    ],
};
