async function renderizarCotacao() {
  await fetch("public/index.php")
    .then((res) => res.text())
    .then((data) => {
      document.getElementById("cotacao").innerHTML = data;
    });
}

renderizarCotacao();
