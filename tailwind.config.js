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
        },
        zoom:{
          '0%':{
            transform:'scale(0)',
            opacity:'0'
          },
          '20%':{
            transform:'scale(0)',
            opacity:'1'
          },
          '100%':{transform:'scale(1)'},
        }
      },

      animation:{
        'drop-down':'descend 0.2s ease-in-out',
        'fade-in':'fade 0.6s ease-in-out',
        'push':'bounce-right 0.8s infinite',
        'zoom-in':'zoom 0.3s ease-in-out',
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
          modal:'#0f0f0fdd',
        },
      }

    },
    plugins: [
    ],
  }
}
