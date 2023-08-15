/** @type {import('tailwindcss').Config} */

module.exports = {
  content: ['./*.{php,html,js}', './includes/*.php', './pages/*.php'],
  theme: {
    extend: {
      fontFamily: {
        recursive: ['Recursive', 'sans-serif'],
      },
    },
  },
  plugins: [],
};
