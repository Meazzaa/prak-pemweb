var changeProfileButton = document.getElementById("changeProfileButton");
var freeButton = document.getElementById("freeButton");
var body = document.body;
var isProfileChanged = false;
var isStyleChanged = false;

changeProfileButton.addEventListener("click", function () {
  if (!isProfileChanged) {
    body.style.backgroundColor = "rgb(39, 26, 144)";

    body.style.fontSize = "17px";

    body.style.fontFamily = "Verdana, sans-serif";
    isProfileChanged = true;
  } else {
    body.style.backgroundColor = "#f0f0f0";

    body.style.fontSize = "16px";

    body.style.fontFamily = "Arial, sans-serif";
    isProfileChanged = false;
  }
  freeButton.addEventListener("click", function () {
    if (!isStyleChanged) {
      body.style.backgroundColor = "purple";
      body.style.color = "white";
      body.style.fontWeight = "bold";
      isStyleChanged = true;
    } else {
      body.style.backgroundColor = "#f0f0f0";
      body.style.color = "black";
      body.style.fontWeight = "normal";
      isStyleChanged = false;
    }
  });
});
