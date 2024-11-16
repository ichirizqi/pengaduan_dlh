<template>
 <nav class="fixed top-0 left-0 right-0 bg-white flex justify-around items-center font-inter font-medium py-1">
  <div v-if="name" id="logo">
          <img src="../images/logo.png" alt="Logo DLH KOTA BATU" class="mx-auto md:mx-0 md:w-20 md:h-20 w-16"/>
  </div>
  <div v-else id="logo">
   <img v-bind:src="logoImg" alt="Logo" />
  </div>
  <ul class="nav-links ml-96 ">
   <li v-for="list in navLinks" :key="list.key" class="hover:text-green-500">
    <a v-if="list.dropdown === false" :href="list.link">{{ list.name }}</a>
    <div class="dropdown-link" v-else>
     <a :href="list.link" >
               {{ list.name }}
     </a>
     <ul class="dropdown-menu ">
      <li v-for="item in list.dropdownLinks" :key="item.key" class="hover:bg-gray-300">
       <a :href="item.link" >{{ item.name }}</a>
      </li>
     </ul>
    </div>
   </li>
  </ul>
  <div v-on:click="openMobileNav()" id="burger">
   <div class="line1"></div>
   <div class="line2"></div>
   <div class="line3"></div>
  </div>
 </nav>
</template>

<style>
  ul.nav-links {
  display: flex;
  justify-content: space-between;
  width: 30%;
  line-height: 50px;
  }
  ul.nav-links li {
  list-style: none;
  }
  #burger {
  display: none;
  cursor: pointer;
  }
  #burger div {
  width: 30px;
  height: 3px;
  margin: 8px;
  background-color:rgb(167, 167, 167);
  transition: all 0.3s ease-in;
  }
  ul.dropdown-menu {
  position: absolute;
  top: 12vh;
  background-color: white;
  min-width: 200px;
  cursor: pointer;
  display: none;
  }
 
  ul.dropdown-menu a {
  line-height: 8vh;
  color:black;
  padding: 5px ;
  line-height: 10px;
  }
  .nav-active {
  transform: translateX(0) !important;
  }
  .toggle .line1 {
    transform: rotate(-45deg) translate(-9px, 10px);
  }
  .toggle .line2 {
    opacity: 0;
  }
  .toggle .line3 {
    transform: rotate(45deg) translate(-5px, -6px);
  }
  @keyframes navLinkFade {
    from {
      opacity: 0;
      transform: translateX(-60px);
    }
  to {
      opacity: 1;
      transform: translateX(0px);
    }
  }
  /* Tablet */
  @media screen and (max-width: 1024px) {
    ul.nav-links {
      width: 50%;
    }
  }
  /* Mobile */
  @media screen and (max-width: 768px) {
    ul.nav-links {
      position: absolute;
      flex-direction: column;
      width: 100%;
      height: 120vh;
      top: .5vh;
      right: 0;
      padding: 100px;
      align-items: center;
      justify-content: flex-start;
      background-color: white;
      opacity: 0.8;
      transform: translateX(100%);
      transition: transform 0.5s ease-in;
    }
  ul.nav-links li {
      opacity: 0;
    }
  ul.nav-links a {
      width: 100%;
    }
  div#burger {
      display: block;
    }
  ul.dropdown-menu {
      position: relative;
      top: 0;
    }
  }
</style>

<script>
export default {
  name: 'Navbar',
  props: ['name', 'logoImg', 'navLinks'],
  methods: {
    openMobileNav() {
      const burger = document.getElementById('burger')
      const nav = document.querySelector('.nav-links')
      const navLinks = document.querySelectorAll('.nav-links li')
      // Toggle navigation on mobile
      nav.classList.toggle('nav-active')
      // Burger toggler
      burger.classList.toggle('toggle')
      // Animate navigation links
      navLinks.forEach((link, index) => {
        if (link.style.animation || link.style.webkitAnimation) {
          link.style.animation = ''
          link.style.webkitAnimation = ''
        } else {
          link.style.webkitAnimation = `navLinkFade 0.5s ease forwards ${
            index / 7
          }s`
          link.style.animation = `navLinkFade 0.5s ease forwards ${index / 7}s`
        }
      })
    },
    openDropdownNav() {
      const dropdownLink = document.querySelectorAll('.dropdown-link')
      dropdownLink.forEach((dropdown) => {
        dropdown.addEventListener('mouseover', () => {
          dropdown.children[1].style.display = 'block'
        })
        dropdown.addEventListener('mouseleave', () => {
          dropdown.children[1].style.display = 'none'
        })
      })
    },
    countClicksOnMobileDropdown() {
      const dropdownLink = document.querySelectorAll('.dropdown-link')
      dropdownLink.forEach((dropdown) => {
        let counts = dropdown.clicks || 0
        dropdown.addEventListener('click', () => {
          counts++
          if (counts % 2 == 0) {
            window.location.href = dropdown.children[0].getAttribute('href')
          } else {
            event.preventDefault()
            dropdown.children[1].style.display = 'block'
            setTimeout(() => {
              dropdown.children[1].style.display = 'none'
            }, 5000)
          }
        })
        setTimeout(()=>{counts = 0}, 8000)
      })
    },
  },
  mounted() {
    this.openDropdownNav()
    if (window.innerWidth < 768) {
      this.countClicksOnMobileDropdown()
    }
  },
}
</script>