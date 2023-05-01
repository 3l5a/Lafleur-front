<main class="lottery">
  <div class="container">
    <div class="machine">

      <div class="slot">
        <div class="symbol"></div>
      </div>

      <div class="slot">
        <div class="symbol"></div>
      </div>

      <div class="slot">
        <div class="symbol"></div>
      </div>

    </div>
    <button id="play" name="play">Tenter ma chance</button>
  </div>
</main>
<script defer>
  // play button
  const playButton = document.getElementById("play");

  // Récupère tous les éléments du document ayant la classe CSS "symbol"
  const symbols = document.querySelectorAll(".symbol");

  // Ajoute un écouteur d'événement "click" à l'élément playButton
  playButton.addEventListener("click", () => {
    // Définit une liste d'objets représentant les symboles et leurs quantité respectives
    ajax();

    // Calcule la somme totale des quantités dans items
    const totalQty = items.reduce((total, item) => total + item.quantity, 0);

    // sélectionne un élément aléatoire de la liste items
    const randomItem = () => {
      let random = Math.floor(Math.random() * totalQty);
      let sum = 0;

      for (let item of items) {
        sum += item.quantity;
        if (random < sum) {
          return item;
        }
      }
    };

    // Définit une fonction qui vérifie si le joueur a gagné le jeu
    const checkWin = () => {
      const emojis = Array.from(symbols).map((symbol) => symbol.textContent);
      if (emojis[0] === emojis[1] && emojis[1] === emojis[2]) {
        if (emojis[0] === "🖊️") {
          alert("Félicitations ! Vous avez gagné un stylo Lafleur !");
        }
        if (emojis[0] === "👜") {
          alert("Félicitations ! Vous avez gagné un sac en coton réutilisable Lafleur !");
        }
        if (emojis[0] === "🔑") {
          alert("Félicitations ! Vous avez gagné un porte-clés Lafleur !");
        }
        if (emojis[0] === "🌹") {
          alert("Félicitations ! Vous avez gagné une rose !");
        }
        if (emojis[0] === "💐") {
          alert("Félicitations ! Vous avez gagné un bouquet de roses !");
        }
      }
    };

    // Pour chaque élément symbol dans la liste de nœuds symbols, sélectionne un élément de manière aléatoire et met à jour le contenu textuel de l'élément symbol avec l'emoji correspondant
    symbols.forEach((symbol) => {
      const item = randomItem();
      symbol.textContent = item.emoji;
    });

    // Attend une 1/2 seconde, puis vérifie si le joueur a gagné le jeu
    setTimeout(checkWin, 250);
  });

  function ajax() {
      fetch('App/model/M_Lottery.php', {
          method: 'GET',
          headers: {
            'Content-Type': 'application/json',
          },
          dataType: "json",
        })
        .then((response) => {
          if (!response.ok) {
            throw new Error("Problème - code d'état HTTP : " + response.status);
          }
          console.log(response.json());
          return response.json();
        }).then((body) => {
          console.log(response.json());
          let items = [
            { emoji: response[0][1], quantity: response[0][2] },  // Émoji stylo
            { emoji: "👜", quantity: 700 },   // Émoji sac réutilisable
            { emoji: "🔑", quantity: 200 },  // Émoji clé
            { emoji: "🌹", quantity: 50 },   // Émoji rose rouge
            { emoji: "💐", quantity: 10 }   // Émoji bouquet de roses
          ];
        }).catch((e) => {
          console.log(e.toString());
        });

  }
</script>