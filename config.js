const config = {
 tailwindjs: './tailwind.config.js',
 purgecss: {
  content: ['src/**/*.{php}'],
  safelist: {
   standard: [/^pre/, /^code/],
   greedy: [/token.*/],
  },
 },
};

const path = {
 build: {
  css: './css/',
  js: './js/',
 },
 src: {
  css: './src/scss/**/*.scss',
  js: './src/js/**/*.js',
 },
};

module.exports = {
 config,
 path,
};
