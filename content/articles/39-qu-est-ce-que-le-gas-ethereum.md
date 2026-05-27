---
id: 39
title: "Qu'est-ce que le gas Ethereum ?"
alias: qu-est-ce-que-le-gas-ethereum
catid: 16
state: 1
created: 2021-05-02 15:16:51
metadesc: ""
---

# Qu'est-ce que le gas Ethereum ?

<p>Rappelez-vous notre contrat Bonjour Tout Le Monde ! C'est un programme très facile à faire fonctionner et il ne consomme que très peu de ressource informatique. Cependant, vous ne l'exécutez pas seulement sur votre ordinateur, vous demandez littéralement à tous les participants de l'écosystème Ethereum de l'exécuter, eux aussi.</p>



<p><strong>Rappelez-vous notre contrat Bonjour Tout Le Monde ! C'est un programme très facile à faire fonctionner et il ne consomme que très peu de ressource informatique. Cependant, vous ne l'exécutez pas seulement sur votre ordinateur, vous demandez littéralement à tous les participants de l'écosystème Ethereum de l'exécuter, eux aussi.</strong></p>
<p><strong>Cela nous amène à la question suivante :</strong> que se passe-t-il lorsque des dizaines de milliers de personnes exécutent des contrats sophistiqués ? Si quelqu'un configure son contrat pour que celui-ci continue à fonctionner en boucle à travers le même code, chaque noeud devra l'exécuter indéfiniment. Cela engendrerait trop de pression sur les ressources disponibles et par la suite le système s'effondrerait probablement.</p>
<p>Heureusement, Ethereum introduit le concept de gas pour atténuer ce risque. <strong>Tout comme votre voiture ne peut fonctionner sans carburant, les contrats ne peuvent être exécutés sans gas. Les contrats définissent une quantité de gas que les utilisateurs doivent payer pour pouvoir fonctionner.</strong> S'il n'y a pas suffisamment de gas, le contrat s'arrêtera. <br />Essentiellement, c'est un mécanisme de frais. Le même concept s’étend aux transactions : les mineurs sont principalement motivés par le profit, de sorte qu’ils ignorent les transactions avec des frais moins élevés.</p>
<p>Notez bien que l'ether et le gas ne sont pas la même chose. Le prix moyen du gas fluctue et est largement déterminé par les mineurs. Lorsque vous effectuez une transaction, vous payez pour le gas en ETH. Cela ressemble fortement au système de frais sur Bitcoin à cet égard si le réseau est congestionné et que de nombreux utilisateurs essaient de faire des transactions, le prix moyen du gas augmentera probablement. Inversement, s'il y a peu d'activité, il diminuera.</p>
<p><strong>Bien que le prix du gas change, chaque opération induit une quantité spécifique et fixe de gas nécessaire.</strong> Cela signifie que les contrats complexes consommeront beaucoup plus qu'une simple transaction. Par conséquent, le gas est une mesure de la puissance de calcul. Il assure que le système puisse fournir des frais appropriés aux utilisateurs en fonction de leur utilisation des ressources d'Ethereum.</p>
<p>Le gas se paye généralement avec une fraction d'ether. Ainsi, nous utilisons une unité plus petite (le gwei) pour désigner le montant du prix. Un gwei correspond à un milliardième d'éther.<br />Pour faire court, vous pourriez exécuter un programme qui tournerait en boucle pendant très longtemps. Mais il devient vite très coûteux pour vous de le faire. C'est grâce à cela que les nœuds du réseau Ethereum peuvent atténuer le spam.</p>
<h3>Le gas et ses limites</h3>
<p><strong>Supposons qu'une personne effectue une transaction vers l'adresse d'un contrat. Il a déterminé au préalable combien il veut dépenser en gas (plusieurs permettent de faire le calcul). Il peut de lui-même fixer un prix plus élevé pour inciter les mineurs à inclure sa transaction le plus rapidement possible.</strong></p>
<p>Mais il doit aussi définir une limite de gas, qui sert à le protéger. Il se pourrait que quelque chose ne tourne pas rond avec le contrat, lui faisant consommer plus de gas que ce qu'il avait prévu. La limite de gas est mise en place pour s'assurer qu'une fois que la quantité de gas x est consommée, l'opération s'arrêtera. Le contrat va échouer, mais il ne se retrouvera pas à devoir payer plus que ce qu'il avait déterminé et accepté de payer au départ.</p>
<p>Vous pouvez définir manuellement le prix que vous êtes prêt à payer pour le gas (et la limite de gas) mais la plupart des portefeuilles s'en chargeront pour vous. En bref, le prix du gas définit la vitesse à laquelle les mineurs vont effectuer votre transaction, et la limite de gas définit la quantité maximale que vous paierez.</p>
