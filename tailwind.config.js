/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './public/index.php',
    './public/**/*.{html,php,js}',
    './src/**/*.{html,php,js}',
  ],
  theme: {
    extend: {
      boxShadow:{
        'custom':'0px 0px 20px #00000088',
        'custom-sm':'0px 0px 12px #00000044'
      },

    },
    plugins: [
    ],
  }
}
