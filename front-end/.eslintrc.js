module.exports = {
  root: true,
  env: {
    node: true
  },
  extends: [
    'plugin:vue/essential',
    '@vue/standard'
  ],
  parserOptions: {
    parser: '@babel/eslint-parser'
  },
  rules: {
    'no-console': process.env.NODE_ENV === 'production' ? 'warn' : 'off',
    'no-debugger': process.env.NODE_ENV === 'production' ? 'warn' : 'off',
    'no-unused-vars': 'off',
    'no-undef': 'off',
    'no-useless-escape': 'off',
    'no-useless-return': 'off',
    'no-useless-constructor': 'off',
    'no-useless-catch': 'off',
    'no-useless-call': 'off',
    'no-useless-computed-key': 'off',
    'no-useless-concat': 'off',
    'no-useless-rename': 'off',
    'indent' : 'off',
    'no-tabs': 'off',
    'no-mixed-spaces-and-tabs': 'off',
    'no-trailing-spaces': 'off',
    'no-multiple-empty-lines': 'off',
    'space-before-function-paren': 'off',
    'space-before-blocks': 'off',
    'space-in-parens': 'off',
    'space-infix-ops': 'off',
    'space-unary-ops': 'off',
    'spaced-comment': 'off',
    'comma-spacing': 'off',
    'comma-style': 'off',
    'comma-dangle': 'off',
    'semi': 'off',
    'semi-spacing': 'off',
    'semi-style': 'off',
    'quotes': 'off',
    'quote-props': 'off',
    'key-spacing': 'off',
    'keyword-spacing': 'off',
    'eol-last': 'off',
    'no-extra-semi': 'off',
    'no-extra-parens': 'off',
    'no-extra-boolean-cast': 'off',
    'no-extra-label': 'off',
    'no-extra-bind': 'off',
    'no-extra-strict': 'off',
    'vue/multi-word-component-names': 'off',   
    'vue/no-unused-components': 'off',
    'vue/no-unused-vars': 'off',
    'vue/no-unused-properties': 'off',
    'vue/no-unused-methods': 'off',
    'vue/no-unused-refs': 'off',
              
    
  }
}
