// By Marty at https://codepen.io/Marty-Development/pen/vYLLoaQ

(function ($) {
  /**
   * initializeBlock
   *
   * Adds custom JavaScript to the block HTML.
   *
   * @date    15/4/19
   * @since   1.0.0
   *
   * @param   object $block The block jQuery element.
   * @param   object attributes The block attributes (only available when editing).
   * @return  void
   */
  var initializeBlock = function ($block) {
    // $block.find("img").doSomething();
    // var slides = $(".mySlides");
    // var dots = $(".dot");
  };

  // Initialize each block on page load (front end).
  $(document).ready(function () {
    $(".testimonial-slider").each(function () {
      // initializeBlock($(this));

      var slides = document.getElementsByClassName("mySlides");
      var dots = document.getElementsByClassName("dot");
      var dot = document.querySelector(".dot");
      var prev = document.querySelector(".prev");
      var next = document.querySelector(".next");

      if (!slides.length == 0) {
        var slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
          showSlides((slideIndex += n));
        }

        var currentSlide = function (n) {
          showSlides((slideIndex = n));
        };

        function showSlides(n) {
          if (n > slides.length) {
            slideIndex = 1;
          }

          if (n < 1) {
            slideIndex = slides.length;
          }

          if (slides.length == 1) {
            prev.style.display = "none";
            next.style.display = "none";
            dot.style.display = "none";
          }

          for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
            slides[i].className = slides[i].className.replace(
              "active_slide",
              ""
            );
          }

          for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace("active", "");
          }

          slides[slideIndex - 1].style.display = "block";
          slides[slideIndex - 1].classList.add("active_slide");
          dots[slideIndex - 1].className += " active";
        }
      }
      if (prev !== undefined) {
        prev.addEventListener("click", () => {
          plusSlides(-1);
        });
      }

      if (next !== undefined) {
        next.addEventListener("click", () => {
          plusSlides(1);
        });
      }
    });
  });

  // Initialize dynamic block preview (editor).
  if (window.acf) {
    window.acf.addAction(
      "render_block_preview/type=testimonial-slider",
      initializeBlock
    );
  }
})(jQuery);
