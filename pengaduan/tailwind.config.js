module.exports = {
    content: [],
    theme: {
      extend: {
        fontFamily: {
            'inter': ['Inter', 'sans-serif'],
            'worksans': ['Work Sans', 'sans-serif'],
            'montserrat': ['Montserrat', 'sans-serif'],
            'merriweather' : ['Merriweather', 'serif'],
            'poppins' : ['Poppins', 'sans-serif'],
        },
        colors: {
            'primary-black': '#18191F',
            'secondary-black': '#495057',
            'third-black': '#E2F5ED',
            'primary-green': '#62B192',
            'secondary-green': '#D6E8E1',
            'primary-blue': '#ccf0ff',
            'secondary-blue': '#006b99',
            'third-blue': '#00b2ff',
            'sidebar': '#E1FFF8',
            'green-30': '#F4FFFA'
        },
        backgroundImage: {
          'footer': "url('../images/footer.jpg')",
          'login': "url('../images/login.png')",
        },
        height: {
          'bg' : '39rem',
          'line': '.1px'
        },
        width: {
          '100' : '25rem'
        }
      },
    },
    plugins: [],
  }