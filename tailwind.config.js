/** @type {import('tailwindcss').Config} */

module.exports = {
  content: ["./*.{php,html,js}", "./includes/*.php", "./page/*.php"],
  theme: {
    extend: {
      fontFamily: {
        recursive: ["Recursive", "sans-serif"],
      },
    },
  },
  plugins: [require('@tailwindcss/forms')],
};
