import globals from "globals";

export default [{
    languageOptions: {
        globals: {
            ...globals.browser,
            ...globals.node,
        },
    },

    rules: {
        quotes: ["error", "single"],
        "comma-dangle": ["error", "always-multiline"],
        "max-params": ["error", 6],
        "block-spacing": "error",
        "array-bracket-spacing": ["error", "always"],
        "multiline-comment-style": "error",
        "computed-property-spacing": "off",
        "space-in-parens": "off",
        "capitalized-comments": "off",
        "object-curly-spacing": ["error", "always"],
        "no-lonely-if": "off",
        "unicorn/prefer-module": "off",
        "space-before-function-paren": ["error", "never"],
    },
}];
