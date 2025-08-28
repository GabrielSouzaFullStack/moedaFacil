async function renderizarCotacao() {
  await fetch("index.php")
    .then((res) => res.text())
    .then((data) => {
      document.getElementById("cotacao").innerHTML = data;
    });
}

renderizarCotacao();
