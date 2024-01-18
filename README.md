Deliveboo 
===

- App\Http\Controllers\Auth\AuthenticatedSessionController.php 
- destroy()
- return redirect('http://localhost:5174/');

### To Do List

**Back End**
- Form generico:
  - in italiano
  - facoltativo o asterisco
  - il form deve partire solo se i dati sono corretti (controllo errore reattivo)

- Form user: 
  - tipologia ristoranti deve essere obbligatoria
  - vat number  (crea controllo unicità) e email (messaggio di errore in italiano)
  - password controllo che prima e seconda siano uguali (senza ricarica pagina)

- Form prodotti update o create: 
  - messaggio di riuscita se il prodotto è inserito correttamente
  - immmagine nel form, con immagine di default se non inserita

- Form prodotti update: checkbox metodo old() non funziona bene

- Sistemare la modale

- controllare la funzione show restaurant in modo tale che si possa visualizzare le categorie

**Front End**
- Carrello: 
  - posso scegliere un solo ristorante
  - se aggiungo i prodotti da un nuovo ristorante deve darmi errore (controllo restaurant id)
  - crea una pagina per i carrello con all'interno il form dati del cliente
  - se confermato parte la chiamata con brain tree ceh restituisce la conferma del pagamento 

- Tipologie:
  - deve partire la chiamata api al click 
  - stampare il numero di risultati
  - visualizza tutte le tipologie del ristorante (opzionale)
