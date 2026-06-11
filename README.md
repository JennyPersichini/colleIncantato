# Colle Incantato
## Tenuta Agricola Colle Incantato
### Dalla Natura alla Tavola

#### Sito per un agriturismo

- una pagina home, semplice, con una hero section con carosello con immagini, una breve storia dell'agriturismo, una sezione con card con eventi/workshop in programma, una sezione per prenotare, una sezione dedicata ai loro prodotti

- una pagina "storia" con una sezione con la storia dell'agriturismo, la location, i loro prodotti

- una pagina prodotti, con una tabella di prodotti (vini, olii, formaggi, miele) di loro produzione 
    - ogni singolo prodotto: id, nome, categoria (vino, olio, formaggio. miele), tipologia (vino rosso, vino bianco, olio EVO, olio aromatizzato, formaggio stagionato, formaggio morbido, miele d'acacia, miele millefiori), quantità (litri, grammi...), disponibilità (se true "disponibile"; se <=5 "disponibilità limitata"; altrimenti "non disponibile").

- una pagina contatti con indirizzo, email, numero, maps, sezione per prenotare 

**Struttura**:

agriturismo/
│
├── index.php               
├── storia.php               
├── prodotti.php             
├── contatti.php             
│
├── assets/
│   ├── style.css
│   │
│   ├── script.js
│   │
│   └── images/
│
└── README.md

**Userò**:
- PHP
- CSS (+ Bootstrap)
- JavaScript
