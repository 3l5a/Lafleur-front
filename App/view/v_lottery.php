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
<script>
// id, name & quantity left of each prize
const styloId = "<?php echo $styloId ?>";
const stylo = "<?php echo $stylo ?>";
const styloQty = <?php echo $styloQty ?>;

const sacId = "<?php echo $sacId ?>";
const sac = "<?php echo $sac ?>";
const sacQty = <?php echo $sacQty ?>;

const cleId = "<?php echo $cleId ?>";
const cle = "<?php echo $cle ?>";
const cleQty = <?php echo $cleQty ?>;

const roseId = "<?php echo $roseId ?>";
const rose = "<?php echo $rose ?>";
const roseQty = <?php echo $roseQty ?>;

const bouquetId = "<?php echo $bouquetId ?>";
const bouquet = "<?php echo $bouquet ?>";
const bouquetQty = <?php echo $bouquetQty ?>;

const playButton = document.getElementById("play");
const symbols = document.querySelectorAll(".symbol");
const slots = document.querySelectorAll(".slot");
const a = document.createElement("a");
a.textContent = "Retour";

playButton.addEventListener("click", () => {
  playButton.parentNode.replaceChild(a, playButton);

  let items = [
            { emoji: "🖊️", quantity: styloQty, id: styloId }, //stylo
            { emoji: "👜", quantity: sacQty, id: sacId },  //sac réutilisable
            { emoji: "🔑", quantity: cleQty, id: cleId }, //porte-clé
            { emoji: "🌹", quantity: roseQty, id: roseId },  //rose rouge
            { emoji: "💐", quantity: bouquetQty, id: bouquetId }  //bouquet de roses
          ];

  const totalquantity = items.reduce((total, item) => total + item.quantity, 0);

  const randomItem = () => {
    let random = Math.floor(Math.random() * totalquantity);
    var sum = 0;

    for (let item of items) {
      sum += item.quantity;
      if (random < sum) {
        return item;
      }
    }
  };

  const checkWin = () => {
    const emojis = Array.from(symbols).map((symbol) => symbol.textContent);
    if (emojis[0] === emojis[1] && emojis[1] === emojis[2]) {
      let winMessage;
      switch (emojis[0]) {
        case "🖊️":
          winMessage = "Bravo, vous avez gagné un porte-clé “Lafleur”!";
          a.href = "index.php?uc=account&action=visit&id="+items[0].id;
          break;
        case "👜":
          winMessage = "Bravo, vous avez gagné un sac réutilisable en tissu “Lafleur”!";
          a.href = "index.php?uc=account&action=visit&id="+items[1].id;
          break;
        case "🔑":
          winMessage = "Bravo, vous avez gagné un porte-clés “Lafleur”!";
          a.href = "index.php?uc=account&action=visit&id="+items[2].id;
          break;
        case "🌹":
          winMessage = "Bravo, vous avez gagné une rose rouge à offrir!";
          a.href = "index.php?uc=account&action=visit&id="+items[3].id;
          break;
        case "💐":
          winMessage = "Bravo, vous avez gagné un bouquet de roses!";
          a.href = "index.php?uc=account&action=visit&id="+items[4].id;
          break;
      }

      symbols.forEach((symbol, index) => {
        if (index === 0) {
          setTimeout(() => {
            symbol.parentNode.classList.add("winner1");
          }, 10);
        } else if (index === 1) {
          setTimeout(() => {
            symbol.parentNode.classList.add("winner2");
          }, 20);
        } else if (index === 2) {
          setTimeout(() => {
            symbol.parentNode.classList.add("winner3");

          }, 30);
        }
      });

      setTimeout(() => {
        alert(winMessage);
      }, 500);
    } else {
      a.href = "index.php?uc=account&action=visit";

      slots.forEach((slot) => {
        slot.classList.remove("winner1", "winner2", "winner3");
      });
      alert("Désolé, vous avez perdu !");
    }
  };

  let count = 0;

  const delay = (ms) => new Promise((resolve) => setTimeout(resolve, ms));

  const generateCombination = async () => {
    symbols.forEach((symbol) => {
      const item = randomItem();
      symbol.textContent = item.emoji;
    });

    count++;

    if (count < 5) {
      await delay(500);
      generateCombination();
    } else {
      await delay(500);
      symbols.forEach((symbol) => {
          const item = randomItem();
          symbol.textContent = item.emoji;
        });

      await delay(300); // display winning message
      checkWin();
    }
  };

  generateCombination();

});
</script>