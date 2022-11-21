$(document).ready(function () {
  //const mainImage = $("#main-image");
  //const mainText = $("#main-text");
  const mainCont = $(".front-page");
  const subCont = $(".front-page .cont");

  let contHeight = mainCont.outerHeight();
  let contWidth = mainCont.outerWidth();

  //let imageHeight = mainImage.outerHeight();
  //let textHeight = mainText.outerHeight();

  subCont.css("margin-bottom", -contHeight);

  subCont.fadeIn(1000);
  anime({
    targets: ".front-page .cont",
    translateY: -contHeight / 2,
    duration: 3000,
  });

  //mainImage.fadeIn(1000);
  //mainText.fadeIn(1000);

  /*
  anime({
    targets: "#main-image",
    translateY: -contHeight,
    duration: 3000,
  });

  mainText.fadeIn(1000);
  /*
  anime({
    targets: "#main-text",
    translateY: -(contHeight/2-(textHeight/2)+154),
    duration: 3000,
  });
*/
});
