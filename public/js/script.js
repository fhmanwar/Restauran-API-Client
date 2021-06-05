/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/script.js":
/*!********************************!*\
  !*** ./resources/js/script.js ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! ./teeso */ "./resources/js/teeso.js");

$('#zero_config').DataTable();

/***/ }),

/***/ "./resources/js/teeso.js":
/*!*******************************!*\
  !*** ./resources/js/teeso.js ***!
  \*******************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  "use strict";

  function handlelogobg() {
    $('.theme-color .theme-item .theme-link').on("click", function () {
      var logobgskin = $(this).attr("data-logobg");
      $('.topbar .top-navbar .navbar-header').attr("data-logobg", logobgskin);
    });
  }

  ;
  handlelogobg(); //****************************

  /* Top navbar Theme Change function Start */
  //****************************

  function handlenavbarbg() {
    if ($('#main-wrapper').attr('data-navbarbg') == 'skin6') {
      // do this
      $(".topbar .navbar").addClass('navbar-light');
      $(".topbar .navbar").removeClass('navbar-dark');
    } else {// do that
    }

    $('.theme-color .theme-item .theme-link').on("click", function () {
      var navbarbgskin = $(this).attr("data-navbarbg");
      $('#main-wrapper').attr("data-navbarbg", navbarbgskin);
      $('.topbar .navbar-collapse').attr("data-navbarbg", navbarbgskin);

      if ($('#main-wrapper').attr('data-navbarbg') == 'skin6') {
        // do this
        $(".topbar .navbar").addClass('navbar-light');
        $(".topbar .navbar").removeClass('navbar-dark');
      } else {
        // do that
        $(".topbar .navbar").removeClass('navbar-light');
        $(".topbar .navbar").addClass('navbar-dark');
      }
    });
  }

  ;
  handlenavbarbg(); //****************************

  /* Manage sidebar bg color */
  //****************************

  function handlesidebarbg() {
    $('.theme-color .theme-item .theme-link').on("click", function () {
      var sidebarbgskin = $(this).attr("data-sidebarbg");
      $('.left-sidebar').attr("data-sidebarbg", sidebarbgskin);
      $('.scroll-sidebar').attr("data-sidebarbg", sidebarbgskin);
    });
  }

  ;
  handlesidebarbg(); //****************************

  /* sidebar position */
  //****************************

  function handlesidebarposition() {
    $('#sidebar-position').change(function () {
      if ($(this).is(":checked")) {
        $('#main-wrapper').attr("data-sidebar-position", 'fixed');
        $('.topbar .top-navbar .navbar-header').attr("data-navheader", 'fixed');
      } else {
        $('#main-wrapper').attr("data-sidebar-position", 'absolute');
        $('.topbar .top-navbar .navbar-header').attr("data-navheader", 'relative');
      }
    });
  }

  ;
  handlesidebarposition(); //****************************

  /* Header position */
  //****************************

  function handleheaderposition() {
    $('#header-position').change(function () {
      if ($(this).is(":checked")) {
        $('#main-wrapper').attr("data-header-position", 'fixed');
      } else {
        $('#main-wrapper').attr("data-header-position", 'relative');
      }
    });
  }

  ;
  handleheaderposition(); //****************************

  /* sidebar position */
  //****************************

  function handleboxedlayout() {
    $('#boxed-layout').change(function () {
      if ($(this).is(":checked")) {
        $('#main-wrapper').attr("data-boxed-layout", 'boxed');
      } else {
        $('#main-wrapper').attr("data-boxed-layout", 'full');
      }
    });
  }

  ;
  handleboxedlayout(); //****************************

  /* Header position */
  //****************************

  function handlethemeview() {
    $('#theme-view').change(function () {
      if ($(this).is(":checked")) {
        $('body').attr("data-theme", 'dark');
      } else {
        $('body').attr("data-theme", 'light');
      }
    });
  }

  ;
  handlethemeview();

  var setsidebartype = function setsidebartype() {
    var width = window.innerWidth > 0 ? window.innerWidth : this.screen.width;

    if (width < 1170) {
      $("#main-wrapper").attr("data-sidebartype", "mini-sidebar");
      $("#main-wrapper").addClass("mini-sidebar");
    } else {
      $("#main-wrapper").attr("data-sidebartype", "full");
      $("#main-wrapper").removeClass("mini-sidebar");
    }
  };

  $(window).ready(setsidebartype);
  $(window).on("resize", setsidebartype); // ====================== Sidebar Custom =========================

  var url = window.location + "";
  var path = url.replace(window.location.protocol + "//" + window.location.host + "/", "");
  var element = $('ul#sidebarnav a').filter(function () {
    return this.href === url || this.href === path; // || url.href.indexOf(this.href) === 0;
  });
  element.parentsUntil(".sidebar-nav").each(function (index) {
    if ($(this).is("li") && $(this).children("a").length !== 0) {
      $(this).children("a").addClass("active");
      $(this).parent("ul#sidebarnav").length === 0 ? $(this).addClass("active") : $(this).addClass("selected");
    } else if (!$(this).is("ul") && $(this).children("a").length === 0) {
      $(this).addClass("selected");
    } else if ($(this).is("ul")) {
      $(this).addClass('in');
    }
  });
  element.addClass("active");
  $('#sidebarnav a').on('click', function (e) {
    if (!$(this).hasClass("active")) {
      // hide any open menus and remove all other classes
      $("ul", $(this).parents("ul:first")).removeClass("in");
      $("a", $(this).parents("ul:first")).removeClass("active"); // open our new menu and add the open class

      $(this).next("ul").addClass("in");
      $(this).addClass("active");
    } else if ($(this).hasClass("active")) {
      $(this).removeClass("active");
      $(this).parents("ul:first").removeClass("active");
      $(this).next("ul").removeClass("in");
    }
  });
  $('#sidebarnav >li >a.has-arrow').on('click', function (e) {
    e.preventDefault();
  }); // =================== Custom ========================
  // Feather Icon Init Js

  feather.replace();
  $(".preloader").fadeOut(); // this is for close icon when navigation open in mobile view

  $(".nav-toggler").on('click', function () {
    $("#main-wrapper").toggleClass("show-sidebar");
    $(".nav-toggler i").toggleClass("ti-menu");
  }); // Right sidebar options
  // ==============================================================

  $(function () {
    $(".service-panel-toggle").on('click', function () {
      $(".customizer").toggleClass('show-service-panel');
    });
    $('.page-wrapper').on('click', function () {
      $(".customizer").removeClass('show-service-panel');
    });
  }); //tooltip
  // ==============================================================

  $(function () {
    $('[data-toggle="tooltip"]').tooltip();
  }); //Popover
  // ==============================================================

  $(function () {
    $('[data-toggle="popover"]').popover();
  }); // Perfact scrollbar
  // ==============================================================

  $('.message-center, .customizer-body, .scrollable, .scroll-sidebar').perfectScrollbar({
    wheelPropagation: !0
  }); // Resize all elements
  // ==============================================================

  $("body, .page-wrapper").trigger("resize");
  $(".page-wrapper").delay(20).show(); // To do list
  // ==============================================================

  $(".list-task li label").click(function () {
    $(this).toggleClass("task-done");
  }); // This is for the innerleft sidebar
  // ==============================================================

  $(".show-left-part").on('click', function () {
    $('.left-part').toggleClass('show-panel');
    $('.show-left-part').toggleClass('ti-menu');
  }); // For Custom File Input

  $('.custom-file-input').on('change', function () {
    //get the file name
    var fileName = $(this).val(); //replace the "Choose a file" label

    $(this).next('.custom-file-label').html(fileName);
  });
});

/***/ }),

/***/ 0:
/*!**************************************!*\
  !*** multi ./resources/js/script.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/iboy/Documents/Apps/Laravel/Tesso/resources/js/script.js */"./resources/js/script.js");


/***/ })

/******/ });