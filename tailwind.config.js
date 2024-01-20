/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './public/index.php',
    './public/**/*.{html,php,js}',
    './src/**/*.{html,php,js}',
  ],
  theme: {
    extend: {
      keyframes:{

        descend:{
          from:{top: '-100%'},
          to:{top: '-25%'}
        },

        fade:{
          from:{opacity: '0'},
          to:{opacity: '1'}
        },

        'bounce-right':{
          '0%':{transform:'translateX(0)'},
          '50%':{transform:'translateX(8px)'},
          '100%':{transform:'translateX(0)'},
        }
      },

      animation:{
        'drop-down':'descend 0.2s linear',
        'fade-in':'fade 0.6s ease',
        'push':'bounce-right 0.8s infinite'
      },

      boxShadow:{
        'custom':'0px 0px 20px #00000088',
        'custom-sm':'0px 0px 12px #00000044'
      },


      colors: {
        app:{
          blue:'#082032',
          orange:'#FF4C29',
          secondary:'#2C394B',
          tertiary:'#334756',
        },
      }

    },
    plugins: [
    ],
  }
}
