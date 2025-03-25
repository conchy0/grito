// referencia dels butons i icones
const changeColor = document.getElementById("changeColor");
const moonIcon = document.querySelector(".icon-moon");
const sunIcon = document.querySelector(".icon-sun");


function aplicarTema() {
  const theme = localStorage.getItem("theme");

  if (theme === "light") {
    document.body.classList.add("light-theme");
    moonIcon.style.display = "none";
    sunIcon.style.display = "inline-block";
  } else {
    document.body.classList.remove("light-theme");
    moonIcon.style.display = "inline-block";
    sunIcon.style.display = "none";
  }
}

// Al cargar la pagina carga la que ja tenim guardat
aplicarTema();



// Cambiar tema y guardar la preferencia en localStorage
changeColor.addEventListener("click", function (e) {
  e.preventDefault();

  document.body.classList.toggle("light-theme");

  if (document.body.classList.contains("light-theme")) {
    localStorage.setItem("theme", "light"); // guardar modo dia
    moonIcon.style.display = "none";
    sunIcon.style.display = "inline-block";
  } else {
    localStorage.setItem("theme", "dark"); // guardar modo nit
    moonIcon.style.display = "inline-block";
    sunIcon.style.display = "none";
  }
});
