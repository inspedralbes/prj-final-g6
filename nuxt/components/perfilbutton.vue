<template>
<div class="pen-wrapper">
  <div class="pen-wrapper__inner">
    <nav class="nav">
      
      <input type="checkbox" id="menu-button"  class="menu-button__input" />
      <label for="menu-button" class="menu-button">
        <span class="menu-button__icon">
          <span class="menu-button__icon-strip"></span>
        </span>
      </label>
      
      <div class="nav__inner">
        <figure class="nav__avatar">
          <img src="https://cdn-icons-png.flaticon.com/512/1144/1144760.png" alt="" />
        </figure>
        <ul class="nav-list">
          <li class="nav-list__item">
            <a href="#" class="nav-list__url">
              <svg class="icon nav-list__icon"><use xlink:href="#icon-star"></use></svg>
            </a>
          </li>
          
          <li class="nav-list__item">
            <a href="/perfil" class="nav-list__url">
                            <svg class="icon nav-list__icon"><use xlink:href="#icon-user"></use></svg>
            </a>
          </li>
        </ul>
      </div>
      
    </nav>
  </div>
</div>



<svg style="position: absolute; width: 0; height: 0;" width="0" height="0" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
  <defs>
    <symbol id="icon-star" viewBox="0 0 951 1024">
      <title>star</title>
      <path class="path1" d="M950.857 369.714q0 12.571-14.857 27.429l-207.429 202.286 49.143 285.714q0.571 4 0.571 11.429 0 12-6 20.286t-17.429 8.286q-10.857 0-22.857-6.857l-256.571-134.857-256.571 134.857q-12.571 6.857-22.857 6.857-12 0-18-8.286t-6-20.286q0-3.429 1.143-11.429l49.143-285.714-208-202.286q-14.286-15.429-14.286-27.429 0-21.143 32-26.286l286.857-41.714 128.571-260q10.857-23.429 28-23.429t28 23.429l128.571 260 286.857 41.714q32 5.143 32 26.286z"></path>
    </symbol>
   
    <symbol id="icon-user" viewBox="0 0 1024 1024">
      <title>user</title>
      <path class="path1" d="M0 1024v-96c0-143.488 180.768-197.728 419.168-219.584-52.352-32.448-93.44-123.648-114.848-196.48-0.096 0-0.192 0.064-0.32 0.064-2.176 0-48-57.312-48-128 0-62.016-4.416-113.728 32.224-125.44-0.032-0.864-0.224-1.696-0.224-2.56 0-78.624 40.672-147.52 101.984-187.488 15.84-39.52 64.128-68.512 122.016-68.512s106.176 28.992 122.016 68.512c61.312 39.968 101.984 108.864 101.984 187.488 0 0.864-0.192 1.696-0.224 2.56 36.64 11.712 32.224 63.424 32.224 125.44 0 70.688-50.816 128-48 128-0.128 0-0.224-0.064-0.32-0.064-21.408 72.8-62.496 164.032-114.848 196.48 238.4 21.856 419.168 74.080 419.168 219.584v96h-1024z"></path>
    </symbol>
  </defs>
</svg>
</template>

<script>
export default {

}
</script>

<style lang="scss" scoped>
* {
  box-sizing: border-box;
}

img {
  max-width: 100%;
  display: block;
  margin: auto;
}

.icon {
	display: inline-block;
	width: 1em;
	height: 1em;
	fill: currentColor;
}

body {
  font-family: 'Open Sans', sans-serif;
  background: #fff;
  font-size: 16px;
}

.pen-wrapper[data-v-e6985bec] {
    display: flex;
    height: calc(100vh - 160px);
    min-height: 500px;
    justify-content: center;
    align-items: center;
    z-index: 9;
    position: relative;
    right: -12%;
    top: 9px;

  
  @media screen and (max-height: 800px) {
    padding-top: 40px;
    align-items: flex-start;
  }
}
.pen-title {
  text-align: center;
  font-size: 20px;
  line-height: 40px;
  padding: 20px 0;
}

.nav {
  position: relative;
  width: 150px;
  height: 150px;
}


.nav__inner[data-v-e6985bec] {
    position: absolute;
    top: 0;
    left: 0;
    width: 63px;
    height: 63px;
    padding: 15px;
    border-radius: 75px;
    overflow: hidden;
    background: #fff;
    box-shadow: inset 0px 0px 12px rgba(0, 0, 0, 0.15);
    transition: height 0.3s ease-in;


  input:checked + .menu-button + & {
    height: 400px;
  }
}

.nav__avatar {
  position: relative;
  overflow: hidden;
  
  &, img {
    border-radius: 50%;
  }
}

// -----------------
// Menu button
// -----------------
.menu-button__input { display: none; }
.menu-button[data-v-e6985bec] {
    position: absolute;
    right: 77px;
    top: 0;
    z-index: 2;
    display: block;
    width: 30px;
    height: 31px;
    border-radius: 50%;
    box-shadow: inset 0px 0px 11px 0px rgb(255, 255, 255);
    background: linear-gradient(#ff4184 0%, #ff005a 100%, #ff005a 100%);
    transform: scale(0.1);
    opacity: 0;
    transition: transform 0.3s ease-in, opacity 0.3s ease-in;
    cursor: pointer;

  
  .touch &,
  .nav:hover &,
  input:checked + & {
    transform: scale(1);
    opacity: 1;
  }
}

.menu-button__icon {
  position: absolute;
  top: 50%; 
  left: 50%;
  width: 25px; 
  height: 20px;
  transform: translate3d(-50%, -50%, 0);
}

.menu-button__icon-strip {
  top: 50%;
  margin-top: -2px;
  
  &,
  &:before,
  &:after {
    position: absolute;
    left: 0;
    display: block;
    width: 100%;
    height: 4px;
    border-radius: 4px;
    background-color: #fff;
    transition: transform .3s ease,
                top .3s ease,
                bottom .3s ease,
                opacity .3s ease;
  }
  
  &:before,
  &:after {
    content: '';
    transform-origin: center;
  }
  
  &:before {
    top: -7px;
    margin-top: -2px;
  }
  
  &:after {
    bottom: -7px;
    margin-bottom: -2px;
  }
  
  input:checked + .menu-button & {
    background-color: rgba(255,255,255, 0);
    
    &:before {
      top: 50%;
      transform: rotate(45deg);
    }
    
    &:after {
      bottom: 50%;
      transform: rotate(-45deg);
    }
  }
}


// -----------------
// Nav List
// -----------------

.nav-list[data-v-e6985bec] {
    width: 30px;
    margin: auto;
    margin-bottom: 11px;
    display: table-cell;
    position: relative;
    right: -12%;
}

.nav-list__item  {
  margin-top: 20px;
  opacity: 0;
  text-align: center;
  transition: opacity .3s ease-in;
        
  input:checked + .menu-button + .nav__inner & {
    opacity: 1;
    
    @for $i from 1 through 4 {
      &:nth-child(#{$i}) {
        transition-delay: 0.1s * $i;
      }
    }
  }
}

.nav-list__url  {
  color: #6d6e76;
  transition: color .3s ease;
  
  &:hover {
    color: #ff0b61;
  }
}

.nav-list__icon  {
  font-size: 30px;
}

</style>