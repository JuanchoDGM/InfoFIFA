/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*.{html,js,php}"],
  theme: {
    extend: {
      fontFamily:{
        'poppins':["'Poppins', sans-serif;"],
        'oswald':["Oswald, sans-serif"]
      },
    },
  },
  plugins: [],
}

